<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Document Type</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">DMS</li>
                    <li class="breadcrumb-item active">Document Type</li>
                </ol>
            </div>
        </div>

        <div class="ms-auto">

            <a href="{{ route('document-type.create') }}" class="btn btn btn-quick-action">

                <i class="bi bi-plus"></i>

                Add Type

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

                Document Type Master

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

                    @foreach($documentTypes as $type)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $type->document_type_name }}</td>

                        <td>{{ $type->document_type_code }}</td>

                        <td>{{ $type->description }}</td>

                        <td>

                            @if($type->status)

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

                            <a href="{{ route('document-type.edit',$type->id) }}" class="btn btn-primary btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('document-type.destroy',$type->id) }}" method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this document type ?')">

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