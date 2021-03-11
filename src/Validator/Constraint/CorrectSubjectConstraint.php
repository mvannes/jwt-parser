<?php

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class CorrectSubjectConstraint implements TokenSyntaxConstraintInterface
{
    private const SUBJECT_CLAIM_NAME = 'iss';
    private $subject;

    public function __construct(string $subject)
    {
        $this->subject = $subject;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        return $token->getClaim(self::SUBJECT_CLAIM_NAME) === $this->subject;
    }
}
