<?php

namespace app\Core\DTOs\Topics;

class TopicDto
{
    public string $title;
    public string $description;
    public array $category_id;

    public function __construct(string $title, string $description, array $category_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
    }
}
