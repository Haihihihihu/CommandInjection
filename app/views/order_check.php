<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kiểm tra đơn hàng - KỊCH BẢN 1: In-band</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="navbar">
        <h1>📦 Tra cứu vận đơn</h1>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
            <a href="/stock">Kiểm tra kho</a>
        </div>
    </div>

    <div class="form-container">
        <h2 style="text-align: center; color: #007185;">🚚 Theo dõi đơn hàng</h2>
        <p style="text-align: center; color: #666;">Nhập mã vận đơn để kiểm tra vị trí gói hàng của bạn</p>
        
        <form action="/order/check" method="POST">
            <div class="form-group">
                <label>📋 Mã vận đơn:</label>
                <input type="text" name="order_id" placeholder="Ví dụ: VNP123456, DHL789" required>
            </div>
            <button type="submit" class="btn-submit">🔍 Tra cứu ngay</button>
        </form>

        <?php if(isset($result) && !empty($result)): ?>
            <div style="margin-top: 25px; background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #007185;">
                <strong style="color: #232f3e; font-size: 16px;">📊 KẾT QUẢ TỪ HỆ THỐNG LOGISTICS:</strong>
                <pre style="margin-top: 15px; background: #ffffff; padding: 15px; border-radius: 5px; border: 1px solid #dee2e6; font-family: 'Courier New', monospace; color: #212529; overflow-x: auto;"><?= htmlspecialchars($result) ?></pre>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2026 CyberShop - Hệ thống theo dõi vận chuyển</p>
    </footer>
</body>
</html>