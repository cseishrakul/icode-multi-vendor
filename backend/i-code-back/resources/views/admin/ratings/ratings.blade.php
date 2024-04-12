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
                                    <h4 class="card-title">Ratings</h4>

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
                                <table class="table table-bordered table-striped" id="rating">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Product Name
                                            </th>
                                            <th>
                                                User Email
                                            </th>
                                            <th>
                                                Review
                                            </th>
                                            <th>
                                                Rating
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ratings as $rating)
                                            <tr>
                                                <td>
                                                    {{ $rating['id'] }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('product/' . $rating['product']['id']) }}" target="_blank">{{ $rating['product']['product_name'] }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $rating['user']['email'] }}
                                                </td>
                                                <td>
                                                    {{ $rating['review'] }}
                                                </td>
                                                <td>
                                                    {{ $rating['rating'] }}
                                                </td>
                                                <td>
                                                    @if ($rating['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateRatingStatus"
                                                            id="rating-{{ $rating['id'] }}" rating_id="{{ $rating['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($rating['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateRatingStatus"
                                                            rating-{{ $rating['id'] }}" rating_id="{{ $rating['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                    <a href="javascript:void(0)" class="confirmDelete" module="rating"
                                                        moduleid="{{ $rating['id'] }}">
                                                        <i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i>
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
