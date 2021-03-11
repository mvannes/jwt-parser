<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Key\SigningMethod;


use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;

class RS512 implements SigningMethodInterface
{
    private $publicKey;

    public function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function getType(): string
    {
        return 'RS512';
    }

    public function validate(string $token, string $signature): bool
    {
        $publicKey = PublicKeyLoader::load($this->publicKey);
        $publicKey = $publicKey->withHash('sha512');
        $publicKey = $publicKey->withPadding(RSA::SIGNATURE_RELAXED_PKCS1);
        return $publicKey->verify($token, $signature);
    }
}
