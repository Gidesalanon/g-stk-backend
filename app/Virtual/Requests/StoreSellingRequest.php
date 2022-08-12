<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Entreprise request",
 *      description="Store Entreprise request body data",
 *      type="object",
 * )
 */

class StoreEntrepriseRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     * )
     *
     * @var string
     */
    public $name;

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
     *      title="Websitelink",
     *      example="http://schimmel.com/",
     *      type="string"
     * )
     *
     * @var string
     */
    public $website_link;

    /**
     * @OA\Property(
     *      title="fichier_id",
     *  description="For logo"
     * )
     *
     * @var integer
     */
    public $fichier_id;

    /**
     * @OA\Property(
     *      title="Presentation",
     * )
     *
     * @var string
     */
    public $presentation;

    /**
     * @OA\Property(
     *     title="User's id",
     *      description="Id of User"
     *
     * )
     *
     * @var integer
     */
    private $user_id;
}
