<?php


namespace Mvannes\JwtParser\Key;


class ArrayKeyStore implements KeyStoreInterface
{
    private $keys;

    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    public function getById(string $id): ?string
    {
        return $this->keys[$id] ?? null;
    }
}
