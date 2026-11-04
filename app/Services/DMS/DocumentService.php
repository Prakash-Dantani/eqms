<?php

namespace App\Services\DMS;

use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentMaster;
use App\Models\DocumentAttachment;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentVersion;
use App\Models\DocumentAuditLog;
use Illuminate\Support\Facades\Auth;

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
     * OLD Store document
     */
    /* public function store(Request $request): Document
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
    } */

    public function store(Request $request): Document
    {
        DB::beginTransaction();

        try {

            // Generate Document Number
            $documentNo = $this->generateDocumentNumber();

            // Create Document
            $document = $this->createDocument($documentNo);

            // Create Version 1.0
            $version = $this->createVersion($document, $request);

            // Upload Attachment
            if ($request->hasFile('attachment')) {
                $this->storeAttachment($version, $request->file('attachment'));
            }

            // Update Current Version
            $document->update([
                'current_version_id' => $version->id,
                'current_status'     => 'Draft'
            ]);

            // Audit Log
            $this->createAuditLog(
                $document->id,
                $version->id,
                'Created',
                'Document created successfully.'
            );

            DB::commit();

            return $document->load('currentVersion');
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }



    /**
     * OLD Update document
     */
    /* public function update(Request $request, int $id): Document
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
    */

    public function update(Request $request, int $id): Document
    {
        DB::beginTransaction();

        try {

            $document = Document::with('currentVersion')->findOrFail($id);

            // Only Draft document can be edited
            if ($document->currentVersion->status !== 'Draft') {

                throw new \Exception('Only Draft document can be edited.');
            }

            // Update Version Details
            $version = $document->currentVersion;

            $version->update([

                'title'             => $request->title,

                'document_type_id'  => $request->document_type_id,

                'category_id'       => $request->category_id,

                'department_id'     => $request->department_id,

                'owner_id'          => $request->owner,

                'html_content'      => $request->description,

                'effective_date'    => $request->effective_date,

                'review_date'       => $request->review_date,

                'expiry_date'       => $request->expiry_date,

                'updated_by'        => Auth::id(),

            ]);

            // Replace Attachment
            if ($request->hasFile('attachment')) {

                $this->replaceAttachment(
                    $version,
                    $request->file('attachment')
                );
            }

            // Audit
            $this->createAuditLog(

                $document->id,

                $version->id,

                'Edited',

                'Draft document updated.'

            );

            DB::commit();

            return $document->fresh(['currentVersion']);
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

    private function createDocument(string $documentNo): Document
    {
        return Document::create([

            'document_no' => $documentNo,

            'workflow_id' => 1,

            'current_status' => 'Draft',

            'created_by' => Auth::id()

        ]);
    }

    private function createVersion(Document $document, Request $request): DocumentVersion
    {
        return DocumentVersion::create([

            'document_id' => $document->id,

            'version_no' => '1.0',

            'major_version' => 1,

            'minor_version' => 0,

            'revision_no' => 0,

            'title' => $request->title,

            'document_type_id' => $request->document_type_id,

            'category_id' => $request->category_id,

            'department_id' => $request->department_id,

            'owner_id' => $request->owner,

            'html_content' => $request->description,

            'effective_date' => $request->effective_date,

            'review_date' => $request->review_date,

            'expiry_date' => $request->expiry_date,

            'status' => 'Draft',

            'is_current' => 1,

            'created_by' => Auth::id()

        ]);
    }

    private function storeAttachment(DocumentVersion $version, $file): void
    {
        $path = $file->store('documents', 'public');

        DocumentAttachment::create([

            'document_version_id' => $version->id,

            'file_name' => basename($path),

            'original_name' => $file->getClientOriginalName(),

            'file_path' => $path,

            'file_size' => $file->getSize(),

            'mime_type' => $file->getMimeType(),

            'uploaded_by' => Auth::id()

        ]);
    }

    private function createAuditLog(
        int $documentId,
        int $versionId,
        string $action,
        string $remarks = null
    ): void {

        DocumentAuditLog::create([

            'document_id' => $documentId,

            'document_version_id' => $versionId,

            'action' => $action,

            'performed_by' => Auth::id(),

            'remarks' => $remarks,

            'ip_address' => request()->ip(),

            'browser' => request()->userAgent(),

            'operating_system' => php_uname('s'),

            'device_type' => $this->deviceType(),

        ]);
    }

    private function deviceType(): string
    {
        $agent = strtolower(request()->userAgent());

        if (str_contains($agent, 'mobile')) {
            return 'Mobile';
        }

        if (str_contains($agent, 'tablet')) {
            return 'Tablet';
        }

        return 'Desktop';
    }

    private function replaceAttachment(DocumentVersion $version, $file): void
    {

        $oldAttachment = DocumentAttachment::where(
            'document_version_id',
            $version->id
        )->first();

        if ($oldAttachment) {

            Storage::disk('public')->delete($oldAttachment->file_path);

            $oldAttachment->delete();
        }

        $this->storeAttachment($version, $file);
    }

    public function editData(int $id): array
    {
        return [

            'document' => Document::with([

                'currentVersion',

                'currentVersion.documentType',

                'currentVersion.category',

                'currentVersion.department',

                'currentVersion.owner',

                'currentVersion.attachments'

            ])->findOrFail($id),

            'documentTypes' => DocumentType::whereStatus(1)
                ->orderBy('document_type_name')
                ->get(),

            'categories' => DocumentCategory::whereStatus(1)
                ->orderBy('category_name')
                ->get(),

            'departments' => Department::whereStatus(1)
                ->orderBy('department_name')
                ->get(),

            'owners' => User::where('status', 'Active')
                ->orderBy('name')
                ->get()

        ];
    }
}
