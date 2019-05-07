<?php

include ELEMS."VariantCalculator.php";

class WayReader{
    protected $variants = [];
    public function __construct(array $variants)
    {
        foreach ($variants as $variant){
            $this->variants[] = new VariantCalculator($variant);
        }
    }
}