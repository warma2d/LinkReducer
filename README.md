# LinkReducer

LinkReducer - Сокращатель ссылок со встроенным шлюзом. Система для быстродействия использует Redis.

Сокращатель API принимает ссылку в JSON формате и возвращает короткую ссылку тоже в JSON формате.

При обращению к шлюзу по короткой ссылке, шлюз перенаправляет клиента на исходную ссылку.

## Сокращатель (Reducer)
Request: POST /reducer/api/reduce
```
{
   "longLink": "https://github.com/php/php-src/blob/php-8.1.0RC2/NEWS"
}
```

Response:
```
{
   "shortLink": "https://example.com/aCx4Ne"
}
```

## Запуск

```bash
docker-compose build app
```
```bash
docker-compose up -d
```

```
docker exec -it linkreducer_app_1 /bin/bash
```

```
cd .. && composer install
```

```
composer dump-autoload
```

```
cd src
php Console/createTables.php
```

```
php ../vendor/bin/phpunit ../tests --testdox
```
