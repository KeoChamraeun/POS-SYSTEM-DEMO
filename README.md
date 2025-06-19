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
   git clone https://github.com/forid1026/pos-inventory-system.git
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
   Password: password
   ```

## 📸 Screenshots

### POS Screen

![POS Screen](https://i.ibb.co/B2SpkfyM/pos-ui.png)

_Add more screenshots of the dashboard and inventory views here as needed._

## 🧪 Testing

To run tests:
```bash
php artisan test
```

## 📂 Folder Structure Highlights

- `app/Http/Livewire`: POS and dynamic components  
- `resources/views`: Blade templates  
- `database/seeders`: Demo data and roles setup  

## 🙋‍♂️ Author

**Sheikh Forid**  
[🔗 LinkedIn](https://www.linkedin.com/in/forid1026)  
💼 *Portfolio: coming soon*

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
