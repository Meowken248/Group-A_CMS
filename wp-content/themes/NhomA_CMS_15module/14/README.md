# Module 14: Comments (Tùy biến hiển thị danh sách bình luận TDC FIT)

## 1. Thông tin Module
- **Mã module**: Module 14
- **Tên module**: Comments (Bình luận bài viết)
- **Thực hiện**: Tuấn (Nhánh `Moudle/Tuan/14`)
- **Vị trí thư mục**: `wp-content/themes/NhomA_CMS_15module/14/`
- **Nguồn cảm hứng / Tham khảo**: Bootsnipp Bootstrap Comment List / Media Object

---

## 2. Mô tả yêu cầu đề bài (Theo hình mẫu của Giảng viên)
- **Trước chỉnh sửa**: 
  - Giao diện danh sách bình luận mặc định của WordPress (thô sơ, tiêu đề *"One response to Hello world!"*, font chữ nhỏ).
- **Sau chỉnh sửa**:
  - Tùy biến từng bình luận thành **Card giao diện Bootstrap** hiện đại và chuyên nghiệp:
    1. **Cột trái**: Khối avatar xám có icon người dùng chuẩn nhận diện theo mẫu.
    2. **Cột phải**: Họ tên tác giả in đậm (`John Doe`, `Jane Doe`) và nội dung bình luận chi tiết.
    3. **Hỗ trợ bình luận phân cấp lồng nhau (Nested / Child Comments)**: Bình luận phản hồi của `Jane Doe` được thụt lề thụt dòng (indent) sang phải so với bình luận gốc của `John Doe`.
    4. **Bình luận cấp 1 tiếp theo**: Bình luận của `John Doe` quay lại lề chuẩn bên trái.
  - Tích hợp Form gửi bình luận mới với đầy đủ xác thực thông tin (Họ tên, Email, Nội dung) và hỗ trợ trả lời bình luận (Reply action) mượt mà.

---

## 3. Cấu trúc cây thư mục (Đúng chuẩn thống nhất)
```text
wp-content/themes/NhomA_CMS_15module/
├── header.php            # Header chung ở ngoài thư mục gốc theme
├── footer.php            # Footer chung ở ngoài thư mục gốc theme
├── search.php            # Search page ở ngoài thư mục gốc theme
├── single.php            # Trang xem bài viết chi tiết tích hợp comments_template()
├── comments.php          # Template comments của theme gọi Module 14
├── page-module-14.php    # Page Template chuyên biệt cho Module 14
├── functions.php         # Đăng ký shortcodes [module_14_comments] và [module_14]
├── style.css             # Style chung của theme
└── 14/                   # Thư mục riêng của Module 14
    ├── test.php          # File logic hiển thị, đệ quy bình luận cha/con & HTML/CSS
    ├── setup_comments.php# Script tự động tạo 3 bình luận mẫu (John Doe, Jane Doe nested, John Doe)
    └── README.md         # Tài liệu hướng dẫn sử dụng Module 14
```

---

## 4. Cách kiểm thử và sử dụng
1. **Xem trực tiếp trên bài viết đơn**: Truy cập bài viết đầu tiên: [http://localhost:8088/?p=1](http://localhost:8088/?p=1).
2. **Sử dụng Page Template**: Tạo Trang mới trong WP Admin và chọn Template `Module 14 - Comments (Bình luận)`.
3. **Sử dụng Shortcode**: Chèn `[module_14_comments]` hoặc `[module_14]` vào bất kỳ bài viết/trang nào.
4. **Nạp lại dữ liệu mẫu**: Chạy lệnh `docker compose exec wordpress php wp-content/themes/NhomA_CMS_15module/14/setup_comments.php`.
