@extends('frontend.layout.master')
@section('title', "$pageData->page_title")
@push('style')
    <style>
        .policy-page-wrapper {
            min-height: 60vh;
        }
    </style>
@endpush
@section('content')
    <div id="landing-breadcrumb" class="lb-wrapper pb-5">
        <div class="lb-container">
            <div class="lb-main">
                <h3 class="lb-active-page">{{ $pageData->page_title }}</h3>
                <ul class="lb-tree m-0 p-0">
                    <li class="lb-tree-item"><a href="{{ route('root.page') }}"
                            class="lb-tree-item lb-tree-item-link disabled">Home</a></li>
                    <li class="lb-tree-item"><i class="bi bi-chevron-right"></i></li>
                    <li class="lb-tree-item"><a href="{{ route('custom.page', $pageData->page_slug) }}"
                            class="lb-tree-item lb-tree-item-link-active">{{ $pageData->page_title }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <section id="policy-page" class="policy-page-wrapper">
        <div class="policy-page-container">
            <div class="page-content">
                <h2 class="content-title">{{ $pageData->page_title }}</h2>
                {!! $pageData->page_content !!}
            </div>
        </div>
    </section>
@endsection
