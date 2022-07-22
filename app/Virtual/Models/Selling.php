<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Entreprise",
 *     description="Entreprise model",
 *     @OA\Xml(
 *         name="Entreprise"
 *     )
 * )
 */
class Selling
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
     *      title="Name",
     * )
     *
     * @var string
     */
    public $qty;

    /**
     * @OA\Property(
     *      title="Public",
     * )
     *
     * @var bool
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Websitelink",
     *      example="http://schimmel.com/",
     *      type="string"
     * )
     *
     * @var string
     */

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
