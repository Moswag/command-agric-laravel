@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View Yields</h2>
        <p>Yields</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Yields Table</h3>
            <div class="example-box-wrapper">
                <table id="datatable-row-highlight" class="table table-striped table-bordered"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Farmer</th>
                        <th>Crop</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Farmer</th>
                        <th>Crop</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($yields as $yd)
                        <tr>
                            <td>{{$yd->farmerId}}</td>
                            <td>{{$yd->crop}}</td>
                            <td>{{$yd->quantity}}</td>
                            <td>{{$yd->date_created}}</td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
