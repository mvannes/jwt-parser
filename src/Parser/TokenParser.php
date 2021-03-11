<?php
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
        $headerString = base64_decode(urldecode($encodedHeader));
        $claimsString = base64_decode(urldecode($encodedClaims));
        $signatureString = base64_decode(urldecode($encodedSignature));
        $headerString =   base64_decode(str_replace(array('-', '_'), array('+', '/'), $encodedHeader));
        $claimsString =   base64_decode(str_replace(array('-', '_'), array('+', '/'), $encodedClaims));
        $signatureString =   base64_decode(str_replace(array('-', '_'), array('+', '/'), $encodedSignature));

//        $remainder = \strlen($encodedSignature) % 4;
//        if ($remainder) {
//            $padlen = 4 - $remainder;
//            $encodedSignature .= \str_repeat('=', $padlen);
//        }
//        $signatureString =  \base64_decode(\strtr($encodedSignature, '-_', '+/'));


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
}
