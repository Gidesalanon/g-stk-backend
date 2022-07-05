<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="Entreprise Resource",
 *     description="Entreprise resource",
 *     @OA\Xml(
 *         name="EntrepriseResource"
 *     )
 * )
 */
class EntrepriseResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Entreprise[]
     */
    private $data;
}
