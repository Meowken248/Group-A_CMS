# Module 10: Recent Post (Bài Viết Mới Nhất)

- **Người thực hiện:** Bùi Nguyễn Minh Quân
- **Phân công:** Module 10 - Recent Post
- **Dự án:** CMS Nhóm A (WordPress 15 Modules) - FIT TDC

---

## 1. Giới Thiệu
Module 10 chịu trách nhiệm hiển thị khối bài viết mới nhất (Recent post) theo đúng thiết kế quy định:
- Nền màu xanh ngọc / teal (`#45b4b4`) nổi bật.
- Badge ngày tháng cách điệu dạng phân số (Ngày / Tháng kèm gạch ngang và năm ở giữa: Ngày trên, Tháng dưới, `— 23` ở giữa).
- Tiêu đề bài viết màu trắng sắc nét, hiệu ứng hover mượt mà.
- Nút bấm **"XEM TẤT CẢ TIN TỨC"** ở chân card với tông màu đậm hơn (`#3ba3a3`).
- Tự động truy vấn bài viết mới nhất từ WordPress (`WP_Query`) hoặc hiển thị danh sách mẫu chuẩn 100% theo hình ảnh đề bài khi chưa có bài viết.

---

## 2. Cấu Trúc Thư Mục Module 10
```text
module10/
├── module10.php   # Component chính, tự động nạp CSS và render khối Recent Post
├── style.css      # File CSS riêng biệt cho Module 10 (không đụng bên ngoài)
├── index.php      # File chạy xem trước trực quan (standalone preview)
└── README.md      # Tài liệu hướng dẫn tích hợp
```

---

## 3. Hướng Dẫn Tích Hợp Cho Nhóm
Bất kỳ thành viên nào muốn nhúng Module 10 vào Sidebar hoặc trang chủ, chỉ cần gọi 1 dòng PHP:

```php
<?php include get_template_directory() . '/module10/module10.php'; ?>
```
Hoặc:
```php
<?php include 'module10/module10.php'; ?>
```

Module sẽ tự động nạp file `style.css` nội bộ trong thư mục `module10/` mà không cần sửa bất kỳ file gốc nào của theme.
