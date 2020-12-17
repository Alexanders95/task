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
            foreach ($number as $key => $value) {
                if ($key = $key/2==0) {
                    // $this->numOne = $value;
                    echo $value;
                } else if ($key = $key/2!=0) {
                    // $this->numTwo = $value;
                    echo $value;
                }
            }

            // $this->numOne = $number;
            // $this->numTwo = $number;

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
    private $i = 0;


    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getData() 
    {
        $this->fileData = fopen($this->fileName, 'r+') or die("Could not open file");

        (int)$data = file($this->fileName);
                foreach ($data as $value) {
                    $num[$this->i] = explode(' ', trim($value, "\n\r"));
                    $this->i += 1;
                }
                
                $result = [];
                array_walk_recursive($num, function ($item, $key) use (&$result) {
                    $result[] = $item;
                });

                // echo count($result);
                // echo gettype($result);
                // print_r($result);

                return $result;

        fclose($this->fileData);
    }

    static public function convertToSimpleArray($array){
        $result = [];
        array_walk_recursive($arrayTest, function ($item, $key) use (&$result) {
            $result[] = $item;    
        });
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

    // print_r($number);
    

    CLI::saveResult($number, $operation);














?>