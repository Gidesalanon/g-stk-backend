<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Fichier request",
 *      description="Store Fichier request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class StoreFichierRequest
{
    /**
     * @OA\Property(
     *      title="filename",
     * )
     *
     * @var string
     */
    public $filename;
}
