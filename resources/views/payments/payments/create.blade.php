@extends('layouts.admin')

@section('title', trans('general.title.new', ['type' => trans_choice('general.payments', 1)]))

@section('content')
    <!-- Default box -->
    <div class="box box-success">
        {!! Form::open(['url' => '/payments','role' => 'form']) !!}

        <div class="box-body">
            {{ Form::textGroup('payment_date', trans('general.date'), 'calendar', ['id' => 'payment_date', 'class' => 'form-control', 'required' => 'required', 'data-inputmask' => '\'alias\': \'dd-mm-yyyy\'', 'data-mask' => ''], Date::parse($payment->payment_date)->toDateString()) }}

            {{ Form::textGroup('paid_amount', trans('general.amount'), 'money', ['required' => 'required', 'autofocus' => 'autofocus']) }}

            {{ Form::textareaGroup('payment_terms', trans('general.payment_terms')) }}

            {{ Form::selectGroup('company_account_id', trans_choice('general.company', 1), 'folder-open-o', $categories) }}

            {{ Form::selectGroup('vendor_account_id', trans_choice('general.vendors', 1), 'user', $vendors, null, []) }}

            {{ Form::selectGroup('payment_type', trans_choice('general.payment_types', 1), 'credit-card', $payment_methods, null) }}

            {{ Form::textGroup('payment_reference', trans('general.reference'), 'file-text-o',[]) }}

            {{ Form::textGroup('payment_notes', trans('general.payment_notes'), 'file-text-o',[]) }}
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            {{ Form::saveButtons('/payments') }}
        </div>
        <!-- /.box-footer -->

        {!! Form::close() !!}
    </div>
@endsection

@push('js')
<script src="{{ asset('vendor/almasaeed2010/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/js/bootstrap-fancyfile.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/almasaeed2010/adminlte/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/bootstrap-fancyfile.css') }}">
@endpush
