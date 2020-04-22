Zip code management
===================

[![PHP Version](https://img.shields.io/badge/PHP-%3D7.3.13-brightgreen.svg)](https://php.net/)

## Requirements
- **PHP** = 7.3.13
- **laravel/framework** = 6.18.1


## Tests
To run the test suite, you need to initialize the application in docker through the initialization script local-first-init.sh, then the tests can be run with the commands:
```bash
$> docker-compose run cli /bin/bash -c "./vendor/bin/phpunit ./tests/Unit"
$> docker-compose run cli /bin/bash -c "./vendor/bin/phpunit ./tests/Feature"
```


## License
Bpm’online is licensed under the [MIT License](https://opensource.org/licenses/MIT)


## Contact
Problems, comments, and suggestions all welcome: [sol.developer@gmail.com](mailto:sol.developer@gmail.com)
