<?php

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class HasJwtIdConstraint implements TokenSyntaxConstraintInterface
{
    private const JWT_ID_CLAIM_NAME = 'jit';

    public function tokenIsValid(TokenInterface $token): bool
    {
       return null !== $token->getClaim(self::JWT_ID_CLAIM_NAME);
    }
}
