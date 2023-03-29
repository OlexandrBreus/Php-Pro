<?php

function mail2(Email $to, string $subject, string $message ){
    echo '----Sending mail-----' . PHP_EOL;
    return true;
}

class Email
{
    const DEFAULT_SUBJECT = 'Untitled';
    protected string $email;
    protected static int $counter = 0;

    public function __construct(string $email)
    {
        self::$counter++;
        $this->email = $email;
        $this->validateEmail();
    }

    protected function validateEmail(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException('Email '. $this->email . ' is invalid');
        }
    }

    public function sendMail(string $text, string $subject = self::DEFAULT_SUBJECT)
    {
        if (!mail2($this, $subject, $text)){
            throw new RuntimeException('Email '. $this->email . ' not sent');
        }
    }

    public static function count(): int
    {
        return self::$counter;
    }
}

class BatchEmail extends Email
{
    const DEFAULT_SUBJECT = 'Untitled massage';
    protected static int $counter = 0;

    protected function validateEmail(): void
    {
        parent::validateEmail();
        if (in_array($this->email, $this->banList)){
            throw new \http\Exception\InvalidArgumentException('Email ' . $this->email . ' is banned');
        }
    }
    protected array $banList = [
        'example@gmail.com'
    ];

    /**
     * @param Email[] $emails
     * @param string $text
     * @param string $subject
     * @return void
     */

    public function sendBatchMail(array $emails, string $text, string $subject = self::DEFAULT_SUBJECT)
    {
        foreach ($emails as $email){
            $email->sendMail($text, $subject);
        }

    }
}

try {
    $objEmail = new BatchEmail('example@gmail.com');
    $objEmail1 = new BatchEmail('example1@gmail.com');
    $objEmail2 = new BatchEmail('example2@gmail.com');
    $objEmail3 = new BatchEmail('example3@gmail.com');
    $objEmail4 = new BatchEmail('example4@gmail.com');
    $objEmail->sendBatchMail([
        $objEmail1,
        $objEmail2,
        $objEmail3,
        $objEmail4,
    ], 'Text email');
    echo '=============' . PHP_EOL;
    echo Email::count();
}catch (\Exception $e){
    echo $e->getMessage();
}



echo PHP_EOL;
echo '-----Program end-----';
echo PHP_EOL;









echo PHP_EOL;
