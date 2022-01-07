<?php
require_once 'Message.php';

class GuestBook
{
    private $file;

    public function __construct($file)
    {
        $directory = dirname($file);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (!file_exists($file)) {
            touch($file); //permet de créer un fichier
        }

        $this->file = $file;
    }

    public function addMessage(Message $message)
    {
        if (file_exists($this->file)) {
            file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
        }
    }

    public function getMessage(): array
    {
        if (file_exists($this->file) && file($this->file) != false) {
            $messages = [];
            foreach (file($this->file) as $line) {
                $messages[] = Message::fromJSON($line);
            }
            return array_reverse($messages);
        } else {
            return [];
        }
    }
}
