<?php

namespace App\Services\DMS;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentTypeService
{
    public function getAll()
    {
        return DocumentType::latest('id')->paginate(10);
    }

    public function find(int $id): DocumentType
    {
        return DocumentType::findOrFail($id);
    }

    public function store(Request $request): DocumentType
    {
        DB::beginTransaction();

        try {

            $documentType = DocumentType::create([

                'document_type_name' => $request->document_type_name,

                'document_type_code' => $request->document_type_code,

                'description' => $request->description,

                'status' => $request->status

            ]);

            DB::commit();

            return $documentType;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function update(Request $request, int $id): DocumentType
    {
        DB::beginTransaction();

        try {

            $documentType = DocumentType::findOrFail($id);

            $documentType->update([

                'document_type_name' => $request->document_type_name,

                'document_type_code' => $request->document_type_code,

                'description' => $request->description,

                'status' => $request->status

            ]);

            DB::commit();

            return $documentType;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function destroy(int $id): bool
    {
        DB::beginTransaction();

        try {

            DocumentType::findOrFail($id)->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }
}
