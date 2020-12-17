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

        public function __construct($firstNum, $secondNum, $operation)
        {
            $this->numOne = $firstNum;
            $this->numTwo = $secondNum;

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
    static public $numArray;
    public $array;


    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getData() 
    {
        $this->fileData = fopen($this->fileName, 'r+') or die("Could not open file");

        (int)$data = file($this->fileName);
                return $data;
                // foreach ($data as $value) {
                //     // self::$numArray = explode(' ', $value);
                //     $num = explode(' ', $value);
                //     $this->array += $num;
                //     // echo $num;
                //     print_r($this->array);
                //     return $num;
                // }
                // self::$numArray = explode(' ', trim($data, "\n\r"));

                // for ($i=0; $i < count($data) ; $i++) { 
                //     # code...
                // }
                // echo count($data);
                // print_r($data);
                // echo count($num);
                // print_r($num);
                // print_r(self::$numArray);
                
            // }

        fclose($this->fileData);
    }



    static public function saveResult($numOne, $numTwo, $operation) 
    {
        $resultOne = new Calculator($numOne, $numTwo, $operation);
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
    $cli->getData();

    $data = $cli->getData();
    print_r($data);
    $firstNum = $data[0];
    $secondNum = $data[1];

    CLI::saveResult($firstNum, $secondNum, $operation);














?>