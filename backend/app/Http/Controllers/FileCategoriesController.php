<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileCategoryResource;
use App\Models\FileCategory;
use Illuminate\Http\JsonResponse;

class FileCategoriesController extends Controller
{
    /**
     * Display a listing of all file categories.
     */
    public function index(): JsonResponse
    {
        $categories = FileCategory::orderBy('name')->get();

        return $this->apiSuccess(
            FileCategoryResource::collection($categories)
        );
    }
}
