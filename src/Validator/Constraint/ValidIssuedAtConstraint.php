<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class ValidIssuedAtConstraint implements TokenSyntaxConstraintInterface
{
    private const ISSUED_AT_CLAIM_NAME = 'iat';
    private $validAt;

    public function __construct(\DateTime $validAt = null)
    {
        $this->validAt = $validAt;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        $tokenIssuedAtTime = $token->getClaim(self::ISSUED_AT_CLAIM_NAME);
        if (null === $tokenIssuedAtTime) {
            return false;
        }
        $tokenIssuedAtDate = new \DateTime("@$tokenIssuedAtTime");

        $validAt = $this->validAt ?? new \DateTime();
        return $tokenIssuedAtDate <= $validAt;
    }
}
