<?php
class ProcessDomain
{

    protected $numberStringList = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    protected $sum;

    protected $debugEnabled = false;

    public function enableDebug()
    {
        $this->debugEnabled = true;
    }

    protected function printDebug($mixed, $info = null)
    {
        if ($this->debugEnabled) {
            print("\n");
            if ($info) {
                print ($info) . ': ';
            }
            if (is_string($mixed)) {
                print($mixed);
            } else {
                print_r($mixed);
            }
            print("\n");
        }
    }

    public function processLineList(array $lineList)
    {

        foreach ($lineList as $lineLoop) {

            $numberList = $this->getNumberListByLine($lineLoop);

            $firstNumber  = reset($numberList);
            $lastNumber = end($numberList);

            $numberString = $this->convertNumber($firstNumber) . $this->convertNumber($lastNumber);

            $this->printDebug($this->sum, 'sum');
            $this->printDebug($numberString, '+');

            $this->sum += $numberString;

            $this->printDebug($this->sum, '=');
        }

        return $this->sum;
    }

    public function getNumberListByLine(string $line): array
    {

        $numberStringPositionList = [];
        for ($i = 0; $i < 10; $i++) {
            if (str_contains($line, $i)) {

                $numberStringPositionList[strpos($line, $i)] = (string)$i;
                $numberStringPositionList[strrpos($line, $i)] = (string)$i;
            }
        }
        foreach ($this->numberStringList as $numberStringLoop) {
            if (str_contains($line, $numberStringLoop)) {
                $numberStringPositionList[strpos($line, $numberStringLoop)] = $numberStringLoop;
                $numberStringPositionList[strrpos($line, $numberStringLoop)] = $numberStringLoop;
            }
        }

        ksort($numberStringPositionList);

        return $numberStringPositionList;
    }

    public function convertNumber($mixedNumber)
    {
        if (is_numeric($mixedNumber)) {
            return $mixedNumber;
        } else {
            foreach ($this->numberStringList as $index => $numberStringLoop) {
                if ($numberStringLoop == $mixedNumber) {
                    return $index + 1;
                }
            }
        }
        throw new Exception('Unexpected mixed number:' . $mixedNumber);
    }
}
