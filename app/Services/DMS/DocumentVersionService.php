<?php

namespace App\Services\DMS;

use App\Models\Document;
use App\Models\DocumentMaster;
use App\Models\DocumentVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentVersionService
{
    /**
     * Create first version or next version automatically.
     */
    public function createOrUpdateVersion(Document $document, Request $request): DocumentVersion
    {
        return DB::transaction(function () use ($document, $request) {

            /*
            |--------------------------------------------------------------------------
            | Current Version
            |--------------------------------------------------------------------------
            */

            $currentVersion = $document->currentVersion;
            // dd($document);

            if (!$this->hasChanges($document, $request)) {

                return $currentVersion;
            }

            /*
            |--------------------------------------------------------------------------
            | Archive Current Version
            |--------------------------------------------------------------------------
            */

            if ($currentVersion) {
                $this->archiveCurrent($document);
            }

            /*
            |--------------------------------------------------------------------------
            | Upload New File
            |--------------------------------------------------------------------------
            */

            $documentMasterId = $currentVersion?->document_master_id ?? null;

            if ($request->hasFile('attachment')) {

                $documentMasterId = $this->storeDocumentFile(
                    $document->document_no,
                    $request->file('attachment')
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Version Number
            |--------------------------------------------------------------------------
            */

            // dd($currentVersion->version_no);

            $version = $currentVersion
                ? $this->nextVersion($currentVersion->version_no)
                : '1.0';

            /*
            |--------------------------------------------------------------------------
            | Create Version
            |--------------------------------------------------------------------------
            */
            // dd('Document version Service call', $document);
            $newVersion = DocumentVersion::create([

                'document_id'        => $document->id,

                'version_no'            => $version,

                'title'              => $document->title,

                'description'        => $request->description,

                'document_master_id' => $documentMasterId,
                'document_type_id' => $document->document_type_id,
                'category_id' => $document->category_id,
                'department_id' => $document->department_id,
                'html_content' => $request->description,

                'effective_date'     => $document->effective_date,

                'review_date'        => $document->review_date,

                'expiry_date'        => $document->expiry_date,

                'status'             => 'Draft',

                'change_summary'     => $request->change_summary,

                'is_current'         => 1,

                'created_by'         => Auth::id()

            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Master
            |--------------------------------------------------------------------------
            */

            $docuement_rec = Document::findOrFail($document->id);
            $isupdated = $docuement_rec->update([
                'current_version_id' => $newVersion->id,

                'current_status'     => $newVersion->status,

                'version'            => $version,
                'owner' => 'Prakash'
            ]);


            // dd($document->id, $newVersion->id, $isupdated);
            return $newVersion;
        });
    }

    /**
     * Archive current version.
     */
    private function archiveCurrent(Document $document): void
    {
        DocumentVersion::where('document_id', $document->id)
            ->where('is_current', 1)
            ->update([
                'is_current' => 0
            ]);
    }

    /**
     * Store uploaded document.
     */
    private function storeDocumentFile(string $documentNo, $file): int
    {
        $content = base64_encode(file_get_contents($file));

        $master = DocumentMaster::create([

            'document_no' => $documentNo,

            'data' => $content,

            'created_by' => Auth::id()

        ]);

        return $master->id;
    }

    /**
     * Generate next minor version.
     *
     * 1.0 -> 1.1
     * 1.9 -> 2.0
     */
    public function nextVersion(string $version): string
    {
        [$major, $minor] = array_pad(explode('.', $version), 2, 0);

        $major = (int) $major;
        $minor = (int) $minor;

        $minor++;

        if ($minor >= 10) {
            $major++;
            $minor = 0;
        }

        return "{$major}.{$minor}";
    }

    /**
     * Generate next major version.
     */
    public function nextMajorVersion(string $version): string
    {
        [$major] = explode('.', $version);

        $major++;

        return "{$major}.0";
    }

    private function hasChanges(Document $document, Request $request): bool
    {
        $current = $document->currentVersion;

        if (!$current) {
            return true;
        }

        /*
    |--------------------------------------------------------------------------
    | Content Changed
    |--------------------------------------------------------------------------
    */

        if (trim($current->description) !== trim($request->description)) {
            return true;
        }

        /*
    |--------------------------------------------------------------------------
    | New Attachment Uploaded
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('attachment')) {
            return true;
        }

        /*
    |--------------------------------------------------------------------------
    | Dates Changed
    |--------------------------------------------------------------------------
    */

        if ($current->effective_date != $document->effective_date) {
            return true;
        }

        if ($current->review_date != $document->review_date) {
            return true;
        }

        if ($current->expiry_date != $document->expiry_date) {
            return true;
        }

        return false;
    }
}
