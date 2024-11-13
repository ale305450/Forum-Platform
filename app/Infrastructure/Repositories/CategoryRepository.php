<?php

namespace app\Infrastructure\Repositories;

use App\Core\Contracts\CategoryRepositoryInterface;
use app\Core\DTOs\Categories\CategoryDto;
use App\Core\Entities\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::all();
    }

    public function create(CategoryDto $categoryDto)
    {
        $category = Category::create([
            'name' => $categoryDto->name
        ]);

        return $category;
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function update($id, CategoryDto $categoryDto)
    {
        $category = $this->find($id);

        $category->update([
            'name' => $categoryDto->name
        ]);

        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        $category->delete();
    }
}
