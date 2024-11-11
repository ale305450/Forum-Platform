<?php

namespace app\Core\DTOs\Topics;

class CreateTopicDto
{
    public string $title;
    public string $description;
    public int $user_id;

    public function __construct(string $title, string $description, int $user_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->user_id = $user_id;
    }
}
