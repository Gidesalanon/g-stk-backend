<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Update User request",
 *      description="Update User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class UpdateUserRequest
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
