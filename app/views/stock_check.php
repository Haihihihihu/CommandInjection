<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kiểm tra tồn kho - KỊCH BẢN 1: In-band Command Injection</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="navbar">
        <h1>📊 Kiểm tra tồn kho</h1>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
            <a href="/order">Tra vận đơn</a>
        </div>
    </div>

    <div class="form-container">
        <h2 style="text-align: center; color: #007185;">🏢 Stock Inventory System</h2>
        <p style="text-align: center; color: #666;">Enter Store ID to check product inventory</p>
        
        <form action="/stock/check" method="POST">
            <div class="form-group">
                <label>Store ID:</label>
                <input type="text" name="storeID" placeholder="Example: 1, 2, 3..." required>
                <small style="color: #666; display: block; margin-top: 5px;">
                    💡 Try: 1 (Main Store), 2 (Branch A), 3 (Branch B)
                </small>
            </div>
            <button type="submit" class="btn-submit">🔍 Check Inventory</button>
        </form>

        <?php if(isset($result) && !empty($result)): ?>
            <div style="margin-top: 25px; background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #28a745;">
                <strong style="color: #232f3e; font-size: 16px;">📦 OUTPUT FROM SYSTEM:</strong>
                <pre style="margin-top: 15px; background: #1e1e1e; color: #00ff00; padding: 15px; border-radius: 5px; font-family: 'Courier New', monospace; overflow-x: auto;"><?= $result ?></pre>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2026 CyberShop - Inventory Management System</p>
    </footer>
</body>
</html>
