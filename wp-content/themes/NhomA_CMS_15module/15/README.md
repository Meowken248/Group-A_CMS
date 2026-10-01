# Module 15: Last posts (Simple Vertical Timeline - Bootsnipp xrKXW)

## 1. Thông tin Module
- **Mã module**: Module 15
- **Tên module**: Last posts (Bài viết mới nhất)
- **Thực hiện**: Tuấn (Nhánh `Moudle/Tuan/15`)
- **Vị trí thư mục**: `wp-content/themes/NhomA_CMS_15module/15/`
- **Nguồn cảm hứng / Tham khảo**: Bootsnipp Simple Vertical Timeline (`https://bootsnipp.com/snippets/xrKXW`)

---

## 2. Mô tả yêu cầu đề bài (Theo hình mẫu trong PDF)
- **Trước chỉnh sửa**: 
  - Widget mặc định `Bài viết mới nhất` của WordPress hiển thị danh sách dạng văn bản thuần túy.
- **Sau chỉnh sửa**:
  - Tiêu đề khối: **`Latest News`**
  - Hiển thị theo dạng **Timeline dọc (Simple Vertical Timeline)**:
    1. Đường kẻ dọc nối liền các sự kiện bài viết.
    2. Các nút tròn viền xanh cyan (`#22c0e8` / `#005baa`) rỗng nền trắng.
    3. Tiêu đề bài viết kèm liên kết (Link).
    4. Ngày tháng đăng bài canh phải (`Float right`).
    5. Tóm tắt nội dung bài viết (`Excerpt`).

---

## 3. Cấu trúc cây thư mục (Thống nhất toàn theme)
```text
wp-content/themes/NhomA_CMS_15module/
├── header.php            # Header chung ở ngoài thư mục gốc theme
├── footer.php            # Footer chung ở ngoài thư mục gốc theme
├── search.php            # Search page ở ngoài thư mục gốc theme
├── single.php            # Trang xem bài viết chi tiết tích hợp comments_template()
├── comments.php          # Template comments của theme gọi Module 14
├── page-module-13.php    # Page Template chuyên biệt cho Module 13
├── page-module-14.php    # Page Template chuyên biệt cho Module 14
├── page-module-15.php    # Page Template chuyên biệt cho Module 15
├── functions.php         # Đăng ký shortcode [module_15_last_posts] và [module_15]
├── 13/                   # Thư mục Module 13 (Pages)
├── 14/                   # Thư mục Module 14 (Comments)
└── 15/                   # THƯ MỤC MODULE 15 (LAST POSTS)
    ├── test.php          # File logic hiển thị timeline & HTML/CSS
    └── README.md         # Tài liệu hướng dẫn sử dụng Module 15
```

---

## 4. Cách sử dụng và kiểm thử
1. **Kiểm thử trực tiếp qua Page Template**: Chọn template `Module 15 - Last Posts (Bài viết mới nhất)` khi tạo trang.
2. **Kiểm thử qua Shortcode**: Chèn `[module_15_last_posts]` hoặc `[module_15]` vào bất kỳ bài viết hoặc trang nào.
3. **Nạp vào sidebar hoặc trang chủ**: Sử dụng `include get_template_directory() . '/15/test.php';`.
