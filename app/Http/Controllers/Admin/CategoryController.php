<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize('edit', 'categories');

        $category =  Category::create($request->only('name'));

        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }
}
