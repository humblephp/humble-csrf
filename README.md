# humble-csrf

[![Latest Version](https://img.shields.io/github/release/humblephp/humble-csrf.svg)](https://github.com/humblephp/humble-csrf/releases)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Build Status](https://api.travis-ci.org/humblephp/humble-csrf.svg?branch=master)](https://travis-ci.org/humblephp/humble-csrf)

HUMBLE CSRF

- with PSR-7 CSRF Middleware

## Install

Via Composer

``` bash
$ composer require humble/csrf
```

## Usage

Can be use with any PSR-7 project.

Get PHP CSRF with any $storage that implements \ArrayAccess interface.
```
$csrf = new \Humble\Csrf\Csrf($storage);
```

Use PHP CSRF with PSR-7 CSRF Middleware.
```
$middleware = new \Humble\Csrf\CsrfMiddleware($csrf);
$response = $middleware($request, $response, $next);
```

Get HTML snippet with CSRF token.
```
$snippet = $csrf->get();
```
```
<input type="hidden" name="CSRFName" value="%s">
<input type="hidden" name="CSRFToken" value="%s">
```

Validate CSRF token.
```
$csrf
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
