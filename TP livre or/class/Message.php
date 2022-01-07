<?php
class Message
{
    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;
    private $errors = [];


    public function __construct(string $username, string $message, ?DateTime $date = null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date;
    }

    public function isValid(): bool
    {
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $this->errors[] = "Le pseudo fait moins de " . self::LIMIT_USERNAME . " caractères";
            return false;
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $this->errors[] = "Le message fait moins de " . self::LIMIT_MESSAGE . " caractères";
            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function toHTML()
    {
        $date = $this->date->format('d/m/Y à H:i');
        $message = nl2br(htmlspecialchars($this->message));
        $username = htmlspecialchars($this->username);

        return <<<HTML
            <p>
                <strong>{$username}</strong> <em>le {$date}</em> <br>
                {$message}
            </p>
HTML;
    }

    public function toJSON(): string
    {
        $array = [$this->username, $this->message, $this->date->getTimestamp()];
        return json_encode($array);
    }

    public static function fromJSON(string $json): Message
    {
        $arr = json_decode($json);
        $arr[2] = new DateTime(date('m/d/Y H:i:s', $arr[2]));
        $arr[2] = $arr[2]->setTimeZone(new DateTimeZone('Europe/Paris'));
        $msg = new Message($arr[0], $arr[1], $arr[2]);
        return $msg;
    }
}
