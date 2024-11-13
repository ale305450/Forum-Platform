<?php

namespace app\Core\DTOs\Responses;

class UpdateResponseDto
{
    public string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
