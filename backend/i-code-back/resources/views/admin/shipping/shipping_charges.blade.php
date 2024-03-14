@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Shipping Charges</h4>

                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="btn btn-info">Shipping Charges</a>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive pt-3">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table class="table table-bordered table-striped" id="shipping">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Country Name
                                            </th>
                                            <th>
                                                Rate (0 - 500g)
                                            </th>
                                            <th>
                                                Rate (501 - 1000g)
                                            </th>
                                            <th>
                                                Rate (1001 - 2000g)
                                            </th>
                                            <th>
                                                Rate (2001 - 5000g)
                                            </th>
                                            <th>
                                                Rate (Above 5000g)
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippingCharges as $shippingCharge)
                                            <tr>
                                                <td>
                                                    {{ $shippingCharge['id'] }}
                                                </td>
                                                <td>
                                                    {{ $shippingCharge['country'] }}
                                                </td>
                                                <td>
                                                    {{ $shippingCharge['0_500g'] }}
                                                </td>
                                                <td>
                                                    {{ $shippingCharge['501_1000g'] }}
                                                </td>
                                                <td>
                                                    {{ $shippingCharge['1001_2000g'] }}
                                                </td>
                                                <td>
                                                    {{ $shippingCharge['2001_5000g'] }}
                                                </td>
                                                <td>
                                                    {{ $shippingCharge['above_5000g'] }}
                                                </td>
                                                <td>
                                                    @if ($shippingCharge['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateShippingStatus"
                                                            id="shipping-{{ $shippingCharge['id'] }}"
                                                            shipping_id="{{ $shippingCharge['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($shippingCharge['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateShippingStatus"
                                                            id="shipping-{{ $shippingCharge['id'] }}"
                                                            shipping_id="{{ $shippingCharge['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/edit-shipping-charge/' . $shippingCharge['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

        <!-- partial -->
    </div>
@endsection
