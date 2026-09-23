# Module 12: Comments Component (Phong cách el.tdc.edu.vn)

**Sinh viên thực hiện:** Bùi Nguyễn Minh Quân  
**Học phần:** Hệ quản trị nội dung (CMS) - Nhóm A  
**Vị trí hiển thị:** Cột Sidebar phải (`col-lg-3`) trên Trang chủ (`index.php`), Widget `Footer #2` hoặc hiển thị độc lập.

---

## 1. Giới thiệu Module
Module 12 được hiện thực theo khối **Comments** của hệ thống đào tạo điện tử **el.tdc.edu.vn**:
- Tiêu đề **Comments** trang nhã với đường kẻ phân cách đặc trưng phía dưới.
- Danh sách bình luận dạng tối giản, liên kết màu xanh học thuật `#0066cc`, đổi màu và gạch chân khi hover.
- Ngăn cách rõ ràng giữa từng dòng bình luận bằng đường viền phẳng nhẹ nhàng.
- Tự động lấy các bình luận được duyệt mới nhất từ WordPress (`get_comments`), liên kết trực tiếp tới vị trí bình luận trên bài viết.
- Có sẵn bộ dữ liệu mẫu khớp 100% với ảnh đề bài: *"Bài viết hay quá"*, *"Cảm ơn tác giả"*, *"Bài viết thật hữu ích"*.

---

## 2. Cấu trúc thư mục
```
module12/
├── module12.php     # Mã nguồn chính của Module 12
├── style.css        # CSS phong cách el.tdc.edu.vn tối giản và tinh tế
├── index.php        # File chạy thử nghiệm độc lập (Standalone Runner)
└── README.md        # Tài liệu hướng dẫn sử dụng và kiểm thử
```

---

## 3. Cách sử dụng

### 3.1. Chạy thử nghiệm độc lập
Truy cập qua trình duyệt web:
```
http://localhost/Group-A_CMS/wp-content/themes/NhomA_CMS_15module/module12/index.php
```

### 3.2. Nhúng vào Theme hoặc Trang bất kỳ
Sử dụng Shortcode:
```php
[module_12]
// hoặc
[module_12_comments]
```
Hoặc gọi trực tiếp trong code PHP:
```php
include get_template_directory() . '/module12/module12.php';
```
