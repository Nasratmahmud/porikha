@extends('frontend.layout.master')
@push('style')
    <style>
        .buttonHidden {
            visibility: hidden;
            height: 50px;
        }
    </style>
@endpush
@section('content')
    <!-- Video Section :: Start -->
    <section id="video-intro" class="video-section-wrapper">
        <div class="video-section-container">
            <div class="video-section-row">
                <div class="video-section-col promo-video-col">
                    <div id="player">
                        <iframe width="640" height="360"
                            src="https://www.youtube.com/embed/gqno7bxQwsA?si=ek0hgQJYWkq9uUGg&amp;controls=0&amp;autoplay=1&amp;showinfo=0&amp;disablekb=1&amp;stop=0&amp;rel=0"
                            title="YouTube video player" frameborder="0"
                            allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="video-section-col mt-3">
                    <div class="video-section-content video-section-content-left text-center">
                        <a id="get-started" href="{{ route('membership.package') }}"
                            class="hero-btn buttonHidden d-block">Subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section :: End -->
@endsection
@push('script')
    <script>
        setTimeout(() => {
            document.getElementById('get-started').classList.remove('buttonHidden')
        }, 38000);
    </script>
@endpush
