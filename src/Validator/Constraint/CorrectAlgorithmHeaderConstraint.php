<?php
declare(strict_types=1);

namespace Mvannes\JwtParser\Validator\Constraint;


use Mvannes\JwtParser\Token\TokenInterface;

class CorrectAlgorithmHeaderConstraint implements TokenSyntaxConstraintInterface
{
    private const ALGORITHM_HEADER_NAME = 'alg';
    private $algorithm;

    public function __construct(string $algorithm)
    {
        if ($algorithm === 'none') {
            throw new \InvalidArgumentException('You may not use the none algorithm.');
        }
        $this->algorithm = $algorithm;
    }

    public function tokenIsValid(TokenInterface $token): bool
    {
        return $token->getHeader(self::ALGORITHM_HEADER_NAME) === $this->algorithm;
    }
}
