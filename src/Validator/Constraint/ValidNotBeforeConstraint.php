<?php

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class ValidNotBeforeConstraint implements TokenSyntaxConstraintInterface
{
    private const NOT_BEFORE_CLAIM_NAME = 'nbf';
    private $validAt;

    public function __construct(\DateTime $validAt = null)
    {
        $this->validAt = $validAt;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        $tokenNotBeforeTime = $token->getClaim(self::NOT_BEFORE_CLAIM_NAME);
        if (null === $tokenNotBeforeTime) {
            return false;
        }
        $tokenNotBeforeDate = new \DateTime("@$tokenNotBeforeTime");

        $validAt = $this->validAt ?? new \DateTime();
        return $tokenNotBeforeDate <= $validAt;
    }
}
