## Getting started:
1. Fork this Repository

    ``` git clone https://github.com/fardousGamal/task-with-docker.git ```
1. change the current directory to project path ex:

      ``` cd task-with-docker ```
2. change your email credentials in *src/.env* file

    ```
      MAIL_MAILER=smtp
      MAIL_HOST=sandbox.smtp.mailtrap.io
      MAIL_PORT=2525
      MAIL_USERNAME=
      MAIL_PASSWORD=
      MAIL_ENCRYPTION=tls
      MAIL_FROM_ADDRESS="hello@example.com"
      MAIL_FROM_NAME="${APP_NAME}"

    ```
   

3. run  ``` docker-compose build && docker-compose up -d ```

    **alert:** </span> if there is a server running in your machine, you should stop it or change port 80 in docker-compose.yml to another port(8000)
    ```
    services:
      app:
        build:
          context: .
          dockerfile: nginx.dockerfile
          container_name: nginxServer
          ports:
            - "8000:80"
    ```
    *you can do this with each service*

5. Install dependencies with composer

      ```docker-compose exec php composer install ```
6. run migrations

     ``` docker-compose exec php php /var/www/html/artisan migrate ```
7. run seeder

     ``` docker-compose exec php php /var/www/html/artisan db:seed --class=DatabaseSeeder```

8. Can use postman collection
 Visit this link ```https://documenter.getpostman.com/view/3355914/2s9YXfahe```

9. Set up the cron job on your server:

Add the following cron job entry to your server's crontab file:

Copy
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1