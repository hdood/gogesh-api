<?php

namespace App\Repository;

use App\Models\OfferView;

class OfferViewsRepository
{

    public function __construct(private OfferView $offerView)
    {
    }


    public function create($array)
    {
        $this->offerView->create($array);
    }

}
