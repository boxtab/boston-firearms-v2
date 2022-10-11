@extends('layout.page_default')

@section('title', __('Firearms Safety Course MA | Boston Firearms Training Center'))

@section('page_wrapper_class', 'page-home')

@section('content')

<div class="page-home">
    @include('includes.home.hero-home')

    @include('includes.home.form-with-map')

    @include('includes.home.philosophy')

    @include('includes.home.reviews')

    @include('includes.home.map-google')

    @include('includes.footer.location-row')
</div>

@stop

@push('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css">
@endpush

@push('footer-scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/js/common.js" type="text/javascript"> </script>
@endpush
