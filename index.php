<?php
// Bật output buffering để tránh lỗi header
ob_start();

// Bật hiển thị lỗi để dễ debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Chỉ gọi những Controller bạn cần
require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/OrderController.php';
require_once 'app/controllers/StockController.php';
require_once 'app/controllers/FeedbackController.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';

// --- ĐIỀU HƯỚNG (ROUTING) ---

// 1. Trang chủ
if ($url == '/' || $url == 'home') {
    (new HomeController())->index();
}

// 2. Chi tiết sản phẩm và KỊCH BẢN 1: In-band Command Injection
elseif ($url == 'product') {
    (new ProductController())->detail();
}
elseif ($url == 'product/stock') {
    (new ProductController())->checkStock();
}

// 3. Kiểm tra đơn hàng
elseif ($url == 'order') {
    (new OrderController())->index();
}
elseif ($url == 'order/check') {
    (new OrderController())->check();
}

// 4. KỊCH BẢN 2 & 3: Feedback
elseif ($url == 'feedback') {
    (new FeedbackController())->index();
}
elseif ($url == 'feedback/send') {
    (new FeedbackController())->send();
}

// 5. Image endpoint - KỊCH BẢN 2: Serve files từ /var/www/images/
elseif ($url == 'image') {
    require_once 'app/views/image_view.php';
    exit;
}

// 6. Trang thông báo kết quả
elseif ($url == 'result') {
    require_once 'app/views/result.php';
}

else {
    echo "<h1 style='text-align:center; margin-top:50px;'>404 - Trang không tìm thấy</h1>";
}
?>