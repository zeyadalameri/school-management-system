# نظام إدارة المدرسة

مشروع Laravel + Filament + MySQL كبداية عملية لنظام إدارة مدرسة حقيقي.

## التقنيات

- Laravel 9
- Filament 2
- MySQL عبر XAMPP
- Spatie Laravel Permission
- Laravel Mix

## الوحدات الرئيسية

- السنوات الدراسية
- الصفوف والشعب
- الطلاب وأولياء الأمور
- المعلمون والمواد
- التسجيلات
- الحضور
- التقييمات والدرجات
- فواتير الرسوم والمدفوعات
- المستخدمون والأدوار

## التشغيل المحلي

1. شغل Apache و MySQL من XAMPP.
2. أنشئ قاعدة البيانات إذا لم تكن موجودة:

```sql
CREATE DATABASE school_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. ثبت حزم PHP:

```bash
composer install
```

4. جهز ملف البيئة ومفتاح التطبيق:

```bash
copy .env.example .env
php artisan key:generate
```

5. شغل الجداول والبيانات التجريبية:

```bash
php artisan migrate --seed
```

6. ثبت وابن ملفات الواجهة:

```bash
npm.cmd install
npm.cmd run prod
```

7. شغل السيرفر المحلي:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

لوحة الإدارة:

```text
http://127.0.0.1:8000/admin
```

بيانات الدخول التجريبية:

```text
البريد الإلكتروني: admin@school.test
كلمة المرور: password
```

## ملاحظة

بدأ المشروع على PHP 8.0.12 حتى يتوافق مع نسخة XAMPP الحالية. قبل الإنتاج يفضل ترقية PHP إلى إصدار أحدث ثم تحديث Laravel و Filament.
