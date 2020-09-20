@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View GMB Prices</h2>
        <p>Soil Types</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">GMB Prices Table</h3>
            <div class="text-right">
                <a type="submit" href="{{route('gmb.create')}}"
                   class="btn btn-success" title="Add"><i class="fas fa-user-plus"></i> Add GMB Price</a>
            </div>
            <br>
            <div class="example-box-wrapper">
                <table id="datatable-row-highlight" class="table table-striped table-bordered"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Crop Name</th>
                        <th>Price Per KG</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Crop Name</th>
                        <th>Price Per KG</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($prices as $price)
                        <tr>
                            <td>{{$price->crop}}</td>
                            <td>{{$price->price}}</td>
                            <td>
                                <div class="row">
                                    <div class="form-group">

                                        <div class="col col-3">
                                            <a class="btn btn-default" href="{{ route('gmb.edit', $price->id)}}">Edit</a>
                                        </div>
                                        <div class="col col-3">
                                            <form action="{{ route('gmb.destroy', $price->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger" title="Delete">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
