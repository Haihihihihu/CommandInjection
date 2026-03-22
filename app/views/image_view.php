<?php
// KỊCH BẢN 2: Blind Command Injection - Image File Server
// Chức năng: Serve file theo filename (dùng cho gallery và blind injection)

// Clean any output buffer to prevent "contains errors" message
ob_clean();

$filename = $_GET['filename'] ?? '';

if (empty($filename)) {
    http_response_code(400);
    die('Error: filename parameter required');
}

// ===== BUSINESS LOGIC =====
// Đọc file từ thư mục images (ngoài document root)
// TODO: Ở đây sẽ đọc file từ filesystem
// KHÔNG CÓ SANITIZATION - để có thể đọc bất kỳ file nào

$imageDir = '/var/www/images/';
$filePath = $imageDir . $filename;

// Kiểm tra file có tồn tại không
if (file_exists($filePath)) {
    // Nếu là file text thì hiển thị nội dung
    if (pathinfo($filePath, PATHINFO_EXTENSION) == 'txt') {
        header('Content-Type: text/plain');
        readfile($filePath);
        exit;
    }
    // Nếu là file ảnh thì hiển thị ảnh
    else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);
        
        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
} else {
    http_response_code(404);
    die('Error: File not found - ' . htmlspecialchars($filename));
}
?>