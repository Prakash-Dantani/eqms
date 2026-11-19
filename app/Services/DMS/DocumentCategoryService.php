<?php

namespace App\Services\DMS;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentCategoryService
{
    /**
     * Get All
     */
    public function getAll()
    {
        return DocumentCategory::latest('id')->paginate(10);
    }

    /**
     * Find
     */
    public function find(int $id): DocumentCategory
    {
        return DocumentCategory::findOrFail($id);
    }

    /**
     * Store
     */
    public function store(Request $request): DocumentCategory
    {
        DB::beginTransaction();

        try {

            $category = DocumentCategory::create([

                'category_name' => $request->category_name,

                'category_code' => $request->category_code,

                'description' => $request->description,

                'status' => $request->status

            ]);

            DB::commit();

            return $category;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Update
     */
    public function update(Request $request, int $id): DocumentCategory
    {
        DB::beginTransaction();

        try {

            $category = DocumentCategory::findOrFail($id);

            $category->update([

                'category_name' => $request->category_name,

                'category_code' => $request->category_code,

                'description' => $request->description,

                'status' => $request->status

            ]);

            DB::commit();

            return $category;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Delete
     */
    public function destroy(int $id): bool
    {
        DB::beginTransaction();

        try {

            DocumentCategory::findOrFail($id)->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }
}
