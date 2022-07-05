<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Update Fichier request",
 *      description="Update Fichier request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class UpdateFichierRequest
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
