<?php
namespace App\Http\Controllers\DMS;

use App\Http\Controllers\Controller;
use App\Services\DMS\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    private $service;

    public function __construct(DocumentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $documents = $this->service->getAll();

        return view('dms.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('dms.documents.create');
    }

    public function store(Request $request)
    {

        $request->validate([

            'title'         => 'required',

            'document_type' => 'required',

            'category'      => 'required',

        ]);

        $this->service->store($request);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document Created Successfully');

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
