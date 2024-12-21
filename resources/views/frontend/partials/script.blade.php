<script type="text/javascript" src="{{ asset('frontend/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/init.js') }}"></script>

<script type="text/javascript" src="{{ asset('frontend/js/custom.js') }}"></script>



<!-- Toastr JS -->
<script src="{{ asset('backend/libs/toastr/toastr.js') }}"></script>
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('t-success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.success("{{ session('t-success') }}");
        @endif
        @if (Session::has('t-error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.error("{{ session('t-error') }}");
        @endif
        @if (Session::has('t-info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.info("{{ session('t-info') }}");
        @endif
        @if (Session::has('t-warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.warning("{{ session('t-warning') }}");
        @endif
    });
</script>
<!-- CSRF -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function markAsRead(button, id, link) {
        var url = '{{ route('markAsRead', ':id') }}';
        $.ajax({
            type: "GET",
            url: url.replace(':id', id),
            success: function(resp) {
                if (resp.success === true) {
                    button.classList.remove('bg-light');
                    window.location.href = link;
                }
            }, // success end
            error: function(error) {
                toastr.error("Something Went Wrong");
            } // Error
        })
    }
</script>
@stack('script')
