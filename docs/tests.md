Tests
=

```bash
cd /vendor/jkmssoft/yii2-counter

# install dependencies
composer install --prefer-dist --no-interaction

cd tests

# migrate
php codeception/bin/yii migrate/up --interactive=0

# build
codecept build

# start webserver in another terminal
php -S localhost:8080

# run all
codecept run

codecept run unit
codecept run functional
codecept run acceptance
```
