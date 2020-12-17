<?php

interface OperationInterface {
    public function add();

    public function subtruct();

    public function multiple();

    public function divide();
}

class Calculator implements OperationInterface {
    public $numOne;
    public $numTwo;
    public $result;

    public function __construct($number, $operation)
    {

        $this->numOne = $number[0];
        $this->numTwo = $number[1];

        switch ($operation) {
            case '+':
                $operation = "add";
                break;
            case '-':
                $operation = "subtruct";
                break;
            case '*':
                $operation = "multiple";
                break;
            case '/':
                $operation = "divide";
                break;
        }

        // $count = count($number);
        // for ($i=2; $i < $count; $i++) { 
        //     $this->numOne = $number[$i];
        //     $this->numTwo = $number[$i++];
            
        //     $this->$operation();
        // }

        $this->$operation();
    }

    public function add()
    {
        $this->result = $this->numOne + $this->numTwo;
    }

    public function subtruct()
    {
        $this->result = $this->numOne - $this->numTwo;
    }

    public function multiple()
    {
        $this->result = $this->numOne * $this->numTwo;
    }

    public function divide()
    {
        $this->result = $this->numOne / $this->numTwo;
    }

    public function result(){
        return $this->result;   
    }
}

class CLI {
    private $fileName;
    private $fileData;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getData() 
    {
        $this->fileData = fopen($this->fileName, 'r+') or die("Could not open file");
        (int)$data = file($this->fileName);
            $i = 0;
            foreach ($data as $value) {
                $num[$i] = explode(' ', trim($value, "\n\r"));
                $i++;
            }
            
            $result = [];
            array_walk_recursive($num, function ($item, $key) use (&$result) {
                $result[] = $item;
            });
            return $result;
        fclose($this->fileData);
    }

    static public function saveResult($number, $operation) 
    {
        $resultOne = new Calculator($number, $operation);
        $result = $resultOne->result();
        if ($result >= 0) {
            $fd = fopen("pos_result.txt", 'a') or die("Failed to create file");
            fwrite($fd, $result . "\r\n");
            // fseek($fd, 0, SEEK_END); . PHP_EOL
            fclose($fd);
        } else if ($result < 0) {
            $fd = fopen("neg_result.txt", 'a') or die("Failed to create file");
            fwrite($fd, $result . "\r\n");
            // fseek($fd, 0, SEEK_END); . PHP_EOL
            fclose($fd);
        }
    }
}
    $fileName = $argv[1];
    $operation = $argv[2];
    $cli = new CLI($fileName);
    $number = $cli->getData();

    // var_dump($number);

    CLI::saveResult($number, $operation);














?>