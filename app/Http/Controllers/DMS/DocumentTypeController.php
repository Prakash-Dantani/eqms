<?php

namespace App\Http\Controllers\DMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\DMS\DocumentTypeRequest;
use App\Services\DMS\DocumentTypeService;

class DocumentTypeController extends Controller
{
    protected DocumentTypeService $service;

    public function __construct(DocumentTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $documentTypes = $this->service->getAll();

        return view('dms.document-type.index', compact('documentTypes'));
    }

    public function create()
    {
        return view('dms.document-type.create');
    }

    public function store(DocumentTypeRequest $request)
    {
        $this->service->store($request);

        return redirect()
            ->route('document-type.index')
            ->with('success', 'Document Type created successfully.');
    }

    public function edit($id)
    {
        $documentType = $this->service->find($id);

        return view('dms.document-type.edit', compact('documentType'));
    }

    public function update(DocumentTypeRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()
            ->route('document-type.index')
            ->with('success', 'Document Type updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('document-type.index')
            ->with('success', 'Document Type deleted successfully.');
    }
}
