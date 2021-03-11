<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class ValidExpirationTimeConstraint implements TokenSyntaxConstraintInterface
{
    private const EXPIRATION_TIME_CLAIM_NAME = 'exp';
    private $validAt;

    public function __construct(\DateTime $validAt = null)
    {
        $this->validAt = $validAt;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        $tokenExpirationTime = $token->getClaim(self::EXPIRATION_TIME_CLAIM_NAME);
        if (null === $tokenExpirationTime) {
            return false;
        }
        $tokenExpirationDate = new \DateTime("@$tokenExpirationTime");

        $validAt = $this->validAt ?? new \DateTime();
        return $tokenExpirationDate > $validAt;
    }
}
