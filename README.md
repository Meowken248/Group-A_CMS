# Hướng Dẫn Chạy Dự Án Group-A_CMS Bằng Docker

Tài liệu này dành cho tất cả thành viên trong nhóm phát triển để cài đặt và chạy dự án WordPress CMS một cách đồng bộ, nhanh chóng bằng Docker trên mọi hệ điều hành (Windows, macOS, Linux).

---

## 📌 1. Yêu Cầu Tiên Quyết

Trước khi bắt đầu, đảm bảo máy tính của bạn đã cài đặt:
- **Git** ([Tải tại đây](https://git-scm.com/))
- **Docker Desktop** ([Tải tại đây](https://www.docker.com/products/docker-desktop/)) - Hãy chắc chắn Docker Desktop đang được bật (Status: `Running`).

---

## 🚀 2. Hướng Dẫn Khởi Động Nhanh (Quick Start)

Mỗi thành viên khi clone code về chỉ cần thực hiện **3 bước**:

### Bước 1: Clone mã nguồn về máy
```bash
git clone https://github.com/Meowken248/Group-A_CMS.git
cd Group-A_CMS
```

### Bước 2: Tạo file cấu hình môi trường `.env`
Nhóm đã chuẩn bị sẵn file mẫu `.env.example`. Hãy sao chép ra file `.env`:
- **Trên Windows PowerShell / CMD**:
  ```powershell
  copy .env.example .env
  ```
- **Trên macOS / Linux / Git Bash**:
  ```bash
  cp .env.example .env
  ```

> 💡 *Lưu ý: File `.env` chứa cấu hình riêng của từng máy và đã được đưa vào `.gitignore`, sẽ không bị đẩy lên Git làm ảnh hưởng đến các thành viên khác.*

### Bước 3: Khởi động hệ thống bằng Docker Compose
```bash
docker compose up -d
```
Lệnh này sẽ tự động tải các image (WordPress, MySQL 8.0, phpMyAdmin, WP-CLI) và khởi chạy toàn bộ hệ thống ngầm.

---

## 🌐 3. Địa Chỉ Truy Cập & Thông Tin Đăng Nhập

Sau khi chạy xong lệnh ở Bước 3, bạn có thể truy cập các dịch vụ:

| Dịch vụ | Địa chỉ truy cập | Tài khoản / Thông tin |
| :--- | :--- | :--- |
| **WordPress CMS** | [http://localhost:8088](http://localhost:8088) | Cài đặt ban đầu hoặc tài khoản đã setup |
| **phpMyAdmin** | [http://localhost:8089](http://localhost:8089) | **Server:** `db`<br>**User:** `group_a_user`<br>**Password:** `group_a_pass`<br>*(Hoặc User: `root` / Pass: `group_a_root_pass`)* |
| **MySQL Database** | `localhost:3308` | **DB Name:** `group_a_db`<br>**Host nội bộ:** `db:3306` |

---

## ⚙️ 4. Hướng Dẫn Đổi Port (Khi Bị Trùng Cổng)

Nếu cổng `8088`, `8089` hoặc `3308` trên máy của bạn đã được phần mềm khác sử dụng (hoặc bạn muốn dùng cổng khác như 80, 8080):
1. Mở file `.env` trên máy của bạn.
2. Thay đổi các biến cổng tương ứng:
   ```env
   WORDPRESS_PORT=8080
   PHPMYADMIN_PORT=8082
   DB_PORT=3307
   ```
3. Khởi động lại container:
   ```bash
   docker compose down
   docker compose up -d
   ```

---

## 🔄 5. Chia Sẻ & Đồng Bộ Cơ Sở Dữ Liệu Trong Nhóm

Để tất cả các thành viên có cùng một cơ sở dữ liệu mẫu:

### Cách 1: Tự động nạp CSDL khi khởi tạo lần đầu (Khuyên dùng)
- Đặt file export `.sql` (ví dụ: `database_seed.sql`) vào thư mục `docker/db-init/`.
- Khi một thành viên khởi động Docker lần đầu (hoặc sau khi reset volume), MySQL sẽ tự động import toàn bộ dữ liệu trong thư mục này.

### Cách 2: Nhập/Xuất qua giao diện phpMyAdmin
1. Mở [http://localhost:8089](http://localhost:8089).
2. Đăng nhập bằng tài khoản `group_a_user` / `group_a_pass`.
3. Chọn database `group_a_db` -> chọn thẻ **Import** hoặc **Export**.

---

## 🛠️ 6. Bảng Lệnh Thao Tác Thường Dùng

| Mục đích | Câu lệnh |
| :--- | :--- |
| **Khởi động các dịch vụ** | `docker compose up -d` |
| **Dừng các dịch vụ** | `docker compose stop` |
| **Tắt và xóa container** | `docker compose down` |
| **Reset toàn bộ dữ liệu database** | `docker compose down -v` rồi `docker compose up -d` |
| **Xem trạng thái container** | `docker compose ps` |
| **Xem log thời gian thực** | `docker compose logs -f` |
| **Xem log riêng của WordPress** | `docker compose logs -f wordpress` |
| **Chạy lệnh WP-CLI** | `docker compose run --rm wpcli <lệnh>` (Ví dụ: `docker compose run --rm wpcli plugin list`) |
| **Truy cập vào terminal WordPress** | `docker compose exec wordpress bash` |

---

## ⚠️ 7. Xử Lý Các Sự Cố Thường Gặp

### Lỗi 1: `bind: address already in use`
- **Nguyên nhân:** Cổng được chọn (ví dụ `8088` hoặc `8089`) đang bị chiếm bởi một ứng dụng khác trên máy.
- **Khắc phục:** Mở file `.env`, đổi `WORDPRESS_PORT` hoặc `PHPMYADMIN_PORT` sang một số khác (ví dụ `8090`, `8091`), rồi chạy lại `docker compose up -d`.

### Lỗi 2: "Error establishing a database connection"
- **Nguyên nhân:** MySQL container có thể đang trong quá trình khởi tạo dữ liệu ban đầu (thường mất 15-30 giây ở lần chạy đầu tiên).
- **Khắc phục:** Đợi khoảng 20-30 giây và F5 lại trang web. Kiểm tra trạng thái bằng lệnh:
  ```bash
  docker compose ps
  ```
  Nếu cột `STATUS` của `group_a_cms_db` báo `(healthy)`, kết nối đã sẵn sàng.

### Lỗi 3: Không upload được file dung lượng lớn
- Đã được cấu hình tự động qua file [docker/php/uploads.ini](file:///c:/Group-A_CMS/docker/php/uploads.ini) với giới hạn `64M`. Nếu cần tăng thêm, bạn có thể chỉnh sửa file này và chạy:
  ```bash
  docker compose restart wordpress
  ```

