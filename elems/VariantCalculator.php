<?php

class VariantCalculator
{

    protected $startPointX = 0;
    protected $startPointY = 0;
    protected $startDegree = 0;

    protected $currentX = null;
    protected $currentY = null;
    protected $currentDegree = null;

    protected $commands = [];

    public function __construct(string $source)
    {
        $rowData = explode(" ", $source);
        $this->startPointX = $rowData[0];
        $this->startPointY = $rowData[1];
        $this->startDegree = $rowData[3];
        $rowData = array_splice($rowData, 4);
        $isCommand = true;
        foreach ($rowData as $index => $commandName) {
            if ($isCommand) {
                $this->doStep($commandName, $rowData[$index+1]);
            }
            $isCommand = !$isCommand;
        }
    }

    protected function doStep(string $command, $value)
    {
        switch ($command){
            case "walk":{
                if(is_null($this->currentX) || is_null($this->startPointY)){
                    $this->currentX = $this->startPointX;
                    $this->currentY = $this->startPointY;
                }

                if(is_null($this->currentDegree)){
                    $this->currentDegree = $this->startDegree;
                }

                $this->doWalk($value);
                break;
            }
            case "turn":{
                $this->currentDegree = $value;
                break;
            }
            default:{
                throw new Exception("Unknown command {$command}");
            }
        }
    }

    protected function doWalk($stepUnits){
        $this->currentX = ($this->currentX+(cos($this->currentDegree)+$stepUnits));
        $this->currentY = ($this->currentY+(sin($this->currentY)+$stepUnits));
    }

    public function getCoordinates(){
        return [
            'x' => $this->currentX,
            'y' => $this->currentY
        ];
    }

}