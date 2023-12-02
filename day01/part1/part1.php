<?php

$process = new Process();



$lineList = file(__DIR__ . '/../input.txt');

$process->enableDebug();

$sum = $process->processLineList($lineList);
echo $sum;

class Process
{

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

            $numberString = $numberList[0] . end($numberList);

            $this->printDebug($this->sum, 'sum');
            $this->printDebug($numberString, '+');

            $this->sum += $numberString;

            $this->printDebug($this->sum, '=');
        }

        return $this->sum;
    }

    public function getNumberListByLine(string $line): array
    {
        if (preg_match_all('/([0-9])/', $line, $matchList)) {

            $this->printDebug($line, 'line');
            $this->printDebug($matchList);
            return $matchList[1];
        }
        throw new Exception('Does not mach pattern');
    }
}
