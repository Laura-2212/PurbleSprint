@echo off
setlocal
set "PHP_EXE=C:\src\php\php.exe"
set "PHP_EXT=C:\src\php\ext"
cd /d "%~dp0"
"%PHP_EXE%" -d extension_dir="%PHP_EXT%" -d extension=pdo_sqlite -d extension=sqlite3 -S 127.0.0.1:8001
pause
