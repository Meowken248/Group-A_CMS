# Module wedget_test_4: Chân Trang Báo Thanh Niên (Footer Thanh Niên)

## 1. Thông tin Module
- **Mã module**: `wedget_test_4` (Module 4 Footer)
- **Tên module**: Chân Trang Báo Thanh Niên (Thanh Niên Footer & Database Integration)
- **Thực hiện**: Lê Anh Tuấn
- **Vị trí thư mục**: `wp-content/themes/NhomA_CMS_15module/wedget_test_4/`
- **Khu vực hiển thị**: **Phía trên Footer** (Xuất hiện đồng bộ tại: Trang chủ, Trang danh sách, Trang chi tiết)

---

## 2. Mô tả yêu cầu đề bài
1. **Giao diện chuẩn Báo Thanh Niên (thanhnien.vn)**:
   - Thanh trên:
     - Logo thương hiệu **THANH NIÊN** và khẩu hiệu **DIỄN ĐÀN CỦA HỘI LIÊN HIỆP THANH NIÊN VIỆT NAM**.
     - Menu điều hướng: Đặt báo, Quảng cáo, RSS, Tòa soạn, Chính sách bảo mật.
     - Mạng xã hội: Facebook, Zalo, YouTube với hiệu ứng hover màu thương hiệu.
   - Đường kẻ phân cách.
   - Khối dưới 3 cột:
     - Cột 1: Hotline (`0906 645 777`) và Liên hệ quảng cáo (`0908 780 404`).
     - Cột 2: Ban biên tập 5 dòng (Tổng biên tập, Phó TBT thường trực, 2 Phó TBT, Tổng thư ký tòa soạn).
     - Cột 3: Giấy phép xuất bản số 110/GP - BTTTT, bản quyền 2003-2026 và Huy hiệu chứng nhận **NCSC CƠ BẢN - Tín Nhiệm Mạng**.

2. **Kết nối Database MariaDB / MySQL**:
   - Bảng cơ sở dữ liệu: `wp_thanhnien_footer_settings`.
   - Lưu trữ toàn bộ 24 trường dữ liệu động.
   - Hỗ trợ trang Quản trị WP-Admin (`Giao diện > Footer Thanh Niên (DB)`) để chỉnh sửa thông số trực tiếp trong Database với CSRF Nonce và sanitize.

3. **Vị trí hiển thị**:
   - **Khu vực hiển thị: Phía trên Footer**
   - Tự động hiển thị đồng bộ ở cả 3 nơi:
     - **Trang chủ** (`index.php`)
     - **Trang danh sách** (`search.php`, `archive.php`)
     - **Trang chi tiết bài viết** (`single.php`)

---

## 3. Cấu trúc cây thư mục
```text
wp-content/themes/NhomA_CMS_15module/wedget_test_4/
├── test.php                  # File hiển thị giao diện & gọi dữ liệu DB
├── setup_data.php            # Script tự động tạo bảng và nạp dữ liệu mẫu
├── class-thanhnien-db.php    # Lớp kết nối Database & xử lý CRUD ($wpdb)
├── class-thanhnien-admin.php # Trang quản trị WP-Admin chỉnh sửa cấu hình DB
├── class-thanhnien-widget.php# Custom Widget kéo thả WordPress
├── README.md                 # Tài liệu hướng dẫn sử dụng module
└── screenshot.png            # Ảnh xem trước giao diện module
```

---

## 4. Hướng dẫn sử dụng & kiểm tra
1. Chạy script nạp dữ liệu (nếu cần thủ công):
   ```bash
   php wp-content/themes/NhomA_CMS_15module/wedget_test_4/setup_data.php
   ```
2. Xem ngoài web:
   - Truy cập `http://wordpress.local` để xem hiển thị ở Trang chủ, Danh sách bài viết hoặc Chi tiết bài viết.
3. Chỉnh sửa dữ liệu:
   - Vào WP-Admin > **Giao diện > Footer Thanh Niên (DB)** để chỉnh sửa.
