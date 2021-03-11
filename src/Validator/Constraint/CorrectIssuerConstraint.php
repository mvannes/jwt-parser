<?php

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class CorrectIssuerConstraint implements TokenSyntaxConstraintInterface
{
    private const ISSUER_CLAIM_NAME = 'iss';
    private $issuer;

    public function __construct(string $issuer)
    {
        $this->issuer = $issuer;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        return $token->getClaim(self::ISSUER_CLAIM_NAME) === $this->issuer;
    }
}
