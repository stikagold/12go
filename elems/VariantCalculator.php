<?php

class VariantCalculator {

    protected $startPointX = 0;
    protected $startPointY = 0;
    protected $startDegree = 0;

    protected $currentX = 0;
    protected $currentY = 0;

    protected $commands = [];

    public function __construct(string $source)
    {
        $startCoordinates = [];
        var_dump($source);
        preg_match_all("/(\d*[.]\d*)/", $source,$startCoordinates);
        $this->startPointX = $startCoordinates[0][0];
        $this->startPointY = $startCoordinates[0][1];
        $degree = [];
        preg_match_all("/(start ([\d]*)) | (start ([-\d]*))/", $source, $degree);
        $this->startDegree = end($degree)[0];
        var_dump($this->startPointX, $this->startPointY, $this->startDegree);
    }
}