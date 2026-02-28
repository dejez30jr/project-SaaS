# 🛒 Multi-Tenant eCommerce Platform  
Laravel 11 + Vue 3 + Inertia.js + Multi-Database Tenancy

---

## 📖 Project Overview

This project is a **Multi-Tenant eCommerce Platform** built using:

- Laravel 11
- Vue.js 3
- Inertia.js
- stancl/tenancy (Multi-Database)

Each tenant (store) has:
- Dedicated database
- Isolated product data
- Isolated cart
- Isolated users

---

# 🏗 Architecture

Multi-Tenant Multi-Database approach:

- Each tenant has its own database
- Laravel dynamically switches database connection
- Data isolation is strictly enforced

---

# ⚙️ Installation Guide

## 1️⃣ Clone Repository

```bash
git clone https://github.com/yourusername/multi-tenant-ecommerce.git
cd multi-tenant-ecommerce
```

---

## 2️⃣ Install Dependencies

```bash
composer install
npm install
```

---

## 3️⃣ Setup Environment

Copy `.env` file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## 4️⃣ Configure Central Database

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=central_database
DB_USERNAME=root
DB_PASSWORD=
```

Create database manually in MySQL:

```
central_database
```

---

## 5️⃣ Run Central Migration

```bash
php artisan migrate
```

---

# 🏪 Multi-Tenant Setup

This project uses **stancl/tenancy** for multi-database tenancy.

When a new tenant registers:

- Tenant record is created
- New database is created automatically
- Tenant migrations are executed
- Domain is assigned

---

## Create Tenant Manually (Optional)

```bash
php artisan tinker
```

```php
Tenant::create([
    'id' => 'store1'
]);
```

---

## Access Tenant

Add this to your hosts file:

```
127.0.0.1 store1.localhost
```

Then access:

```
http://store1.localhost:8000
```

---

# 🛍 Features

## ✅ Authentication
- Tenant-based login
- User isolation per database

## ✅ Product Management
- Create product
- Edit product
- Delete product
- View product list

All products stored in tenant-specific database.

## ✅ Shopping Cart
- Add to cart
- Remove from cart
- Cart stored per tenant

## ✅ Dynamic Database Switching
Database automatically switches based on tenant context.

---

# 🧪 Running Tests

This project includes feature tests for:

- Tenant isolation
- Product CRUD
- Database switching

Run all tests:

```bash
php artisan test
```

Or:

```bash
vendor/bin/phpunit
```

---

## Example Test Case

```php
public function test_product_is_isolated_between_tenants()
{
    $tenantA = Tenant::create(['id' => 'storeA']);
    $tenantB = Tenant::create(['id' => 'storeB']);

    tenancy()->initialize($tenantA);
    Product::create(['name' => 'Product A']);

    tenancy()->initialize($tenantB);

    $this->assertDatabaseMissing('products', [
        'name' => 'Product A'
    ]);
}
```

---

# 🔐 Security

- Input validation
- CSRF protection
- Password hashing
- SQL injection protection via Eloquent ORM
- Database isolation per tenant

---

# 📦 GitHub Repository

Public repository:

```
https://github.com/yourusername/multi-tenant-ecommerce
```

---

# 📊 Evaluation Coverage

✔ Multi-database tenancy implemented  
✔ Data isolation validated  
✔ Product CRUD implemented  
✔ Shopping cart implemented  
✔ Vue frontend integrated  
✔ Dynamic database switching working  
✔ Unit & Feature tests added  
✔ Public GitHub repository uploaded  

---

# 🚀 Future Improvements

- Redis caching per tenant
- Role-based access control
- Payment gateway integration
- API versioning

---

# 🏁 Final Checklist Before Submission

- [ ] php artisan migrate works
- [ ] Tenant database auto-create works
- [ ] Data isolation confirmed
- [ ] php artisan test all PASS
- [ ] Repository public
- [ ] No hardcoded credentials
- [ ] README complete

---

# 👨‍💻 Author

Full Stack Developer Task Submission  
Laravel + Vue Multi-Tenant Architecture