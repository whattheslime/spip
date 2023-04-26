tests: vendor phpunit.xml bootstrap_plugins.php
	vendor/bin/phpunit --colors

phpunit.xml:
	php bin/configure.php

bootstrap_plugins.php:
	php bin/configure.php

vendor: composer.json
	composer update
	touch $@
