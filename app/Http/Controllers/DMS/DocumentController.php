<?php

namespace App\Http\Controllers\DMS;

use App\Http\Controllers\Controller;
use App\Services\DMS\DocumentService;
use App\Services\DMS\DocumentVersionService;
use Illuminate\Http\Request;
use App\Models\Document;


class DocumentController extends Controller
{

    private $service;
    private $documentVersionService;

    public function __construct(DocumentService $service, DocumentVersionService $documentVersionService)
    {
        $this->service = $service;
        $this->documentVersionService = $documentVersionService;
    }

    public function index()
    {
        $documents = $this->service->getAll();

        return view('dms.documents.index', compact('documents'));
    }

    public function create()
    {
        $data = $this->service->createData();

        return view('dms.documents.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([

            'title'            => 'required',

            'document_type_id' => 'required',

            'category_id'      => 'required',

        ]);
        // dd($request->all());

        $this->service->store($request);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document Created Successfully');
    }

    public function show($id)
    {
        $document_rec  = $this->service->getById($id);
        $document_data = $document_rec->documentData;
        $bin           = base64_decode($document_data->data, true);
        return response($bin)->header('Content-Type', 'application/pdf');
    }

    // OLD Edit
    /* public function edit($id)
    {
        $document_rec = $this->service->getById($id);
        $data         = $this->service->createData();

        return view('dms.documents.edit', compact('data', 'document_rec'));
    } */

    public function edit($id)
    {
        $data = $this->service->editData($id);
        // echo "<pre>";
        // dd($data);
        return view('dms.documents.edit', $data);
    }

    public function update(Request $request, $id) {}


    public function documentEdit(Request $request, $id)
    {
        $document_rec = $this->service->getById($id);
        $data         = $this->service->createData();

        return view('dms.documents.document', compact('data', 'document_rec'));
    }

    public function updateDocument(Request $request)
    {
        $id = $request->id;
        // $document = $this->service->getById($id);

        $document = Document::findOrFail($id);

        $this->documentVersionService
            ->createOrUpdateVersion($document, $request);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document updated successfully.');



        // echo "<pre>";
        // dd($document_rec, $request->all());
        // $data         = $this->service->createVersion();

        // return view('dms.documents.document', compact('data', 'document_rec'));
    }


    public function destroy($id) {}
}
