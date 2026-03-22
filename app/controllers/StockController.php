<?php
class StockController {
    public function index() {
        require_once 'app/views/stock_check.php';
    }

    public function check() {
        $result = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $storeID = $_POST['storeID'] ?? '';
            
            // ===== BUSINESS LOGIC =====
            // Backend sẽ dùng storeID để kiểm tra kho qua lệnh hệ điều hành
            // Ví dụ: ping đến server kho, hoặc grep file inventory
            
            // TODO: Ở đây sẽ gọi lệnh shell để kiểm tra tồn kho
            // Ví dụ: shell_exec("./check_inventory.sh " . $storeID);
            // Hoặc: shell_exec("ping -c 1 store" . $storeID . ".local");
            
            if (!empty($storeID)) {
                // Giả lập kết quả từ lệnh hệ thống
                $result = "========================================\n";
                $result .= "  KẾT QUẢ KIỂM TRA TỒN KHO\n";
                $result .= "========================================\n\n";
                $result .= "Store ID: " . $storeID . "\n";
                $result .= "Status: Connected\n\n";
                $result .= "Inventory Check Results:\n";
                $result .= "------------------------\n";
                $result .= "Product A: 45 units\n";
                $result .= "Product B: 23 units\n";
                $result .= "Product C: 67 units\n";
                $result .= "\nLast updated: " . date('Y-m-d H:i:s');
            } else {
                $result = "Error: Please provide storeID";
            }
        }
        require_once 'app/views/stock_check.php';
    }
}
?>
