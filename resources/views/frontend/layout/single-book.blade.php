@extends('frontend.app')
<!-- Start:Title -->
@section('title', "$book->book_name")
<!-- End:Title -->
@push('style')
    <style>
        #pdfViewer {
            max-width: 600px;
            margin: 16px auto 0;
            height: 80vh;
            overflow-y: auto;
        }

        #pdfViewer canvas {
            width: 100%;
        }

        .techwave_fn_page {
            height: 99vh;
        }
    </style>
@endpush
<!-- Start:Content -->
@section('content')
    <div class="generation_history">
        <div class="fn__generation_item">
            <!-- Title Shortcode -->
            <div class="techwave_fn_title_holder">
                <h1 class="title">{{ $book->book_name }}</h1>
            </div>
            <!-- !Title Shortcode -->
            <div id="pdfViewer"></div>

        </div>
    </div>
    {{-- <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">
                <div id="pdfViewer"></div>
            </div>
            <div class="section_right">
                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title">{{ $book->book_name }}</h1>
                </div>
                <!-- !Title Shortcode -->

                <div class="image-wrapper">
                    <img src="{{ asset($book->feature_image) }}" alt="{{ $book->book_name }}">
                </div>
                <div class="description-wrapper">
                    <p>
                        {!! $book->book_summary !!}
                    </p>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

<!-- Start:Script -->

@push('script')
    <!-- PDF.js library -->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js') }}"></script>
    <script>
        const pdfUrl = '{{ asset($book->file) }}';
        let pdfDoc = null;
        const pdfContainer = document.getElementById('pdfViewer');

        function renderPages(pdf) {
            const numPages = pdf.numPages;
            for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                pdf.getPage(pageNum).then(function(page) {
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    const viewport = page.getViewport({
                        scale: 1.5
                    });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    pdfContainer.appendChild(canvas);
                    page.render(renderContext);
                });
            }
        }
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            pdfDoc = pdf;
            renderPages(pdfDoc);
        });
    </script>
@endpush

<!-- End:Script -->
