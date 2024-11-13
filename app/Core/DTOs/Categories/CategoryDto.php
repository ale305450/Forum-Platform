<?php

namespace app\Core\DTOs\Categories;

class CategoryDto
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}