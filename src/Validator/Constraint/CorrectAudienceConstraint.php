<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class CorrectAudienceConstraint implements TokenSyntaxConstraintInterface
{
    private const AUDIENCE_CLAIM_NAME = 'aud';
    private $audience;

    public function __construct(string $audience)
    {
        $this->audience = $audience;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        return $token->getClaim(self::AUDIENCE_CLAIM_NAME) === $this->audience;
    }
}
