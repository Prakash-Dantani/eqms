<?php
namespace App\Services\DMS;

use App\Models\Document;
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
        return Document::latest()->paginate(10);
    }

    /**
     * Find document
     */
    public function find(int $id): Document
    {
        return Document::findOrFail($id);
    }

    /**
     * Store document
     */
    public function store(Request $request): Document
    {
        DB::beginTransaction();

        try {

            $attachment = null;

            if ($request->hasFile('attachment')) {

                $attachment = $request->file('attachment')
                    ->store('documents', 'public');
            }

            $document = Document::create([

                'document_no'    => $this->generateDocumentNumber(),

                'title'          => $request->title,

                'document_type'  => $request->document_type,

                'category'       => $request->category,

                'department'     => $request->department,

                'owner'          => $request->owner,

                'version'        => '1.0',

                'effective_date' => $request->effective_date,

                'review_date'    => $request->review_date,

                'expiry_date'    => $request->expiry_date,

                'description'    => $request->description,

                'attachment'     => $attachment,

                'status'         => 'Draft',

                'created_by'     => auth()->id(),

                'updated_by'     => auth()->id(),

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
