# Module 12: Comments (Bình Luận Mới Nhất)

- **Người thực hiện:** Bùi Nguyễn Minh Quân
- **Phân công:** Module 12 - Comments (nhóm 6 sinh viên)
- **Dự án:** CMS Nhóm A (WordPress 15 Modules) - FIT TDC

---

## 1. Giới Thiệu
Module 12 chịu trách nhiệm hiển thị khối Bình luận mới nhất (Recent Comments):
- Thiết kế dạng thẻ Card hiện đại, tông màu sáng tinh tế.
- Tiêu đề **"Comments"** kèm icon bình luận và thanh phân cách sọc trang trí tông hồng tím.
- Hiển thị thông tin từng bình luận:
  - Avatar tác giả bình luận (hoặc chữ cái đầu).
  - Tên tác giả và thời gian bình luận.
  - Đoạn trích dẫn nội dung bình luận ngắn gọn, xúc tích.
  - Tiêu đề bài viết được bình luận dẫn link trực tiếp tới bài viết đó.
- Tự động lấy dữ liệu từ WordPress (`get_comments()`) hoặc hiển thị danh sách mẫu khi chưa có bình luận.
- Tích hợp chuẩn vào Widget Area **Footer #2** (`footer-2`) hoặc nhúng trực tiếp vào Sidebar Phải của Trang chủ (layout 3 cột).

---

## 2. Cấu Trúc Thư Mục Module 12
```text
module12/
├── module12.php   # Component chính, tự động nạp CSS và render khối Comments
├── style.css      # File CSS riêng biệt cho Module 12
├── index.php      # File chạy xem trước trực quan (standalone preview)
└── README.md      # Tài liệu hướng dẫn tích hợp
```

---

## 3. Hướng Dẫn Tích Hợp Cho Nhóm
Nhúng vào Trang chủ (Cột 3 bên phải) hoặc bất kỳ file nào:
```php
<?php include get_template_directory() . '/module12/module12.php'; ?>
```
Hoặc qua Widget trong WordPress Admin:
- Vào **Giao diện -> Widget**
- Thêm widget **Recent Comments (Bình luận gần đây)** vào khu vực **Footer #2**.
