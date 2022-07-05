<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     title="AuthResponse",
 *     description="AuthResponse",
 *     @OA\Xml(
 *         name="AuthResponse"
 *     )
 * )
 */
class AuthResponse
{
    /**
     * @OA\Property(
     *      title="access_token",
     * )
     *
     * @var string
     */
    public $access_token;
    /**
     * @OA\Property(
     *      title="token_type",
     * )
     *
     * @var string
     */
    public $token_type;
}
