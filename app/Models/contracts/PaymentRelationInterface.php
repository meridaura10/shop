<?php

namespace App\Models\contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface PaymentRelationInterface
{
    public function payment(): MorphOne;
}
