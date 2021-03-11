<?php

namespace Mvannes\JwtParser\Key;

interface KeyStoreInterface
{
    public function getById(string $id);
}
