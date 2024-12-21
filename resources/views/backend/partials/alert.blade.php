@if ($message = Session::get('alert-success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
        <span class="lnr lnr-thumbs-up"></span>&nbsp;
        <div>
            {{ $message }}
        </div>
        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif($message = Session::get('alert-error'))
    <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
        <span class="lnr lnr-warning"></span>&nbsp;
        <div>
            {{ $message }}
        </div>
        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif($message = Session::get('alert-warning'))
    <div class="alert alert-warning d-flex align-items-center alert-dismissible" role="alert">
        <span class="lnr lnr-warning"></span>&nbsp;
        <div>
            {{ $message }}
        </div>
        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

