<?php
namespace Mvannes\JwtParser\Token;

class Token implements TokenInterface
{
    private $headers;
    private $claims;
    private $signature;

    public function __construct(array $headers, array $claims, string $signature)
    {
        $this->headers = $headers;
        $this->claims  = $claims;
        $this->signature = $signature;
    }

    public function getHeader(string $headerName, $default = null)
    {
        return $this->headers[$headerName] ?? $default;
    }

    public function getClaim(string $claimName, $default = null)
    {
        return $this->claims[$claimName] ?? $default;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getClaims(): array
    {
        return $this->claims;
    }
}
