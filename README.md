# Service Booking System

A **Laravel 12** RESTful API for managing **services and bookings**.
The system has two roles:

- **Admin** → manages services and bookings.
- **User** → registers, logs in, views services, and books services.

---

## 🚀 Features

- User registration & authentication (Sanctum setup).
- Admin login/logout with protected endpoints.
- CRUD operations for **services**.
- Users can browse services and create bookings.
- Admin can manage and view all bookings.
- API follows REST standards with JSON responses.
- Ready-to-import **Postman collection** for testing.

---

## 📦 Tech Stack

- **Backend**: Laravel 12
- **Database**: MySQL
- **Auth**: Laravel Sanctum
- **Frontend Build**: Vite
- **Docs**: Postman Collection

---

## ⚙️ Installation

### 1. Clone the Repository

```
git clone https://github.com/mdsadid/Service-Booking.git
cd service-booking
```

### 2. Install Dependencies

```
composer install
npm install && npm run build
```

### 3. Environment Setup

Copy **.env.example** to **.env** and update DB credentials:

```
cp .env.example .env
```

Example .env snippet:

```
APP_NAME=ServiceBooking
APP_URL=http://service-booking.local

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=service_booking
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key

```
php artisan key:generate
```

### 5. Run Migrations & Seeders

```
php artisan migrate --seed
```

This will create tables and insert fake data.

### 6. Start Development Server

Laravel 12 provides a unified dev script:

```
composer run dev
```

This will:

- Run artisan serve (local API server)
- Run queue worker
- Run Vite dev server (for frontend assets)

Your API will now be available at:

```
http://127.0.0.1:8000
```

---

## 📖 API Documentation

- Import the file Service-Booking.postman_collection.json into Postman.
- Set {{baseURL}} to your local server (default: http://127.0.0.1:8000).
- Use variables {{admin_token}} and {{user_token}} for authentication.
