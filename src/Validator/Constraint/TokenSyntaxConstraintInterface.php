<?php


namespace Mvannes\JwtParser\Validator\Constraint;


use Mvannes\JwtParser\Token\TokenInterface;

interface TokenSyntaxConstraintInterface
{
    public function tokenIsValid(TokenInterface $token): bool;
}
