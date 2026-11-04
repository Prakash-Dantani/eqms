<x-app-layout>

    <div class="page-header">

        <div>
            <h1 class="page-title">Create Document</h1>

        </div>

    </div>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            <div class="col-lg-12">
                <div class="main-container">
                    <div class="presence" id="editor-presence"></div>
                    <div class="editor-container editor-container_classic-editor editor-container_include-annotations editor-container_include-word-count editor-container_include-fullscreen"
                        id="editor-container">
                        <div class="editor-container__editor-wrapper">
                            <div class="editor-container__editor">
                                <div id="editor"></div>
                                <div class="editor_container__word-count" id="editor-word-count"></div>
                            </div>
                            <div class="editor-container__sidebar" id="editor-annotations"></div>
                        </div>
                    </div>
                    <div class="revision-history" id="editor-revision-history">
                        <div class="revision-history__wrapper">
                            <div class="revision-history__editor" id="editor-revision-history-editor"></div>
                            <div class="revision-history__sidebar" id="editor-revision-history-sidebar"></div>
                        </div>
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