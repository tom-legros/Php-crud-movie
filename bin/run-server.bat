@echo off
set APP_DIR=%CD%
php -d display_errors -d auto_prepend_file="%CD%\vendor\autoload.php" -S localhost:8000 -t public/
