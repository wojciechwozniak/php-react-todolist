<?php

class Task
{
    public $id;
    public $content;
    public $done;

    public function __construct(int $id, string $content, bool $done)
    {
        $this->id = $id;
        $this->content = $content;
        $this->done = $done;
    }
}

?>
