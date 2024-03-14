@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Shipping Charges</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{$title}}</h4>
                            <hr>
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success: </strong> {{ Session::get('success_message') }}

                                    <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message') }}

                                    <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="forms-sample" action="{{ url('admin/edit-shipping-charge/'.$shippingDetails['id']) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control"value="{{$shippingDetails['country']}}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="0_500g">Rate (0_500g)</label>
                                            <input type="text" class="form-control" id="0_500g" name="0_500g" placeholder="Enter Shipping Rate for 0 - 500g" value="{{$shippingDetails['0_500g']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="501_1000g">Rate (501 - 1000g)</label>
                                            <input type="text" class="form-control" id="501_1000g" name="501_1000g" placeholder="Enter Shipping Rate for 501_1000g" value="{{$shippingDetails['501_1000g']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="1001_2000g">Rate (1001_2000g)</label>
                                            <input type="text" class="form-control" id="1001_2000g" name="1001_2000g" placeholder="Enter Shipping Rate for 1001_2000g" value="{{$shippingDetails['1001_2000g']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="2001_5000g">Rate (2001_5000g)</label>
                                            <input type="text" class="form-control" id="2001_5000g" name="2001_5000g" placeholder="Enter Shipping Rate for 2001_5000g" value="{{$shippingDetails['2001_5000g']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="above_5000g">Rate (Above 5000g)</label>
                                            <input type="text" class="form-control" id="above_5000g" name="above_5000g" placeholder="Enter Shipping Rate for Above 5000g" value="{{$shippingDetails['above_5000g']}}">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mr-2 w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
