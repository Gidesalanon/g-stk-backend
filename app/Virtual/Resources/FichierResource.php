<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="Fichier Resource",
 *     description="Fichier resource",
 *     @OA\Xml(
 *         name="FichierResource"
 *     )
 * )
 */
class FichierResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Fichier[]
     */
    private $data;
}
