### START COMMAND ###

```
docker-compose build && \
docker-compose up --no-start && \
docker-compose start && \
docker-compose exec php composer install && \
sleep 3 && \
docker-compose exec php /app/yii migrate/up --interactive=0 && \
docker-compose exec php chown -R www-data:www-data /app/web/assets/ /app/runtime/
```