<!-- Google Fonts -->
<link rel="preconnect" href="{{ asset('https://fonts.googleapis.com/') }}">
<link rel="preconnect" href="{{ asset('https://fonts.gstatic.com/') }}">
<link
    href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&amp;family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">
<!-- !Google Fonts -->

<!-- Styles -->
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" />
<!-- !Styles -->
<!-- Toastr CSS -->
<link rel="stylesheet" href="{{ asset('backend/libs/toastr/toastr.css') }}">
@stack('style')
