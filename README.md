# 🥬 XÂY DỰNG WEBSITE BÁN RAU CỦ BẰNG LARAVEL

**Sinh viên thực hiện:** Huỳnh Khánh Duy  
**Lớp:** DA22TTD  
**MSSV:** 110122059  
**Đề tài:** Xây dựng website bán rau củ bằng Laravel  

---

## 📖 Giới thiệu

Dự án **Website bán rau củ** được xây dựng nhằm đáp ứng nhu cầu mua sắm thực phẩm tươi sạch ngày càng tăng của người tiêu dùng.  
Hệ thống cho phép khách hàng dễ dàng xem sản phẩm, đặt hàng trực tuyến, quản lý đơn hàng; đồng thời hỗ trợ quản trị viên quản lý danh mục, sản phẩm, đơn hàng và người dùng một cách hiệu quả.

Website được phát triển trên nền tảng **Laravel Framework**, đảm bảo tính bảo mật, khả năng mở rộng và dễ bảo trì.

---

## 🔧 Công nghệ sử dụng

- **Back-end:** Laravel (PHP Framework)
- **Front-end:** Blade Template, HTML, CSS, JavaScript, Bootstrap
- **Database:** MySQL
- **Authentication:** Laravel Auth
- **Payment:** PayPal
- **Web Server:** Apache (XAMPP)

---

## 🛠️ Yêu cầu cài đặt

- PHP >= 8.0  
- Composer  
- MySQL  
- Git  
- XAMPP / Laragon / WAMP  

---

## 🚀 Hướng dẫn cài đặt & chạy dự án

### 1️⃣ Clone dự án
```bash
git clone https://github.com/HuynhKhanhDuy2912/cn-da22ttd-huynhkhanhduy-websitebanraucu-laravel.git
cd cn-da22ttd-huynhkhanhduy-websitebanraucu-laravel/scr
```
### 2️⃣ Cài đặt thư viện Laravel
```bash
composer install
```
### 3️⃣ Cấu hình môi trường (.env)
Tạo file .env từ file mẫu:
```bash
cp .env.example .env
```
Cấu hình các thông tin trong file .env:
```env
#---CẤU HÌNH SERVER---
APP_NAME=Laravel
APP_ENV=local
APP_KEY= key_ban_da_tao
APP_DEBUG=true
APP_URL=http://localhost

#---KẾT NỐI DATABASE---
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_csdl
DB_USERNAME=root
DB_PASSWORD=

#---GỬI MAIL---
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email_cua_ban@gmail.com
# Lưu ý: Đây là App Password (mật khẩu ứng dụng), không phải mật khẩu đăng nhập Gmail
MAIL_PASSWORD=mat_khau_16_ky_tu
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email_cua_ban@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

#---THANH TOÁN PAYPAL (Môi trường Sandbox)---
PAYPAL_MODE=sandbox
PAYPAL_CLIENT_ID=paypal_client_id_cua_ban
PAYPAL_CLIENT_SECRET=paypal_client_secret_cua_ban
```
Tạo key cho ứng dụng:
```bash
php artisan key:generate
````
### 4️⃣ Tạo Database & Migration
Tạo database tên (giống với tên DB_DATABASE=ten_csdl) trong MySQL <br>
Chạy migrate:
```bash
php artisan migrate
```
Chạy dữ liệu mẫu
```bash
php artisan db:seed
```
### 5️⃣ Tạo liên kết storage (upload ảnh)
```bash
php artisan storage:link
```
### 6️⃣ Chạy ứng dụng
```bash
php artisan serve
```
➡️ Truy cập website tại:
http://localhost:8000

---

### 📝 Một số lệnh quan trọng

| Chức năng | Lệnh |
|---------|------|
| Cài thư viện | `composer install` |
| Tạo key ứng dụng | `php artisan key:generate` |
| Chạy migrate database | `php artisan migrate` |
| Seed dữ liệu mẫu | `php artisan db:seed` |
| Tạo liên kết storage | `php artisan storage:link` |
| Chạy server Laravel | `php artisan serve` |

---
### 📩 Thông tin liên hệ

- **Sinh viên:** Huỳnh Khánh Duy  
- **Lớp:** DA22TTD  
- **Email:** duy2912www@gmail.com  
- **GitHub:** https://github.com/HuynhKhanhDuy2912
---
*© 2025 Huỳnh Khánh Duy - 110122059 - DA22TTD.*

