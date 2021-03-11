<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator\Constraint;


use Mvannes\JwtParser\Token\TokenInterface;

interface TokenSyntaxConstraintInterface
{
    public function tokenIsValid(TokenInterface $token): bool;
}
