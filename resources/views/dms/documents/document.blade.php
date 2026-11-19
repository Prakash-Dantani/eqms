<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Edit Document</h1>

        </div>

    </div>

    <form action="{{ route('update-document') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row g-4">
            <input type="hidden" name="id" id="id" value="{{ $document_rec->id }}">
            <select name="revision_type" class="form-select">

                <option value="minor">Minor Revision</option>

                <option value="major">Major Revision</option>

            </select>
            <div class="col-lg-12">
                <textarea class="form-control ckeditor" id="ckeditor-textarea" name="description"></textarea>

            </div>

        </div>



        <div class="mt-4 d-flex justify-content-end gap-2">

            <a href="{{ route('documents.index') }}" class="btn btn-secondary">

                Cancel

            </a>

            <button type="submit" class="btn btn-success">

                <i class="bi bi-check-circle"></i>

                Save Document

            </button>

        </div>

    </form>

</x-app-layout>
@include('components.ckeditor')