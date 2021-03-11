<?php

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Key\SigningMethod\SigningMethodInterface;
use Mvannes\JwtParser\Token\TokenInterface;

class CorrectSignatureConstraint implements TokenSyntaxConstraintInterface
{
    private $signingMethod;

    public function __construct(SigningMethodInterface $signingMethod)
    {
        $this->signingMethod = $signingMethod;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        $headers = $token->getHeaders();
        $claims = $token->getClaims();

        $headersString = json_encode($headers);
        $claimsString = json_encode($claims);

        $headersBase64 = urlencode(base64_encode($headersString));
        $claimsBase64  = urlencode(base64_encode($claimsString));

        return $this->signingMethod->validate("$headersBase64.$claimsBase64", $token->getSignature());
    }
}
