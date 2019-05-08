<?php

include ELEMS . "VariantCalculator.php";

class WayReader
{

    /** @var VariantCalculator[] */
    protected $variants = [];
    protected $optimalX = 0;
    protected $optimalY = 0;

    /** @var VariantCalculator */
    protected $maxAwayCoordinates = null;
    protected $maxAwayDistance = 0;

    public function __construct(array $variants)
    {
        foreach ($variants as $variant) {
            $this->variants[] = new VariantCalculator($variant);
        }

        $listOfX = [];
        $listOfY = [];
        foreach ($this->variants as $variant) {
            $listOfX[] = $variant->getCoordinates()['x'];
            $listOfY[] = $variant->getCoordinates()['y'];
        }

        $this->optimalX = array_sum($listOfX) / count($listOfX);
        $this->optimalY = array_sum($listOfY) / count($listOfY);

        $this->findMaxAwayCoordinate();
    }

    protected function findMaxAwayCoordinate()
    {
        $previousDistance = 0;
        foreach ($this->variants as $variant) {
            $powX = pow(2, ($variant->getCoordinates()['x'] - $this->optimalX));
            $powY = pow(2, ($variant->getCoordinates()['y'] - $this->optimalY));
            $distance = round(sqrt($powX + $powY), 3);
            if ($distance > $previousDistance) {
                $previousDistance = $distance;
                $this->maxAwayCoordinates = $variant;
            }
        }
        $this->maxAwayDistance = $previousDistance;
    }

    public function getMaxAwayCoordinate()
    {
        return $this->maxAwayCoordinates;
    }

    public function __toString()
    {
        return "Optimal coordinates is: x:{$this->optimalX} y:{$this->optimalY} with distance {$this->maxAwayDistance} from variant x:{$this->maxAwayCoordinates->getCoordinates()['x']} y:{$this->maxAwayCoordinates->getCoordinates()['y']}";
    }

}