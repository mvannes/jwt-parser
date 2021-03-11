<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Parser;

use Mvannes\JwtParser\Token\Token;
use Mvannes\JwtParser\Token\TokenInterface;

class TokenParser
{
    public function parse(string $tokenString): TokenInterface
    {
        $parts = explode('.', $tokenString);

        if (count($parts) !== 3) {
            throw new \InvalidArgumentException('Given token did not contain three parts.');
        }

        [$encodedHeader, $encodedClaims, $encodedSignature] = $parts;
        $headerString =  $this->base64UrlDecode($encodedHeader);
        $claimsString = $this->base64UrlDecode($encodedClaims);
        $signatureString = $this->base64UrlDecode($encodedSignature);

        if (false === $headerString || false === $claimsString || false === $signatureString) {
            throw new \InvalidArgumentException('Unparsable token given.');
        }

        $headers = \json_decode($headerString, true);
        $claims = \json_decode($claimsString, true);

        if (false === $headers || false === $claims) {
            throw new \InvalidArgumentException('Unparsable token given.');
        }

        return new Token($headers, $claims, $signatureString);
    }

    private function base64UrlDecode(string $encoded): string {
        $remainder = \strlen($encoded) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $encoded .= \str_repeat('=', $padlen);
        }
        return  \base64_decode(\strtr($encoded, '-_', '+/'));
    }
}
