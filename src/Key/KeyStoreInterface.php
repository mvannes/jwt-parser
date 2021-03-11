<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Key;

interface KeyStoreInterface
{
    public function getById(string $id);
}
