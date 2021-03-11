<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator;

use Mvannes\JwtParser\Validator\Constraint\TokenSyntaxConstraintInterface;
use Mvannes\JwtParser\Token\TokenInterface;

class TokenValidator
{
    private $constraints;

    public function __construct(TokenSyntaxConstraintInterface ...$constraints)
    {
        $this->constraints = $constraints;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        foreach ($this->constraints as $constraint) {
            if (false === $constraint->tokenIsValid($token)) {
                return false;
            }
        }
        return true;
    }
}
