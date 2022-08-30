@extends('front.layouts.master')
@section('content')
<section class="page-section clearfix">
    <div class="container">
        <div class="intro">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="{{asset('front_asset/assets/img/intro.jpg')}}" alt="..." />
            <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                <h2 class="section-heading mb-4">
                    <span class="section-heading-upper">{{__('general.subtitle')}}</span>
                    <span class="section-heading-lower">{{__('general.subtitle1')}}</span>
                </h2>
                <p class="mb-3">{{__('general.subtitle3')}}</p>
                <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" href="#!">{{__('general.subtitle4')}}</a></div>
            </div>
        </div>
    </div>
</section>
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">{{__('general.subtitle5')}}</span>
                        <span class="section-heading-lower">{{__('general.subtitle6')}}</span>
                    </h2>
                    <p class="mb-0">{{__('general.subtitle7')}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
