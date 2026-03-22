    <?php
class ProductController {
    public function detail() {
        // Lấy productId từ URL
        $productId = $_GET['productId'] ?? '1';
        
        // Giả lập thông tin sản phẩm
        $products = [
            '1' => ['name' => 'A', 'price' => '45.000.000đ', 'desc' => 'Core i9, RTX 4090, 32GB RAM'],
            '2' => ['name' => 'B', 'price' => '1.200.000đ', 'desc' => 'Blue Switch, RGB LED'],
            '3' => ['name' => 'C', 'price' => '2.500.000đ', 'desc' => 'Pentest Tool, Keystroke Injection']
        ];
        
        $product = $products[$productId] ?? $products['1'];
        
        require_once 'app/views/product_detail.php';
    }
    
    public function checkStock() {
        $stockResult = "";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['productId'] ?? '';
            $storeId = $_POST['storeId'] ?? '';
            
            // ╔════════════════════════════════════════════════════════════════╗
            // ║  KỊCH BẢN 1: IN-BAND COMMAND INJECTION                        ║
            // ║  LỖ HỔNG: OS Command Injection                                 ║
            // ╚════════════════════════════════════════════════════════════════╝
            
            // LỖ HỔNG 1: KHÔNG SANITIZE INPUT
            // Input từ user ($productId và $storeId) được dùng trực tiếp
            // mà KHÔNG có validation hoặc escape
            
            // LỖ HỔNG 2: NỐI TRỰC TIẾP INPUT VÀO LỆNH SHELL
            // Command được build bằng cách concatenate string với input user
            // Attacker có thể inject thêm lệnh bằng: | ; & ` $() \n
            
            if (!empty($productId) && !empty($storeId)) {
                
                // ═══════════════════════════════════════════════════════════
                // CODE LỖ HỔNG (ĐANG BẬT) - Comment 2 dòng dưới để tắt
                // ═══════════════════════════════════════════════════════════
                $command = "stockreport.pl " . $productId . " " . $storeId;
                $output = shell_exec($command);
                
                // ╔═════════════════════════════════════════════════════════╗
                // ║ CODE VÁ (ĐANG TẮT) - Uncomment 1 trong 2 cách dưới     ║
                // ╚═════════════════════════════════════════════════════════╝
                
                // CÁCH 1: escapeshellarg() - Nhanh ✅
                //$command = "stockreport.pl " . escapeshellarg($productId) . " " . escapeshellarg($storeId);
                //$output = shell_exec($command);
                
                // CÁCH 2: Whitelist validation - An toàn hơn ✅✅
                //if (!preg_match('/^[0-9]+$/', $productId) || !preg_match('/^[0-9]+$/', $storeId)) {
                //    $stockResult = "Invalid input!";
                //    echo $stockResult;
                //    exit;
                //}
                //$command = "stockreport.pl " . $productId . " " . $storeId;
                //$output = shell_exec($command);
                
                // LỖ HỔNG 4: TRẢ OUTPUT TRỰC TIẾP (IN-BAND)
                // Kết quả lệnh được trả về ngay trong response
                // → Attacker nhìn thấy output của command injection
                
                if ($output) {
                    $stockResult = $output;
                } else {
                    // Nếu script không tồn tại, fake kết quả
                    $units = rand(10, 100);
                    $stockResult = $units . " units";
                }
                
                // ╔═══════════════════════════════════════════════════════════╗
                // ║  CÁC PAYLOAD EXPLOIT MẪU:                                 ║
                // ╠═══════════════════════════════════════════════════════════╣
                // ║  storeId=1|whoami        → Output: www-data              ║
                // ║  storeId=1;id            → Output: uid=33(www-data)...   ║
                // ║  storeId=1 & cat /etc/passwd  → Đọc file hệ thống       ║
                // ║  storeId=1`ls -la`       → List directory                ║
                // ╚═══════════════════════════════════════════════════════════╝
                
            } else {
                $stockResult = "Error: Missing parameters";
            }
        }
        
        // Trả về kết quả trực tiếp (in-band)
        echo $stockResult;
        exit;
    }
}
?>