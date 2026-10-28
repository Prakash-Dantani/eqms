<?php
namespace App\Services\DMS;

use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentMaster;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    /**
     * Get all documents
     */
    public function getAll()
    {
        return Document::with([
            'documentType',
            'category',
            'department',
        ])
            ->latest('id')
            ->paginate(10);
    }

    /**
     * Find document
     */
    public function find(int $id): Document
    {
        return Document::findOrFail($id);
    }

    public function getById($id)
    {
        return Document::with([
            'documentType',
            'category',
            'department',
            'documentData',
        ])->findOrFail($id);
    }

    public function createData(): array
    {
        return [

            'documentTypes' => DocumentType::where('status', 1)
                ->orderBy('document_type_name')
                ->get(),

            'categories'    => DocumentCategory::where('status', 1)
                ->orderBy('category_name')
                ->get(),

            'departments'   => Department::where('status', 1)
                ->orderBy('department_name')
                ->get(),

            'owners'        => User::where('status', 'Active')
                ->orderBy('name')
                ->get(),

        ];
    }

    /**
     * Store document
     */
    public function store(Request $request): Document
    {
        DB::beginTransaction();

        try {

            $attachment = null;

            $document_no = $this->generateDocumentNumber();

            if ($request->hasFile('attachment')) {

                // $attachment = $request->file('attachment')
                //     ->store('documents', 'public');

                $file        = $request->file('attachment');
                $name        = $file->getClientOriginalName();
                $type        = $file->extension();
                $fileContent = base64_encode(file_get_contents($file));

                $document_rec = DocumentMaster::create([
                    'document_no' => $document_no,
                    'data'        => $fileContent,
                    'created_by'  => auth()->id(),
                ]);
                $document_id = $document_rec->id;
            }

            // dd($request->all());
            $document = Document::create([

                'document_id'      => $document_id,
                'document_no'      => $document_no,
                'title'            => $request->title,
                'document_type_id' => $request->document_type_id,
                'category_id'      => $request->category_id,
                'department_id'    => $request->department_id,
                'owner'            => $request->owner,
                'version'          => $request->version,
                'effective_date'   => $request->effective_date,
                'review_date'      => $request->review_date,
                'expiry_date'      => $request->expiry_date,
                'description'      => $request->description,
                // 'attachment'       => $attachment,
                'status'           => 'Draft',
                'created_by'       => auth()->id(),
            ]);

            DB::commit();

            return $document;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Update document
     */
    public function update(Request $request, int $id): Document
    {
        DB::beginTransaction();

        try {

            $document = Document::findOrFail($id);

            if ($request->hasFile('attachment')) {

                if ($document->attachment) {

                    Storage::disk('public')->delete($document->attachment);
                }

                $document->attachment = $request->file('attachment')
                    ->store('documents', 'public');
            }

            $document->title          = $request->title;
            $document->document_type  = $request->document_type;
            $document->category       = $request->category;
            $document->department     = $request->department;
            $document->owner          = $request->owner;
            $document->effective_date = $request->effective_date;
            $document->review_date    = $request->review_date;
            $document->expiry_date    = $request->expiry_date;
            $document->description    = $request->description;
            $document->updated_by     = auth()->id();

            $document->save();

            DB::commit();

            return $document;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Delete document
     */
    public function destroy(int $id): bool
    {
        DB::beginTransaction();

        try {

            $document = Document::findOrFail($id);

            if ($document->attachment) {

                Storage::disk('public')->delete($document->attachment);
            }

            $document->delete();

            DB::commit();

            return true;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Generate Document Number
     * Example : DOC-000001
     */
    private function generateDocumentNumber(): string
    {
        $last = Document::latest('id')->first();

        if (! $last) {
            return 'DOC-000001';
        }

        $number = (int) str_replace('DOC-', '', $last->document_no);

        $number++;

        return 'DOC-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
