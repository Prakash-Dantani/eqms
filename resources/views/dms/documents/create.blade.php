<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Create Document</h1>

        </div>

    </div>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row g-4">
            <div class="col-lg-6">

                <div class="card border-light shadow-sm p-4 h-100">

                    <h5 class="card-title mb-4">
                        Document Information
                    </h5>

                    {{-- Document Number --}}

                    <div class="mb-3">

                        <label class="form-label-custom">
                            Document Number
                        </label>

                        <input type="text" class="form-control-custom" value="Auto Generated" readonly>

                    </div>

                    {{-- Title --}}

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Title

                        </label>

                        <input type="text" name="title" class="form-control-custom" value="{{ old('title') }}"
                            placeholder="Enter document title">

                    </div>

                    {{-- Type --}}

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Document Type

                        </label>

                        <select name="document_type_id" class="form-select-custom">

                            <option value="">Select Document Type</option>

                            @foreach ($documentTypes as $type)
                            <option value="{{ $type->id }}"
                                {{ old('document_type_id') == $type->id ? 'selected' : '' }}>

                                {{ $type->document_type_name }}

                            </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- Category --}}

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Category

                        </label>

                        <select name="category_id" class="form-select-custom">

                            <option value="">Select Category</option>

                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">

                                {{ $category->category_name }}

                            </option>
                            @endforeach

                        </select>

                    </div>

                </div>

            </div>



            <!-- Additional Details -->

            <div class="col-lg-6">

                <div class="card border-light shadow-sm p-4 h-100">

                    <h5 class="card-title mb-4">
                        Additional Details
                    </h5>

                    {{-- Department --}}

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Department

                        </label>

                        <select name="department_id" class="form-select-custom">

                            <option value="">Select Department</option>

                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">

                                {{ $department->department_name }}

                            </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- Owner --}}

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Owner

                        </label>

                        <input name="owner" type="text" class="form-control-custom" value="Admin" readonly />

                    </div>

                    {{-- Version --}}

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Version

                        </label>

                        <input type="text" name="version" value="1.0" class="form-control-custom">

                    </div>

                </div>

            </div>



            <!-- Dates -->

            <div class="col-lg-6">

                <div class="card border-light shadow-sm p-4">

                    <h5 class="card-title mb-4">

                        Document Dates

                    </h5>

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Effective Date

                        </label>

                        <input type="date" name="effective_date" class="form-control-custom">

                    </div>

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Review Date

                        </label>

                        <input type="date" name="review_date" class="form-control-custom">

                    </div>

                    <div>

                        <label class="form-label-custom">

                            Expiry Date

                        </label>

                        <input type="date" name="expiry_date" class="form-control-custom">

                    </div>

                </div>

            </div>



            <!-- Attachment -->

            <div class="col-lg-6">

                <div class="card border-light shadow-sm p-4">

                    <h5 class="card-title mb-4">

                        Attachment

                    </h5>

                    <div class="mb-3">

                        <label class="form-label-custom">

                            Upload Document

                        </label>

                        <input type="file" name="attachment" class="form-control-custom">

                    </div>

                    <div>

                        <label class="form-label-custom">

                            Description

                        </label>

                        <textarea name="description" rows="5" class="form-control-custom"></textarea>

                    </div>

                </div>

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