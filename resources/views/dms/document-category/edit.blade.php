<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Edit Document Category</h1>
        </div>

    </div>

    <form action="{{ route('document-category.update',$category->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Category Name
                            <span class="text-danger">*</span>

                        </label>

                        <input type="text" name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror"
                            value="{{ old('category_name',$category->category_name) }}">

                        @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Category Code
                            <span class="text-danger">*</span>

                        </label>

                        <input type="text" name="category_code"
                            class="form-control @error('category_code') is-invalid @enderror"
                            value="{{ old('category_code',$category->category_code) }}">

                        @error('category_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Description

                        </label>

                        <textarea name="description" rows="4"
                            class="form-control">{{ old('description',$category->description) }}</textarea>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select name="status" class="form-select">

                            <option value="1" {{ old('status',$category->status)==1 ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="0" {{ old('status',$category->status)==0 ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-3 text-end">

            <a href="{{ route('document-category.index') }}" class="btn btn-secondary">
                Cancel
            </a>

            <button type="submit" class="btn btn-success">
                Submit
            </button>

        </div>

    </form>

</x-app-layout>