docker-compose.yml

  
    version: '3.8'
    services:
      app:
        build:
          context: https://github.com/redhox/laravel_blog_2.git
          dockerfile: Dockerfile
        ports:
          - "8080:80"
        volumes:
          - /var/www/laravel
        environment:
          DB_CONNECTION: mysql
          DB_HOST: db
          DB_PORT: 3306
          DB_DATABASE: laravel
          DB_USERNAME: laravel
          DB_PASSWORD: secret

      db:
        build:
          context: https://github.com/redhox/laravel_blog_2.git
          dockerfile: Dockerfile_bdd
        restart: always
        environment:
          MYSQL_DATABASE: laravel
          MYSQL_USER: laravel
          MYSQL_PASSWORD: secret
          MYSQL_ROOT_PASSWORD: root

      phpmyadmin:
        image: phpmyadmin
        container_name: pma
        restart: always
        ports:
          - 8081:80
        environment:
          - PMA_HOST=db



