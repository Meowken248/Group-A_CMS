# Module 11: Archives / Bài viết mới nhất (Phong cách VnExpress "Xem nhiều")

**Sinh viên thực hiện:** Bùi Nguyễn Minh Quân  
**Học phần:** Hệ quản trị nội dung (CMS) - Nhóm A  
**Vị trí hiển thị:** Cột Sidebar trái (`col-lg-3`) trên Trang chủ (`index.php`), Widget `Footer #1` hoặc hiển thị độc lập.

---

## 1. Giới thiệu Module
Module 11 được thiết kế lại hoàn toàn dựa trên khối **"Xem nhiều"** của báo điện tử **VnExpress** kết hợp chức năng **Archives / Bài viết mới nhất** theo đúng yêu cầu đề bài của Giảng viên:
- Số thứ tự lớn (`1` đến `8`) định dạng font Serif cổ điển (`Merriweather` / `Georgia`) đậm nét.
- Tiêu đề tin bài chuẩn phong cách báo chí, liên kết đổi màu đỏ VnExpress `#9f224e` khi hover.
- Hiển thị số lượt bình luận bài viết kèm biểu tượng trao đổi 💬.
- Hỗ trợ linh hoạt 2 chế độ dữ liệu qua nút chuyển tab:
  1. **Bài viết mới nhất**: Tự động truy vấn 8 bài viết mới nhất từ CSDL WordPress (`get_posts`), dự phòng bằng danh sách bài viết mẫu từ ảnh yêu cầu.
  2. **Archives ngày tháng**: Hiển thị danh sách lưu trữ bài viết theo từng tháng (`wp_get_archives`).
- Thiết kế responsive thích ứng thông minh: tự động hiển thị 2 cột trên màn hình rộng hoặc trang demo độc lập, và co về 1 cột gọn gàng khi đặt vào Sidebar hẹp của theme.

---

## 2. Cấu trúc thư mục
```
module11/
├── module11.php     # Mã nguồn chính của Module 11
├── style.css        # CSS phong cách VnExpress, Big Number Serif và Responsive
├── index.php        # File chạy thử nghiệm độc lập (Standalone Runner)
└── README.md        # Tài liệu hướng dẫn sử dụng và kiểm thử
```

---

## 3. Cách sử dụng

### 3.1. Chạy thử nghiệm độc lập
Truy cập qua trình duyệt web:
```
http://localhost/Group-A_CMS/wp-content/themes/NhomA_CMS_15module/module11/index.php
```

### 3.2. Nhúng vào Theme hoặc Trang bất kỳ
Sử dụng Shortcode:
```php
[module_11]
// hoặc
[module_11_archive]
```
Hoặc gọi trực tiếp trong code PHP:
```php
include get_template_directory() . '/module11/module11.php';
```
