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
                                    <h4 class="card-title">Subscribers</h4>

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
                                <table class="table table-bordered table-striped" id="subscribers"">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Subscribed on
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
                                        @foreach ($subscribers as $subscriber)
                                            <tr>
                                                <td>
                                                    {{ $subscriber['id'] }}
                                                </td>
                                                <td>
                                                    {{ $subscriber['email'] }}
                                                </td>
                                                <td>
                                                    {{ date('F j,Y,g:i a', strtotime($subscriber['created_at'])) }}
                                                </td>
                                                <td>
                                                    @if ($subscriber['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateSubscriberStatus"
                                                            id="subscriber-{{ $subscriber['id'] }}"
                                                            subscriber_id="{{ $subscriber['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($subscriber['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateSubscriberStatus"
                                                            id="subscriber-{{ $subscriber['id'] }}"
                                                            subscriber_id="{{ $subscriber['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="confirmDelete" module="subscriber"
                                                        moduleid="{{ $subscriber['id'] }}">
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
