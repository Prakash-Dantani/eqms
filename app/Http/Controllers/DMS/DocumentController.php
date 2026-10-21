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
        return response()->json(
            $this->service->getById($id)
        );
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
