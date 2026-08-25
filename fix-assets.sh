#!/bin/bash

# ============================================
# اسکریپت انتقال فایل‌های استاتیک به public/
# برای حل مشکل 404 CSS و JS
# ============================================

echo "========================================="
echo "  شروع انتقال فایل‌های استاتیک به public/"
echo "========================================="
echo ""

# رنگ‌ها برای نمایش بهتر
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# ============================================
# مرحله 1: انتقال فایل‌های CSS
# ============================================
echo -e "${YELLOW}مرحله 1: انتقال فایل‌های CSS${NC}"

# ایجاد پوشه css در public اگر وجود نداشت
mkdir -p public/css

# لیست فایل‌های CSS برای انتقال
css_files=(
    "resources/css/paneladmin.css"
    "resources/css/index.css"
    "resources/css/blog.css"
    "resources/css/project.css"
    "resources/css/singleblog.css"
)

for file in "${css_files[@]}"; do
    if [ -f "$file" ]; then
        filename=$(basename "$file")
        cp "$file" "public/css/$filename"
        echo -e "${GREEN}✅ انتقال: $file -> public/css/$filename${NC}"
    else
        echo -e "${RED}❌ فایل وجود ندارد: $file${NC}"
    fi
done

echo ""

# ============================================
# مرحله 2: انتقال فایل‌های JS
# ============================================
echo -e "${YELLOW}مرحله 2: انتقال فایل‌های JS${NC}"

# ایجاد پوشه js در public اگر وجود نداشت
mkdir -p public/js

# لیست فایل‌های JS برای انتقال
js_files=(
    "resources/js/paneladmin.js"
    "resources/js/index.js"
    "resources/js/blog.js"
    "resources/js/project.js"
    "resources/js/singleblog.js"
)

for file in "${js_files[@]}"; do
    if [ -f "$file" ]; then
        filename=$(basename "$file")
        cp "$file" "public/js/$filename"
        echo -e "${GREEN}✅ انتقال: $file -> public/js/$filename${NC}"
    else
        echo -e "${RED}❌ فایل وجود ندارد: $file${NC}"
    fi
done

echo ""

# ============================================
# مرحله 3: ایجاد لینک سیمبولیک برای storage
# ============================================
echo -e "${YELLOW}مرحله 3: اجرای storage:link${NC}"
php artisan storage:link
echo ""

# ============================================
# مرحله 4: نمایش لیست فایل‌های منتقل شده
# ============================================
echo -e "${YELLOW}مرحله 4: بررسی فایل‌های منتقل شده${NC}"
echo ""

echo -e "${GREEN}فایل‌های CSS در public/css/:${NC}"
ls -la public/css/ | grep -E "(paneladmin|index|blog|project|singleblog)\.css" || echo "هیچ فایل CSS ای یافت نشد"

echo ""
echo -e "${GREEN}فایل‌های JS در public/js/:${NC}"
ls -la public/js/ | grep -E "(paneladmin|index|blog|project|singleblog)\.js" || echo "هیچ فایل JS ای یافت نشد"

echo ""
echo "========================================="
echo -e "${GREEN}✅ عملیات با موفقیت انجام شد!${NC}"
echo "========================================="
echo ""
echo "🔍 نکات بعدی:"
echo "  1. مسیر فایل‌های استاتیک در Blade باید با asset() باشد"
echo "  2. مثال: {{ asset('css/paneladmin.css') }}"
echo "  3. اگر فایل‌های mana/panel.blade.php را ویرایش کردی، آن را هم چک کن"
echo ""