<?php

namespace App\Core\Contracts;

use app\Core\DTOs\Categories\CategoryDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function create(CategoryDto $categoryDto);
    public function update($id, CategoryDto $categoryDto);
}
