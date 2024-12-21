@extends('frontend.layout.profile.master_layout')
@push('style')
    <style>
        @media only screen and (min-width: 400px) and (max-width: 767px) {
            .books-collection {
                padding: 0 20% !important;
            }
        }
    </style>
@endpush
@section('tab_section')

    <section class="user--books--area user--padding">

        <div class="books-collection row" id="book_collection">

            @forelse ($books as $book)
                <div class="book col-md-4 col-lg-3 col-xl-2 col-12 my-5 mt-md-0" id="book_{{ $book['book']['id'] }}">

                    <div class="card h-100 d-flex flex-column">

                        <img src="{{ asset($book['book']['feature_image']) }}" alt="{{ $book['book']['book_name'] }}"
                            class="w-100 book-image" style=" border-radius: 0.5rem 0.5rem 0 0;">

                        <!--View Book button start -->

                        <span>

                            <input type="button" value="View Book"
                                class="btn btn-primary position-absolute start-50 translate-middle d-none d-lg-block"
                                data-bs-toggle="modal" data-bs-target="#{{ $book['book']['book_slug'] }}"
                                style="top: 40%; ">

                            <a href="{{ route('book.singlePage', $book['book']['id']) }}"
                                class="btn btn-primary position-absolute start-50 translate-middle d-block d-lg-none"
                                style="top: 34%;">

                                View

                            </a>

                        </span>

                        <!--View Book button start -->

                        <!-- Modal start -->

                        <div class="book-modal">

                            <div class="modal modal-lg fade" id="{{ $book['book']['book_slug'] }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-scrollable">

                                    <div class="modal-content book-modal">

                                        <div class="modal-header">

                                            <h3 class="modal-title" id="exampleModalLabel">

                                                Book: "{{ $book['book']['book_name'] }}"</h3>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>

                                        <div class="modal-body">

                                            <embed src="{{ asset($book['book']['file']) }}#toolbar=0&theme=light"
                                                type="application/pdf" width="100%" height="600px">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Modal end -->

                        @php
                            $redColor = '';
                            foreach ($book['book']['book_favourites'] as $fav) {
                                if ($fav['book_id'] == $book['book']['id'] && $fav['user_id'] == auth()->user()->id) {
                                    $redColor = 'text-danger';
                                }
                            }
                        @endphp
                        <button type="button"
                            class="border-0 rounded-circle position-absolute d-flex align-items-center justify-content-center shadow"
                            style="top: 10px; right: 16px; height: 40px; width: 40px;"
                            onclick="bookFavorite(this, '{{ $book['book']['id'] }}')"><i
                                class="fa-solid fa-heart {{ $redColor }}" style="font-size: 18px !important;"></i>
                        </button>

                        <div class="px-3">

                            <h3 class="mt-3 text-hover" style="font-size: 1rem;">
                                {{ Str::limit($book['book']['book_name'], 20, '...') }}</h3>

                            <p class="p-1 px-2 fs-6 text-gray-500">
                                {{ Str::limit($book['book']['book_author'], 20, '...') }}</p>

                        </div>

                    </div>

                </div>

            @empty

                <h1 class="text-danger text-center h3">You haven't favorited a book yet</h1>
            @endforelse



        </div>



        <!-- pagination start  -->

        @if ($books->nextPageUrl() || $books->previousPageUrl())
            <nav>

                <ul class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

                    <!-- Previous Page Link -->

                    @if ($books->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">

                            <span class="page-link" aria-hidden="true">&lsaquo;</span>

                        </li>
                    @else
                        <li class="page-item">

                            <a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>

                        </li>
                    @endif



                    <!-- Pagination Elements -->

                    @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                        @if ($page == $books->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link">{{ $page }}</span>

                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>

                            </li>
                        @endif
                    @endforeach



                    <!-- Next Page Link -->

                    @if ($books->hasMorePages())
                        <li class="page-item">

                            <a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>

                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">

                            <span class="page-link" aria-hidden="true">&rsaquo;</span>

                        </li>
                    @endif

                </ul>

            </nav>
        @endif

        <!-- pagination End  -->

    </section>

@endsection
