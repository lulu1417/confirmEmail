必須到google設定兩步驟驗證機制，再建立應用程式密碼

修改 .env
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME='開發者gmail'
MAIL_PASSWORD='開發者應用程式密碼'
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS='開發者gmail'
MAIL_FROM_NAME="${APP_NAME}"
MAIL_CONFIRM_URL=http://localhost:8000/api/confirm
MAIL_RESET_PASSWORD_URL=http://localhost:8000/api/reset
MAIL_UPDATE_PASSWORD_URL=http://localhost:8000/api/update/password
```
產生Mailables類別
```
php artisan make:mail Class名稱
```
