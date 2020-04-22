Zip code management
===================

[![PHP Version](https://img.shields.io/badge/PHP-%3D7.3.13-brightgreen.svg)](https://php.net/)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/devnaz/zipcodes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/devnaz/zipcodes/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/devnaz/zipcodes/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## Requirements
- **PHP** = >= 7.3.13
- **laravel/framework** = 6.18.1


## Installation
```bash
$> git clone https://github.com/devnaz/zipcodes.git
$> cd zipcodes
$> ./local-first-init.sh
```


## API Documentation
[For more information see here](https://devnaz.github.io/zipcodes/src/public/api/doc/index.html)


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
