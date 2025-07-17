# POS & Inventory Management System

A web-based Point of Sale (POS) and Inventory Management System built with **Laravel** and **Livewire**, designed for small to medium-sized businesses to efficiently handle sales, purchases, inventory tracking, customer management, and more.

## 🔥 Features

- ✅ User authentication & roles  
- ✅ Product & category management  
- ✅ Inventory tracking  
- ✅ Customer & supplier management  
- ✅ Sales and purchase invoices  
- ✅ POS interface (Livewire powered)  
- ✅ Expense tracking  
- ✅ Stock in/out reporting  
- ✅ Responsive design (Bootstrap)

## 🛠️ Built With

- [Laravel](https://laravel.com/)  
- [Livewire](https://laravel-livewire.com/)  
- [Bootstrap 5](https://getbootstrap.com/)  
- [MySQL](https://www.mysql.com/)  
- [Spatie Permission](https://spatie.be/docs/laravel-permission)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/KeoChamraeun/POS-SYSTEM-DEMO.git
   cd pos-inventory-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   - Create a database (e.g., `pos_system`)
   - Update `.env` with your DB credentials
   ```bash
   php artisan migrate --seed
   ```

5. **Serve the app**
   ```bash
   php artisan serve
   ```

6. **Login credentials**
   ```
   Email: admin@example.com
   Password: 12345678
   ```# POS-SYSTEM-DEMO
