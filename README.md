## Getting started:
1. Fork this Repository

    ``` git clone https://github.com/fardousGamal/task-with-docker.git ```
1. change the current directory to project path ex:

      ``` cd task-with-docker ```
2. change your database credentials in *docker-compose.yml* file

    ```
    environment:
      MYSQL_DATABASE: test
      MYSQL_USER: root
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: secret
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql

    ```
    *docker will create your database with the provided credentials during installation process*
    ***

3. ``` docker-compose build && docker-compose up -d ```

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

1. Install dependencies with composer

      ```docker-compose exec php composer install ```
2. run migrations

     ``` docker-compose exec php php /var/www/html/artisan migrate ```
3. run seeder

     ``` docker-compose exec php php /var/www/html/artisan db:seed --class=DatabaseSeeder```

