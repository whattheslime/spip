tests: vendor phpunit.xml
	vendor/bin/phpunit --colors

phpunit.xml:
	php bin/configure.php

vendor: composer.json
	composer update
	touch $@