## Installation
Langkah pertama buatlah scheme database beranama `news`

Selanjutnya, ketik perintah dibawah ini untuk menjalankan migration laravel:
```bash
   php artisan migrate 
```

Jalankan seeder dengan perintah berikut:
```bash
    php artisan db:seed
```

Kemudian jalankan `passport` dengan perintah berikut ini:
```bash
    php artisan passport:install
```

Jalankan web server agar API dapat digunakan:
```bash
    php artisan serve
```

Sekarang aplikasi dapat digunakan :)

## API Reference

#### Get a token for authorization
```http
  GET /api/user/{user_id}
```

#### Get a list of news

```http
  GET /api/news
```

#### Create a news
```http
  POST /api/news
```

#### Update a news
```http
  PUT /api/news/{news_id}
```

#### Delete a news
```http
  DELETE /api/news/{news_id}
```

#### Create a comment
```http
  POST /api/comment
```
