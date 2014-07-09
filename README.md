# phergie/phergie-irc-generator

A PHP-based generator for messages conforming to the IRC protocol as described in [RFC 1459](http://irchelp.org/irchelp/rfc/rfc.html).

[![Build Status](https://secure.travis-ci.org/phergie/phergie-irc-generator.png?branch=master)](http://travis-ci.org/phergie/phergie-irc-generator)

## Install

The recommended method of installation is [through composer](http://getcomposer.org).

```JSON
{
    "minimum-stability": "dev",
    "require": {
        "phergie/phergie-irc-generator": "1.1.0"
    }
}
```

## Design goals

* Minimal dependencies: PHP 5.3.3+
* Simple easy-to-understand API

## Usage

```php
<?php
$generator = new \Phergie\Irc\Generator();
$messages = $generator->ircPass('password')
    . $generator->ircNick('nick')
    . $generator->ircUser('username', 'hostname', 'servername', 'realname')
    . $generator->ircJoin('#channel1,#channel2')
    . $generator->ircPrivmsg('#channel1', 'Hello world!');
echo $messages;

/*
Output:
PASS :password
NICK :nick
USER username hostname servername :realname
JOIN :#channel1,#channel2
PRIVMSG #channel1 :Hello world!

*/

```

## Tests

To run the unit test suite:

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
./vendor/bin/phpunit Phergie/Irc/GeneratorTest.php
```

## License

Released under the BSD License. See `LICENSE`.

## Community

Check out #phergie on irc.freenode.net.
