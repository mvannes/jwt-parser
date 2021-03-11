<?php

namespace Mvannes\JwtParser\Key\SigningMethod;


interface SigningMethodInterface
{
    public function getType(): string;

    public function validate(string $token, string $signature): bool;
}
