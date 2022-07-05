<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 * )
 */

class StoreUserRequest
{
    /**
     * @OA\Property(
     *      title="username",
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="email",
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="role_id",
     *      description="Role's id of the new user",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $role_id;
}
