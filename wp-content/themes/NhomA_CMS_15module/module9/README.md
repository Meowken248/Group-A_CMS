# Module 9: Categories (Khối Chuyên Mục)

- **Người thực hiện:** Bùi Nguyễn Minh Quân
- **Phân công:** Module 9 - Categories
- **Dự án:** CMS Nhóm A (WordPress 15 Modules) - FIT TDC

---

## 1. Giới Thiệu
Module 9 chịu trách nhiệm hiển thị khối danh mục (Categories) theo đúng thiết kế quy định:
- Tiêu đề **Categories** đậm nét, hiện đại.
- Thanh gạch sọc chéo trang trí (hatched/striped divider).
- Danh sách các mục có bullet tròn màu vàng/cam (`#f59e0b`).
- Tên chuyên mục màu xanh xám nhạt (`#64748b`), hover đổi màu mượt mà.
- Đường kẻ phân cách ngang giữa các chuyên mục.
- Tự động lấy danh mục từ WordPress CSDL (`get_categories()`) hoặc hiển thị mẫu chuẩn theo đề bài (`.Net Developer`, `Thực Tập Sinh Tester`, `Trợ giảng lập trình - Part time`).

---

## 2. Cấu Trúc Thư Mục Module 9
```text
module9/
├── module9.php    # Component chính, tự động tải CSS và hiển thị Categories
├── style.css      # CSS định kiểu riêng biệt cho Module 9 (không xung đột bên ngoài)
├── index.php      # File chạy xem trước trực quan (standalone preview)
└── README.md      # Tài liệu hướng dẫn tích hợp
```

---

## 3. Hướng Dẫn Tích Hợp Cho Nhóm
Bất kỳ thành viên nào trong nhóm muốn hiển thị Module 9 vào Sidebar hoặc trang của mình, chỉ cần gọi 1 dòng PHP:

```php
<?php include get_template_directory() . '/module9/module9.php'; ?>
```
Hoặc:
```php
<?php include 'module9/module9.php'; ?>
```

Module sẽ tự động nạp file `style.css` nội bộ trong thư mục `module9/` mà không cần sửa `functions.php` hay `style.css` gốc của theme.
