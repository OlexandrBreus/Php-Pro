<?php

interface ILogger
    {
        public function log(string $text): bool;

    }

interface IFormatter
{
    public function formatText(string $text): bool;

}
class Logger implements ILogger
{
    public function log(string $text): bool
    {
        echo __CLASS__;
        return true;
    }
}

class FileLogger extends Logger implements IFormatter
{
    public function log(string $text): bool
    {
        echo __CLASS__;
        return true;
    }

    public function formatText(string $text): bool
    {
        // TODO: Implement formatText() method.
        return strtolower($text);
    }
}

class DbLogger extends Logger
{
    public function log(string $text): bool
    {
        echo __CLASS__;
        return true;
    }
}

class TgLogger implements ILogger, IFormatter
{

    public function log(string $text): bool
    {
        // TODO: Implement log() method.
        echo __CLASS__;
        return true;
    }

    public function formatText(string $text): bool
    {
        return '<b>' .$text .'</b>';
    }
}

function application(DbLogger $logger)
{
    $logger->log('Some text');
}

application(new DbLogger());
echo PHP_EOL;
echo 'End Program';
echo PHP_EOL;
