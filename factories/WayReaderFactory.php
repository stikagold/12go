<?php
/**
 * Created by PhpStorm.
 * User: rafik
 * Date: 5/6/19
 * Time: 7:20 PM
 */
include ELEMS."WayReader.php";

class WayReaderFactory
{
    protected $lineCountPattern = "/^\d\n/";
    protected $linePattern = "";

    protected $cases = [];

    protected $readers = [];

    public function __construct(string $source)
    {
        $this->cases = explode("\n", $source);
        $currentPosition = 0;
        do{
            $variantCount = $this->cases[$currentPosition];
            if($variantCount){
                $reader = new WayReader(array_slice($this->cases, ($currentPosition+1), $variantCount));
                $this->readers[] = $reader;
                $currentPosition += $variantCount+1;
                // !Important - it's only for view results
                echo $reader, "<br>";
            }else{
                break;
            }

        }while($variantCount > 0);
    }


}