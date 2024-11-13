<?php

namespace app\Core\DTOs\Responses;

class CreateResponseDto
{
    public int $topic_id;
    public string $content;
    public ?int $parent_id;

    public function __construct(int $topic_id, string $content, ?int $parent_id)
    {
        $this->topic_id = $topic_id;
        $this->content = $content;
        $this->parent_id = $parent_id;
    }
}
