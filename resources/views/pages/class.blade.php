@extends('layout.class')

@section('title', __('Event details'))

@section('page_wrapper_class', 'page-classes')

@section('class-top-section')

<div class="class-top-section">
    <div class="desktop-wide-wrap">
        <div class="class-top-section-grid">
            <div class="round-desktop"></div>
            <div class="text-block">
                <div class="title">
                    {{ $class->title }}
                </div>
                <div class="description">
                    <?php // ! TODO: Check short description !!! Maybe we must add tiny desc for class !!!?>
                    In this class we cover everything you need to know to get your MA LTC. Including fundamentals, state laws, storage and more.
                    <!-- {{$class->short_description}} -->
                </div>
                <span>
                    Course Cost:
                </span>
                <div class="cost-block">
                    ${{ $class->price }}
                </div>
                @if($class->hasLiveFire())
                <div class="life-fire">
                    This is a LIVE FIRE course - train with real firearms.
                </div>
                @endif
            </div>
{{--            @if ($class->isContactFormOnly())--}}
                @include('includes.classes.partials.class-sign-up-form')
{{--            @else--}}
{{--                @include('includes.classes.partials.class-calendar')--}}
{{--            @endif--}}
        </div>
    </div>
</div>

@stop

@section('class-central-section')
    @if ($class->hasCustomTemplate())
        @include('includes.classes.featured.'.$class->custom_template)
    @else
        @include('includes.classes.partials.class-description-default')
    @endif
@stop

@section('class-faq')
    {{--{{ dd($class->faqs) }}--}}
    @includeWhen(!empty($class->faqs), 'includes.classes.partials.class-faq')
@stop

@section('class-other-classes')
    @includeIf(!$class->IsFeatured(), 'includes.classes.partials.other-classes')
@stop

@push('styles')
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css">
@endpush

@push('footer-scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="/js/common.js" type="text/javascript"> </script>
@endpush
