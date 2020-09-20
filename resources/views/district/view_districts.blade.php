@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View Districts</h2>
        <p>Districts</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">District Table</h3>
            <div class="text-right">
                <a type="submit" href="{{route('district.create')}}"
                   class="btn btn-success" title="Add"><i class="fas fa-user-plus"></i> Add District</a>
            </div>
            <br>
            <div class="example-box-wrapper">
                <table id="datatable-row-highlight" class="table table-striped table-bordered"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Chief</th>
                        <th>Soil Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Chief</th>
                        <th>Soil Type</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($districts as $district)
                        <tr>
                            <td>{{$district->name}}</td>
                            <td>{{$district->chief}}</td>
                            <td>{{\App\Models\SoilType::find($district->soilTypeId)->name}}</td>
                            <td>
                                <div class="row">
                                    <div class="form-group">

                                        <div class="col col-3">
                                            <a class="btn btn-default" href="{{ route('district.edit', $district->id)}}">Edit</a>
                                        </div>
                                        <div class="col col-3">
                                            <form action="{{ route('district.destroy', $district->id)}}" method="post">
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
