# README

[![Build Status](https://travis-ci.org/RequestLab/xiti-analytics.svg)](http://travis-ci.org/RequestLab/xiti-analytics)

The RequestLab Xiti Analytics library provides a way to use the AT Internet Analytics Data Query API.
It's inpired by the [Wid'op Google Analytics library](https://github.com/widop/google-analytics)

## Documentation

### Installation

To install the RequestLab Xiti Analytics library, you will need [Composer](http://getcomposer.org). It's a PHP 5.3+
dependency manager which allows you to declare the dependent libraries your project needs and it will install &
autoload them for you.

#### Set up Composer

Composer comes with a simple phar file. To easily access it from anywhere on your system, you can execute:

```
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

#### Define dependencies

Create a ``composer.json`` file at the root directory of your project and simply require the
``requestlab/xiti-analytics`` package:

```
{
    "require": {
        "requestlab/xiti-analytics": "*"
    }
}
```

#### Install dependencies

Now, you have define your dependencies, you can install them:

```
$ composer install
```

Composer will automatically download your dependencies & create an autoload file in the ``vendor`` directory.

#### Autoload

So easy, you just have to require the generated autoload file and you are already ready to play:

``` php
<?php

require __DIR__.'/vendor/autoload.php';

use RequestLab\XitiAnalytics;

// ...
?>
```

The RequestLab Xiti Analytics library follows the [PSR-0 Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md).
If you prefer install it manually, it can be autoload by any convenient autoloader.

### Usage

#### Query

First, in order to request the ATInternet Analytics Query service, simply create a request and configure it according to your needs:

``` php
<?php

use RequestLab\XitiAnalytics\Query;

$query = new Query();

$query->setStartDate(new \DateTime('-1 Day'));
$query->setEndDate(new \DateTime('-1 Day'));

$query->setSpace(99999);
$query->setColums(array('m_visits', 'm_page_loads'));
$query->setSort(array('-m_visits'));

?>
```

#### Client

A client allows you to request the service with your login and password.

``` php
<?php

use RequestLab\XitiAnalytics\Client;

$client = new Client();
$client->setLogin('Login');
$client->setPassword('Password');

?>
```

#### Service

``` php
<?php

use RequestLab\XitiAnalytics\Service;

$service = new Service($client);
$client->query($query);

?>
```

#### Response

The response is a RequestLab\XitiAnalytics\Response object which wraps all available informations:

``` php
<?php

$columns = $response->getColumns();
$rows    = $response->getRows();
$totals  = $response->getTotals();

?>
```

## Testing

The library is fully unit tested by [PHPUnit](http://www.phpunit.de/). To execute the test suite, check the travis [configuration](https://github.com/RequestLab/xiti-analytics/blob/master/.travis.yml).

## Contribute

The library is open source, propose a PR!

## License

The RequestLab Xiti Analytics library is under the MIT license. For the full copyright and license information, please
read the [LICENSE](https://github.com/RequestLab/xiti-analytics/blob/master/LICENSE) file that was distributed with this
source code.