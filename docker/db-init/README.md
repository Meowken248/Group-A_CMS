# Thư mục khởi tạo CSDL (Database Seed)

Các file có đuôi `.sql` hoặc `.sql.gz` đặt trong thư mục này sẽ được MySQL tự động chạy (import) khi container khởi động lần đầu tiên (khi volume dữ liệu chưa được tạo).

### Cách sử dụng cho team:
1. Khi có CSDL mẫu cần chia sẻ cho toàn bộ thành viên, export thành file `.sql` (ví dụ: `init.sql`) và đặt vào đây.
2. Thành viên mới chỉ cần chạy `docker compose up -d`, CSDL sẽ được nạp tự động, không cần cài đặt thủ công.
3. Nếu muốn chạy lại file init từ đầu:
   ```bash
   docker compose down -v
   docker compose up -d
   ```
   *(Lưu ý: lệnh trên sẽ xóa volume dữ liệu cũ và khởi tạo lại từ đầu)*

