<link href="{{ asset('backend/libs/bootstrap-icons/font/bootstrap-icons.css') }} " rel="stylesheet">

<link href="{{ asset('backend/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet">

<link href="{{ asset('backend/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">

<!-- Theme CSS -->

<link rel="stylesheet" href="{{ asset('backend/css/theme.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">

{{-- Custom Css For Frontend --}}

<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

<!-- Linearicons -->

<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">



<!-- boxicons -->

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>



<!-- Toastr CSS -->

<link rel="stylesheet" href="{{ asset('backend/libs/toastr/toastr.css') }}">



<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

<link rel="stylesheet"
    href="{{ asset('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Roboto&display=swap') }}">

<style>
    .dash-breadcrumb-tree {

        padding: 35px 40px;

    }



    .active>.page-link,

    .page-link.active {

        color: rgb(18, 18, 18) !important;

    }



    .navbar-vertical .navbar-brand {

        text-align: center
    }



    .journal-write-btn {

        color: #0b75f1 !important;

        border: 1px solid #0b75f1;

    }



    .journal-btn li a {

        color: #0b75f1 !important;

        border: 1px solid #0b75f1;

    }



    .write-journal-title a {

        color: #0b75f1 !important;

    }



    @media only screen and (max-width:1024px) {
        #app-content {
            margin-left: 0 !important;
        }

        .navbar-vertical {
            z-index: 999;
        }
    }

    @media only screen and (min-width: 361px) and (max-width: 479px) {
        .browse-category {
            grid-template-rows: none;
        }
    }



    @media only screen and (min-width: 361px) and (max-width: 479px) {

        .browse-category {

            grid-template-rows: none;

        }

    }

    a {
        background: transparent;
    }
</style>

@stack('style')
