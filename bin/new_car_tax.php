<?php
interface Tax
{
    public function calculating();
}

class Gasoline implements Tax
{
    protected int|float $price;
    protected int $engineCapacity;

    public function __construct($price, $engineCapacity)
    {
        $this->engineCapacity = $engineCapacity;
        $this->price = $price;
    }

    public function calculating(): int|float
    {
        if($this->engineCapacity < 3000){
            $sum = (($this->price * 0.1) + ($this->engineCapacity * 0.05) +
                (($this->price + ($this->price * 0.1) + ($this->engineCapacity * 0.05)) * 0.2));
        }else{
            $sum = (($this->price * 0.1) + ($this->engineCapacity * 0.1) +
                (($this->price + ($this->price * 0.1) + ($this->engineCapacity * 0.1)) * 0.2));
        }
        return $sum;
    }
}

class Diesel extends Gasoline
{
    protected int|float $price;
    protected int $engineCapacity;

    public function __construct($price, $engineCapacity)
    {
        $this->price = $price;
        $this->engineCapacity = $engineCapacity;
    }

    public function calculating(): int|float
    {
        if($this->engineCapacity < 3500){
          $sum = (($this->price * 0.1) + ($this->engineCapacity * 0.075) +
              (($this->price + ($this->price * 0.1) + ($this->engineCapacity * 0.075)) * 0.2));
        }else{
            $sum = (($this->price * 0.1) + ($this->engineCapacity * 0.15) +
                (($this->price + ($this->price * 0.1) + ($this->engineCapacity * 0.15)) * 0.2));
        }
        return $sum;
    }
}

class Hybrid implements Tax
{
    protected int|float $price;
    protected int $engineCapacity;

    public function __construct($price, $engineCapacity)
    {
        $this->price = $price;
        $this->engineCapacity = $engineCapacity;
    }

    public function calculating(): int|float
    {
        if($this->engineCapacity < 3000){
            $sum = (($this->price * 0.1) + ($this->engineCapacity * 0.05) +
                (($this->price + ($this->price * 0.1) + ($this->engineCapacity * 0.05)) * 0.2));
        }else{
            $sum = (($this->price * 0.1) + ($this->engineCapacity * 0.1) +
                (($this->price + ($this->price * 0.1) + ($this->engineCapacity * 0.1)) * 0.2));
        }
        return $sum;
    }
}

class Input
{
    protected int $engineType;

    public function __construct($engineType)
    {
        $this->engineType = $engineType;
        $data = $this->inputParam();

        if ($this->engineType === 0){
            $car = new Gasoline($data[0], $data[1]);
        }elseif ($this->engineType === 1){
            $car = new Diesel($data[0], $data[1]);
        }elseif ($this->engineType === 2){
            $car = new Hybrid($data[0], $data[1]);
        }else{
            $car = new Electric($data[0], $data[1]);
        }
        echo 'Total tax to pay: ' . $car->calculating() . ' Euro' . PHP_EOL;
    }

    public function inputParam(): array
    {
        $data = [];
        $counter = 1;
        while ($counter <= 2){
            if ($counter === 1){
                $temp = readline('Input car price: ');
                if (!is_numeric($temp) || empty($temp)){
                    echo 'Input correct price!' . PHP_EOL;
                    continue;
                }
            }else{

                $temp = readline('Input engine capacity, cm: ');
                if (!is_numeric($temp) || empty($temp)){
                    echo 'Input correct engine capacity!' . PHP_EOL;
                    continue;
                }
            }
            $data[] = abs($temp);
            $counter++;
        }
        return $data;
    }
}

do {
    $engine = readline('Input engine type (0 - Gasoline, 1 - Diesel, 2 - Hybrid, 3 - Exit): ');
}while(!in_array($engine, [0, 1, 2, 3]));
if (intval($engine) === 3){
    die();
}
$start = new Input($engine);
