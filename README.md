# 🏫 نظام إدارة المدرسة — School Management System

نظام متكامل لإدارة المدارس مبني بـ **Laravel** و **Filament**، يغطي جميع العمليات الأكاديمية والمالية والإدارية.

---

## 📸 Screenshots

### صفحة تسجيل الدخول
![Login](school-management-system/screenshots/login.jpg)

### السنوات الدراسية
![Academic Years](school-management-system/screenshots/academic-years-3.jpg)

### فواتير الرسوم
![Fee Invoices](school-management-system/screenshots/fees-invoices-2.jpg)

---

## ✨ المميزات

- 📅 **إدارة السنوات الدراسية** — إنشاء وتتبع السنوات الدراسية النشطة
- 🏫 **الصفوف والشعب** — إدارة الفصول الدراسية والسعات
- 👨‍🏫 **المعلمون** — ملفات المعلمين والتخصصات
- 👨‍👧 **أولياء الأمور والطلاب** — ربط الطلاب بأولياء أمورهم
- 📝 **التسجيلات** — تسجيل الطلاب في الفصول
- 📊 **التقييمات والدرجات** — تتبع الأداء الأكاديمي
- ✅ **الحضور** — تسجيل حضور وغياب الطلاب
- 💰 **الفواتير والمدفوعات** — إدارة الرسوم المالية
- 👥 **إدارة المستخدمين** — أدوار متعددة (مدير، محاسب، معلم)

---

## 🛠️ التقنيات المستخدمة

| التقنية | الوصف |
|---|---|
| Laravel 11 | إطار العمل الرئيسي |
| Filament 3 | لوحة التحكم |
| PHP 8.2+ | لغة البرمجة |
| MySQL | قاعدة البيانات |
| Tailwind CSS | التصميم |
| Vite | بناء الأصول |

---

## 🚀 التثبيت

```bash
# 1. استنساخ المشروع
git clone https://github.com/zeyadalameri/school-management-system.git
cd school-management-system/school-management-system

# 2. تثبيت التبعيات
composer install
npm install

# 3. إعداد البيئة
cp .env.example .env
php artisan key:generate

# 4. إعداد قاعدة البيانات في .env
# DB_DATABASE=school_db
# DB_USERNAME=root
# DB_PASSWORD=

# 5. تشغيل Migrations والـ Seeders
php artisan migrate --seed

# 6. تشغيل المشروع
php artisan serve
npm run dev
```

---

## 🔐 بيانات الدخول التجريبية

| الحقل | القيمة |
|---|---|
| البريد الإلكتروني | `admin@school.test` |
| كلمة المرور | `password` |
| الدور | Super Admin |

---

## 📁 هيكل المشروع

```
school-management-system/
├── app/
│   ├── Filament/          # Resources & Pages
│   ├── Models/            # Eloquent Models
│   └── ...
├── database/
│   ├── migrations/        # Database Tables
│   └── seeders/           # Sample Data
├── resources/
│   └── views/             # Blade Templates
└── routes/
    └── web.php
```

---

## 👤 المطور

**Zeyad Al-Ameri**  
[![GitHub](https://img.shields.io/badge/GitHub-zeyadalameri-black?logo=github)](https://github.com/zeyadalameri)

---

## 📄 الرخصة

هذا المشروع مفتوح المصدر تحت رخصة [MIT](LICENSE).
