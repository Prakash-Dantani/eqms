<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Documents List</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">DMS</li>
                    <li class="breadcrumb-item active">Documents</li>
                </ol>
            </div>
        </div>

        <div class="ms-auto">

            <a href="{{ route('documents.create') }}" class="btn btn-quick-action">

                <i class="fe fe-plus"></i>

                Add Document

            </a>

        </div>


    </div>

    <div class="row g-4">

        <!-- Document Information -->

        <div class="col-lg-12">

            <div class="card border-light shadow-sm p-1 h-100">

                <!-- <h5 class="card-title mb-4">
                Documents List
            </h5> -->


                <!-- START: Basic Table Card Container -->
                <div class="table-card-custom">


                    <!-- Responsive Table Wrapper -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle" id="documentTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Document No</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Department</th>
                                    <th>Owner</th>
                                    <th>Version</th>
                                    <th>Status</th>
                                    <th width="180">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($documents as $document)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $document->document_no }}</td>

                                    <td>{{ $document->title }}</td>

                                    <td>{{ $document->documentType?->document_type_name }}</td>

                                    <td>{{ $document->category?->category_name }}</td>

                                    <td>{{ $document->department?->department_name }}</td>

                                    <td>{{ $document->owner }}</td>

                                    <td>{{ $document->version }}</td>

                                    <td>

                                        @switch($document->status)

                                        @case('Approved')
                                        <span class="badge bg-success">
                                            Approved
                                        </span>
                                        @break

                                        @case('Rejected')
                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>
                                        @break

                                        @case('Pending Review')
                                        <span class="badge bg-warning">
                                            Pending Review
                                        </span>
                                        @break

                                        @default
                                        <span class="badge bg-secondary">
                                            {{ $document->status }}
                                        </span>

                                        @endswitch

                                    </td>

                                    <td>

                                        <a href="{{ route('documents.show',$document->id) }}" target="_blank"
                                            class="btn btn-sm btn-primary">

                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('documents.edit',$document->id) }}"
                                            class="btn btn-sm btn-warning">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <a href="{{ route('document-edit',$document->id) }}"
                                            class="btn btn-sm btn-success">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="10" class="text-center">

                                        No documents found.

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>


                </div>

            </div>





        </div>
        <script src="assets/js/dashboard.js"></script>

</x-app-layout>
<script>
    $(document).ready(function() {

        $('#documentTable').DataTable({
            responsive: true,
            pageLength: 10,
            autoWidth: false,
            ordering: true,
            searching: true,
            info: true,
            lengthChange: true,
            language: {
                search: "",
                searchPlaceholder: "Search documents..."
            }
        });

    });
</script>