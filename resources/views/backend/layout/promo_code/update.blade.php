@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Update Promo Code')
<!-- End:Title -->

<!-- Start:Content -->
@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="write-journal-title">
                        <h2>Update a Promo Code</h2>
                        <a class="bg-transparent" href="{{ route('promoCode.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Promo Code Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('promoCode.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Input Item -->
                                    <input type="hidden" value="{{ $promoCode->id }}" name="id">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="promo_code_title">Promo Code Title</label>
                                        <input type="text" name="promo_code_title" id="promo_code_title"
                                            class="form-control {{ $errors->has('promo_code_title') ? 'is-invalid' : '' }}"
                                            value="{{ $promoCode->promo_code_title }}">
                                        @if ($errors->has('promo_code_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('promo_code_title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="promo_code">Promo Code</label>
                                        <input type="text" name="promo_code" id="promo_code"
                                            class="form-control {{ $errors->has('promo_code') ? 'is-invalid' : '' }}"
                                            value="{{ $promoCode->promo_code }}">
                                        @if ($errors->has('promo_code'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('promo_code') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="discount_percentage">Discount Percentage</label>
                                        <input type="number" name="discount_percentage" id="discount_percentage"
                                            class="form-control {{ $errors->has('discount_percentage') ? 'is-invalid' : '' }}"
                                            value="{{ $promoCode->discount_percentage }}">
                                        @if ($errors->has('discount_percentage'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('discount_percentage') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                            value="{{ $promoCode->start_date }}">
                                        @if ($errors->has('start_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('start_date') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date"
                                            class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                            value="{{ $promoCode->end_date }}">
                                        @if ($errors->has('end_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('end_date') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-info text-white w-auto">Update</button>
                                        <a href="{{ route('promoCode.index') }}"
                                            class="btn btn-danger text-white w-auto">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
