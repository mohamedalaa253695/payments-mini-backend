<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SubcategoryController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize('edit', 'subcategories');

        $category =  Subcategory::create($request->only('name'));

        return response(new SubcategoryResource($category), Response::HTTP_CREATED);
    }
}
