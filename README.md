# weather-app
Required:
- docker-compose
- symfony

Example poker app with input file
- webserver run: ``symfony server:start``
- run mysql docker: ``docker-compose up``
- connect into DB: ``mysql -h 0.0.0.0 -P 3311 -u master -p``
- run phpunit in app directory ``php bin/phpunit tests/Util``
- default url for application: ``https://127.0.0.1:8000/``