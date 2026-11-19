<?php

namespace App\Http\Controllers\DMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\DMS\DocumentCategoryRequest;
use App\Services\DMS\DocumentCategoryService;

class DocumentCategoryController extends Controller
{
    protected DocumentCategoryService $service;

    public function __construct(DocumentCategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAll();

        return view('dms.document-category.index', compact('categories'));
    }

    public function create()
    {
        return view('dms.document-category.create');
    }

    public function store(DocumentCategoryRequest $request)
    {
        $this->service->store($request);

        return redirect()
            ->route('document-category.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->service->find($id);

        return view('dms.document-category.edit', compact('category'));
    }

    public function update(DocumentCategoryRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()
            ->route('document-category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('document-category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
