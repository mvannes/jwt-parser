<?php

namespace Mvannes\JwtParser\Token;

interface TokenInterface
{
    /**
     * Returns the given header if set, or the given default if not set.
     *
     * @param string $headerName
     * @param mixed $default
     * @return mixed
     */
    public function getHeader(string $headerName, $default = null);

    /**
     * Returns the given claim if set, or the given default if not set.
     *
     * @param string $claimName
     * @param mixed $default
     * @return mixed
     */
    public function getClaim(string $claimName, $default = null);

    /**
     * All headers
     *
     * @return mixed[]
     */
    public function getHeaders(): array;

    /**
     * All claims
     *
     * @return mixed[]
     */
    public function getClaims(): array;

    /**
     * Returns the token's signature.
     *
     * @return string
     */
    public function getSignature(): string;

}
