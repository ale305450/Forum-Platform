<?php

namespace App\Http\Controllers;

use App\Core\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\Categories\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return response()->json([
            'data' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->toDto());

        return response()->json([
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        return response()->json([
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->update($id, $request->toDto());

        return response()->json([
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        return response()->json([
            'message' => 'Category deleted succfully'
        ]);
    }
}
