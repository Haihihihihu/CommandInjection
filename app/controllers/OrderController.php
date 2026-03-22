<?php
class OrderController {
    public function index() {
        require_once 'app/views/order_check.php';
    }

    public function check() {
        $result = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'] ?? '';
            
            // ===== BUSINESS LOGIC BÌNH THƯỜNG =====
            // Mô phỏng tra cứu đơn hàng từ database
            // TODO: Sau này sẽ inject command tại đây (dùng ping/grep)
            
            if (!empty($order_id)) {
                // Giả lập kết quả tra cứu
                $result = "╔═══════════════════════════════════╗\n";
                $result .= "  THÔNG TIN VẬN ĐƠN\n";
                $result .= "╚═══════════════════════════════════╝\n\n";
                $result .= "Mã đơn hàng: " . $order_id . "\n";
                $result .= "Trạng thái: Đang vận chuyển\n";
                $result .= "Vị trí hiện tại: Kho HCM\n";
                $result .= "Dự kiến giao: 3-5 ngày\n";
                $result .= "Người giao: Nguyễn Văn A\n";
            } else {
                $result = "⚠️ Vui lòng nhập mã vận đơn!";
            }
        }
        require_once 'app/views/order_check.php';
    }
}
?>