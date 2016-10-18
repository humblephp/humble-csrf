<?php

namespace Humble\Csrf;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CsrfMiddleware
{
    const BAD_REQUEST = 400;

    private $csrf;

    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        if ($request->getMethod() == 'POST') {
            $name = $request->getParsedBody()['CSRFName'];
            $token = $request->getParsedBody()['CSRFToken'];

            if (!$this->csrf->validate($name, $token)) {
                throw new InvalidCsrfTokenException('Invalid Csrf Token');
            }
        }

        return $next($request, $response);
    }
}
