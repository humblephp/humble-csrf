<?php

namespace Humble\Csrf;

class Csrf
{
    const STORAGE_KEY = 'csrf';

    private $storage;
    private $tokens;

    public function __construct(\ArrayAccess $storage)
    {
        $this->storage = $storage;
        $this->tokens = $this->storage->offsetGet(self::STORAGE_KEY);
    }

    public function get(): string
    {
        $name = mt_rand(0, mt_getrandmax());
        $token = hash('sha512', mt_rand(0, mt_getrandmax()));
        $this->tokens[$name] = $token;
        $this->storage->offsetSet(self::STORAGE_KEY, array_slice($this->tokens, -5, 5, true));

        return sprintf(
            '<input type="hidden" name="CSRFName" value="%s"><input type="hidden" name="CSRFToken" value="%s">',
            $name,
            $token
        );
    }

    public function validate($name, $value): bool
    {
        $token = $this->tokens[$name] ?? null;

        if (!$token) {
            return false;
        }

        unset($this->tokens[$name]);

        $this->storage->offsetSet(self::STORAGE_KEY, $this->tokens);

        return hash_equals($token, $value);
    }
}
