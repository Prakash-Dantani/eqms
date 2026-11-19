<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Document Categories</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">DMS</li>
                    <li class="breadcrumb-item active">Document Categories</li>
                </ol>
            </div>
        </div>

        <div class="ms-auto">

            <a href="{{ route('document-category.create') }}" class="btn btn btn-quick-action">

                <i class="bi bi-plus"></i>

                Add Category

            </a>

        </div>

    </div>


    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif


    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Category Master

            </h3>

        </div>

        <div class="card-body">

            <table id="datatable" class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th width="60">#</th>

                        <th>Name</th>

                        <th>Code</th>

                        <th>Description</th>

                        <th width="100">Status</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($categories as $category)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $category->category_name }}</td>

                        <td>{{ $category->category_code }}</td>

                        <td>{{ $category->description }}</td>

                        <td>

                            @if($category->status)

                            <span class="badge bg-success">

                                Active

                            </span>

                            @else

                            <span class="badge bg-danger">

                                Inactive

                            </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('document-category.edit',$category->id) }}"
                                class="btn btn-primary btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('document-category.destroy',$category->id) }}" method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this category ?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>


@push('scripts')

<script>
    $(function() {

        $('#datatable').DataTable({

            pageLength: 10,

            responsive: true

        });

    });
</script>

@endpush