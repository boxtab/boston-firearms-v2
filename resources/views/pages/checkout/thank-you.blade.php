@extends('layout.page_default')

@section('title', __('Thank You'))

@section('page_wrapper_class', 'page-state-course')

@section('content')
    @php
        //$sessionData = Session::get('checkout');
        $classTitle = null;
        $dateTime = null;
        if (isset($payment->booking->appointment->event->title)) {
            $classTitle = $payment->booking->appointment->event->title;
        } else if (isset($thank_you['courseTitle'])) {
            $classTitle = $thank_you['courseTitle'];
        }
        if (isset($payment->booking->appointment->date_time_formatted)) {
            $dateTime = $payment->booking->appointment->date_time_formatted;
        } else if (isset($thank_you['courseDate'])) {
            $dateTime = $thank_you['courseDate'];
        }
    @endphp
    <div class="page page-full-height page-thank-you">

        <div class="container">
            <div class="hero">

                <img src="/ico/like.svg" alt="">

                <div class="title">
                    <strong class="main">
                        Thank you
                    </strong>
                    <strong>
                        for signing up!
                    </strong>
                </div>

                <div class="important">
                    @if ( !empty ($classTitle) )
                    <p>
                        {{ $classTitle??'' }}
                    </p>
                    @endif
                    @if ( isset($dateTime) )
                    <p class="date">
                        {{ $dateTime??'' }}
                    </p>
                    @endif
                </div>

                <div class="also">
                    You will also receive an email from us requesting to
                    sign a waiver before taking the class.
                    Please fill out this form before attending.
                </div>

                <div class="share-row">
                    Think your friend will like this? Share
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
            </div>


        </div>


        <div class="footer-small-fixed">
            <p>
                If you have any questions please call us at
            </p>
            <p>
                <a href="tel:(617) 944-0985">
                    (617) 944-0985
                </a>
            </p>
        </div>
    </div>
@stop

@push('footer-scripts')
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fa44fab6bdd840019e02903&product=inline-share-buttons" async="async"></script>
@endpush
