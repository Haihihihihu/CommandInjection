<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi phản hồi - KỊCH BẢN 2: Blind Command Injection</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="navbar">
        <h1>📧 Gửi phản hồi</h1>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
        </div>
    </div>

    <div class="form-container">
        <h2 style="text-align: center; color: #007185;">Customer Feedback</h2>
        <p style="text-align: center; color: #666;">We value your feedback! Please fill out the form below.</p>
        
        <form action="/feedback/send" method="POST">
            <div class="form-group">
                <label>Your Name:</label>
                <input type="text" name="name" placeholder="John Doe" required>
            </div>
            
            <div class="form-group">
                <label>Your Email:</label>
                <input type="text" name="email" placeholder="example@email.com" required>
                <small style="color: #666; display: block; margin-top: 5px;">
                    💡 We'll send you a confirmation email
                </small>
            </div>
            
            <div class="form-group">
                <label>Message:</label>
                <textarea name="message" rows="5" placeholder="Your feedback here..."></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Send Feedback</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2026 CyberShop - Customer Support</p>
    </footer>
</body>
</html>