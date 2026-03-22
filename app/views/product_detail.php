<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $product['name'] ?> | CyberShop</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <style>
        .stock-checker {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .stock-form {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 15px;
        }
        .stock-form select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .stock-form button {
            padding: 10px 20px;
            background: #007185;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .stock-form button:hover {
            background: #005a6d;
        }
        #stockResult {
            margin-top: 15px;
            padding: 10px;
            background: white;
            border-radius: 4px;
            font-weight: bold;
            color: #28a745;
            display: none;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🛒 CyberShop</h1>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
            <a href="/order">📦 Tra vận đơn</a>
        </div>
    </div>

    <div class="product-detail">
        <div class="product-img">
            <!-- KỊCH BẢN 2: Image từ /var/www/images/ qua endpoint /image?filename= -->
            <a href="/image?filename=product<?= $productId ?>.jpg" target="_blank" style="display: block; width: 100%; height: 100%;">
                <img src="/image?filename=product<?= $productId ?>.jpg" 
                     alt="<?= $product['name'] ?>" 
                     style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
                     title="Click to view full image">
                <div style="display: none; width: 100%; height: 100%; align-items: center; justify-content: center; flex-direction: column; color: #666;">
                    <div style="font-size: 80px;">📦</div>
                    <p style="margin-top: 20px;">Product Image</p>
                </div>
            </a>
        </div>
        <div class="product-info">
            <h2><?= $product['name'] ?></h2>
            <p class="price" style="font-size: 24px; color: #007185; margin: 15px 0;"><?= $product['price'] ?></p>
            <div class="specs">
                <p><strong>📋 Mô tả:</strong> <?= $product['desc'] ?></p>
                <p><strong>🏷️ Mã sản phẩm:</strong> <?= $productId ?></p>
                <p><strong>✅ Bảo hành:</strong> 12 tháng</p>
            </div>
            
            <!-- KỊCH BẢN 1: In-band Command Injection -->
            <div class="stock-checker">
                <h3 style="margin: 0 0 10px 0; color: #232f3e;">📊 Check Stock</h3>
                <p style="color: #666; font-size: 14px;">Check product availability at store location</p>
                
                <form class="stock-form" id="stockForm">
                    <input type="hidden" name="productId" value="<?= $productId ?>">
                    <select name="storeId" required>
                        <option value="">Select location</option>
                        <option value="1">London</option>
                        <option value="2">Paris</option>
                        <option value="3">Milan</option>
                        <option value="4">New York</option>
                    </select>
                    <button type="submit">Check stock</button>
                </form>
                
                <div id="stockResult"></div>
            </div>
        </div>
    </div>

    <script>
        // KỊCH BẢN 1: Stock checker
        document.getElementById('stockForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const resultDiv = document.getElementById('stockResult');
            
            // Chuyển FormData sang URLSearchParams để dùng application/x-www-form-urlencoded
            const urlEncodedData = new URLSearchParams(formData).toString();
            
            fetch('/product/stock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: urlEncodedData
            })
            .then(response => response.text())
            .then(data => {
                resultDiv.textContent = data;
                resultDiv.style.display = 'block';
            })
            .catch(error => {
                resultDiv.textContent = 'Error checking stock';
                resultDiv.style.display = 'block';
            });
        });
    </script>

    <footer>
        <p>&copy; 2026 CyberShop E-commerce Demo</p>
    </footer>
</body>
</html>