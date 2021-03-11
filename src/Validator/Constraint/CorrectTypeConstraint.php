<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator\Constraint;

use Mvannes\JwtParser\Token\TokenInterface;

class CorrectTypeConstraint implements TokenSyntaxConstraintInterface
{
    private const TYPE_HEADER_NAME = 'typ';
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        return $token->getHeader(self::TYPE_HEADER_NAME) === $this->type;
    }
}
