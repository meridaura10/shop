<?php

namespace App\Services\Currency\Bags;

readonly class CurrencyBag
{
    public function __construct(
        public ?string $name,
        public int $codeA,
        public int $codeB,
        public ?float $rateBuy = null,
        public ?float $rateSell = null,
        public ?float $rateCross = null,
    ) {

    }

    public function convert(float $price): float
    {
        if(isset($this->rateCross)){
            return round($price / $this->rateCross, 2);
        }

        return round($price * ($this->rateBuy ?? 1), 2);
    }
}
