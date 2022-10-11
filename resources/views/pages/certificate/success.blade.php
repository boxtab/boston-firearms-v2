@extends('layout.page_default')

@section('title', __('Payment Result'))

@section('page_wrapper_class', 'page-request')

@section('content')
    <div class="desktop-wide-wrap">
        <div class="request-success">
            <div class="main-img">
                <img src="/images/2022/request/request-success.png" alt="">
            </div>
            <h2>
                Keep an eye on your inbox...
            </h2>
            <div class="keep-columns">
                <div class="keep-row">
                    <div class="td-1">Payment Type</div>
                    <div class="td-2">Net banking</div>
                </div>
                {{--<div class="keep-row">
                    <div class="td-1">Bank</div>
                    <div class="td-2">ABCD</div>
                </div>--}}
                <div class="keep-row">
                    <div class="td-1">Mobile</div>
                    <div class="td-2">{{ $payment->client->phone }}</div>
                </div>
                <div class="keep-row">
                    <div class="td-1">Email</div>
                    <div class="td-2">{{ $payment->client->email }}</div>
                </div>
                <div class="keep-row paid">
                    <div class="td-1">Amount Paid</div>
                    <div class="td-2">{{ $payment->amount }} </div>
                </div>
                <div class="keep-row id">
                    <div class="td-1">Transaction ID</div>
                    <div class="td-2">{{ $payment->transaction_id }}</div>
                </div>
            </div>
            <div class="btn-row">

                @isset($payment->booking)
                    <a href="{{ route('certificate.payment.export', [$payment->booking->id, 'D']) }}" target="_blank" class="button">Download</a>
                    <a href="{{ route('certificate.payment.export', [$payment->booking->id, 'I']) }}" target="_blank" class="button">Print</a>
                @endisset

            </div>
            <div class="note">
                email was sent to you with the certificate.
            </div>
        </div>
    </div>

    @include('includes.footer.location-row')
@stop

