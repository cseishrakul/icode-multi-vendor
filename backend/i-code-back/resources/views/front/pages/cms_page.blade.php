@extends('front.layouts.layout')
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>
                    <a href="" class="text-light">{{ $cmsPageDetails['title'] }}</a>
                </h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="cart.html">{{ $cmsPageDetails['title'] }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="text-align:center">
                    <p> {{$cmsPageDetails['description']}} </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection
