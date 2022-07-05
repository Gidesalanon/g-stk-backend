<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Username",
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="Email",
     * )
     *
     * @var string
     */
    public $email;
    /**
     * @OA\Property(
     *      title="Password",
     * )
     *
     * @var string
     */
    public $password;
    /**
     * @OA\Property(
     *      title="Firstname",
     * )
     *
     * @var string
     */
    public $firstname;
    /**
     * @OA\Property(
     *      title="Lastname",
     * )
     *
     * @var string
     */
    public $lastname;
    /**
     * @OA\Property(
     *      title="Public",
     * )
     *
     * @var bool
     */
    public $public;
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;
}
