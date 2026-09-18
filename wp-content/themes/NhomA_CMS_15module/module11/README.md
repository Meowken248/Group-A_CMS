# Module 11: Archive (Lưu Trữ Bài Viết)

- **Người thực hiện:** Bùi Nguyễn Minh Quân
- **Phân công:** Module 11 - Archive (nhóm 6 sinh viên)
- **Dự án:** CMS Nhóm A (WordPress 15 Modules) - FIT TDC

---

## 1. Giới Thiệu
Module 11 chịu trách nhiệm hiển thị khối Lưu trữ bài viết (Archive) theo tháng/năm:
- Thiết kế dạng thẻ Card hiện đại, tông màu sáng tinh tế.
- Tiêu đề **"Archives"** kèm icon lịch và thanh phân cách sọc trang trí.
- Danh sách liên kết đến các tháng có bài viết kèm badge đếm số lượng bài viết.
- Tự động lấy dữ liệu từ WordPress (`wp_get_archives()`) hoặc hiển thị danh sách mẫu khi chưa có bài viết.
- Tích hợp chuẩn vào Widget Area **Footer #1** (`footer-1`) hoặc nhúng trực tiếp vào Sidebar Trái của Trang chủ (layout 3 cột).

---

## 2. Cấu Trúc Thư Mục Module 11
```text
module11/
├── module11.php   # Component chính, tự động nạp CSS và render khối Archive
├── style.css      # File CSS riêng biệt cho Module 11
├── index.php      # File chạy xem trước trực quan (standalone preview)
└── README.md      # Tài liệu hướng dẫn tích hợp
```

---

## 3. Hướng Dẫn Tích Hợp Cho Nhóm
Nhúng vào Trang chủ (Cột 1 bên trái) hoặc bất kỳ file nào:
```php
<?php include get_template_directory() . '/module11/module11.php'; ?>
```
Hoặc qua Widget trong WordPress Admin:
- Vào **Giao diện -> Widget**
- Thêm widget **Archives (Lưu trữ)** vào khu vực **Footer #1**.
