     <!-- Libs JS -->

     <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }} "></script>

     <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }} "></script>

     <script src="{{ asset('backend/libs/feather-icons/dist/feather.min.js') }} "></script>

     <script src="{{ asset('backend/libs/simplebar/dist/simplebar.min.js') }} "></script>

     <!-- Theme JS -->

     <script src="{{ asset('backend/js/theme.min.js') }} "></script>

     <script src="{{ asset('backend/libs/apexcharts/dist/apexcharts.min.js') }} "></script>

     <script src="{{ asset('backend/js/vendors/chart.js') }} "></script>



     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
         integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>



     <!--linear icons-->

     <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>





     <!-- Ajax CDN -->

     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
         integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
     </script>





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
         // Function to check if the device width falls within the mobile or tablet range
         function adjustClasses() {

             const body = document.querySelector('body');

             const screenWidth = window.innerWidth;



             if (screenWidth >= 991) {

                 document.getElementById('main-wrapper').classList.remove('toggled');

             } else if (screenWidth < 768) {

                 document.getElementById('main-wrapper').classList.remove('toggled');

             } else {

                 document.getElementById('main-wrapper').classList.add('toggled');

             }

         }



         // Run the function on page load and when the window is resized

         window.onload = adjustClasses;
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
                         document.getElementById('count-unread-notification').innerHTML = resp
                             .notification_count >
                             99 ? "99+" : resp.notification_count;
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
