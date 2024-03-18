<?php

namespace App\Form\EleasticSearch\Data;

use App\Entity\Produit;

class SearchData
{
    public function __construct(
        public ?string $query = null,
        public ?Produit $produit = null,
        public bool $createdThisMonth = false,
     )
    {
    }
}