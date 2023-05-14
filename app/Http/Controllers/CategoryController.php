<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Tables\Categories;
use ProtoneMedia\Splade\Facades\Toast;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Categories::class
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        Toast::title('New category created successfully!')->autoDismiss(3);

        return to_route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        Toast::title('Category ' . $category->name . ' updated successfully!')->autoDismiss(3);

        return to_route('categories.index');
    }

    public function destroy(Category $category)
    {
        $destroy_category = $category->name;
        $category->delete();

        Toast::title('Category ' . $destroy_category . ' has been deleted!')->autoDismiss(3);

        return redirect()->back();
    }
}
