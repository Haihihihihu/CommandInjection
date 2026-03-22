<?php
// ╔════════════════════════════════════════════════════════════════╗
// ║  FILE NÀY CHỨA THÔNG TIN NHẠY CẢM - KHÔNG BAO GIỜ COMMIT LÊN  ║
// ║  VCS (Git, SVN...) HOẶC SHARE PUBLICLY!                        ║
// ╚════════════════════════════════════════════════════════════════╝

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'ecommerce_db');
define('DB_USER', 'root');
define('DB_PASS', 'SuperSecret@123!Cybershop2024');
define('DB_PORT', '3306');

// API Keys
define('STRIPE_SECRET_KEY', 'sk_live_51HxYz...AbCdEf1234567890');
define('PAYPAL_CLIENT_ID', 'AZabc123...XyZ789');
define('PAYPAL_SECRET', 'EH_secret_abc123...xyz789');

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'admin@cybershop.com');
define('SMTP_PASS', 'EmailPassword@2024!');

// Admin Credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'Admin@Cyber$hop2024');
define('ADMIN_EMAIL', 'admin@cybershop.com');

// Security Keys
define('JWT_SECRET', 'your-super-secret-jwt-key-here-change-in-production');
define('ENCRYPTION_KEY', 'aes-256-encryption-key-32chars!');
define('SALT', 'random_salt_for_password_hashing_12345');

// AWS Credentials
define('AWS_ACCESS_KEY', 'AKIAIOSFODNN7EXAMPLE');
define('AWS_SECRET_KEY', 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY');
define('AWS_REGION', 'us-east-1');
define('S3_BUCKET', 'cybershop-uploads');

// Application Settings
define('APP_ENV', 'production');
define('DEBUG_MODE', false);
define('APP_SECRET', 'app-secret-key-change-this-in-production-xyz123');

// Session Configuration
define('SESSION_LIFETIME', 3600); // 1 hour
define('SESSION_SECRET', 'session-secret-key-abc123xyz');

// Other Sensitive Data
define('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI');
define('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe');

// Internal API Endpoints
define('INTERNAL_API_URL', 'http://internal-api.cybershop.local');
define('INTERNAL_API_KEY', 'internal-api-key-secret-123abc');

// Backup Credentials
define('BACKUP_FTP_HOST', 'backup.cybershop.com');
define('BACKUP_FTP_USER', 'backup_user');
define('BACKUP_FTP_PASS', 'BackupPassword@2024!');

// ╔════════════════════════════════════════════════════════════════╗
// ║  CẢNH BÁO: NẾU FILE NÀY BỊ LỘ, ATTACKER CÓ THỂ:              ║
// ║  - Truy cập database và dump toàn bộ dữ liệu                  ║
// ║  - Login vào admin panel                                       ║
// ║  - Sử dụng API keys để giao dịch tài chính                    ║
// ║  - Truy cập AWS và xóa/tải dữ liệu                            ║
// ║  - Đọc email và gửi email giả mạo                             ║
// ║  - Kiểm soát toàn bộ hệ thống                                 ║
// ╚════════════════════════════════════════════════════════════════╝
?>
