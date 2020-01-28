# Installation
* clone Maryi/universal-php-docker - https://github.com/Mariyo/universal-php-docker.git
* cd to `./universal-php-docker/app`
* clone this repository - https://github.com/mbadal/learning-domain-driven-design.git
* run composer install from root of docker project `./universal-php-docker` to generate autoload class map- `./ops bash composer install`
* checkout assignment branch - `vo/lesson1-assignment` 
* run built-in PHP web server from root of docker project `./universal-php-docker` - `./ops php -S 0.0.0.0:9001 -t learning-domain-driven-design/public/value-objects/example-1` 
