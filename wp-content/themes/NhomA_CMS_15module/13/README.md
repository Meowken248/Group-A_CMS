# Module 13: Pages (Danh sách trang đào tạo FIT TDC)

## 1. Thông tin Module
- **Mã module**: Module 13
- **Tên module**: Pages (Trang)
- **Thực hiện**: Tuấn (Nhánh `Moudle/Tuan/13`)
- **Vị trí thư mục**: `wp-content/themes/NhomA_CMS_15module/13/`

---

## 2. Mô tả yêu cầu đề bài (Theo hình mẫu và ghi chú GV)
- **Trước chỉnh sửa**: Widget mặc định của WordPress hiển thị tiêu đề `Pages` và danh sách dạng liên kết chữ thô sơ (`Sample Page`).
- **Sau chỉnh sửa**:
  - Tùy biến hiển thị danh sách các **Trang (Pages)** với đầy đủ:
    1. **Tiêu đề trang** (Title)
    2. **Ảnh đại diện** (Featured Image)
    3. **Tóm tắt nội dung** (Excerpt / Content)
  - **Bố cục hiển thị theo ghi chú GV**:
    > *"Module số 13: theo hình chụp là: 3 bài viết trên 1 dòng. Theo như vị trí hiển thị: thì SV hãy cho nó rớt dòng (dạng responsive). Như vậy mỗi dòng: 1 bài viết (Hình đứng dạng cột)."*
  - Hỗ trợ linh hoạt cả 2 chế độ xem:
    - **Hình đứng dạng cột (Mỗi dòng 1 bài viết)**: Chuẩn theo yêu cầu của GV khi đặt ở sidebar hoặc giao diện responsive.
    - **Dạng lưới 3 cột (Grid)**: Xem dạng ngang 3 bài viết / dòng khi có không gian rộng.

---

## 3. Cấu trúc cây thư mục (Đúng chuẩn thống nhất)
```text
wp-content/themes/NhomA_CMS_15module/
├── header.php            # Header chung ở ngoài thư mục gốc theme
├── footer.php            # Footer chung ở ngoài thư mục gốc theme
├── search.php            # Search page ở ngoài thư mục gốc theme
├── index.php             # Trang chủ nạp Module 13
├── page-module-13.php    # Page Template chuyên biệt cho Module 13
├── functions.php         # Khai báo hỗ trợ thumbnail, excerpt và shortcode
├── style.css             # Style chung của theme
└── 13/                   # Thư mục riêng của Module 13
    ├── test.php          # File xử lý logic, truy vấn WP_Query và giao diện HTML/CSS
    ├── setup_data.php    # Script tự động tạo 3 trang mẫu và gán ảnh đại diện
    ├── README.md         # Tài liệu hướng dẫn sử dụng Module 13
    └── images/           # Thư mục chứa hình ảnh minh họa cho 3 ngành
        ├── cntt.jpg
        ├── mang-may-tinh.jpg
        └── thiet-ke-do-hoa.jpg
```

---

## 4. Cách sử dụng và kiểm thử
1. **Xem trực tiếp trên trang chủ**: Truy cập `http://localhost:8088/` (hoặc `http://wordpress.local/`).
2. **Sử dụng Shortcode**: Có thể chèn `[module_13_pages]` hoặc `[module_13]` vào bất kỳ bài viết hoặc trang nào.
3. **Sử dụng Page Template**: Tạo Trang mới trong WP Admin và chọn Template `Module 13 - Pages (Trang đào tạo)`.
4. **Nạp dữ liệu mẫu**: Chạy lệnh `docker compose exec wordpress php wp-content/themes/NhomA_CMS_15module/13/setup_data.php`.
