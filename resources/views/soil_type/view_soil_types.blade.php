@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View Soil Types</h2>
        <p>Soil Types</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Soil Types Table</h3>
            <div class="text-right">
                <a type="submit" href="{{route('soil_type.create')}}"
                   class="btn btn-success" title="Add"><i class="fas fa-user-plus"></i> Add Soil Type</a>
            </div>
            <br>
            <div class="example-box-wrapper">
                <table id="datatable-row-highlight" class="table table-striped table-bordered"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($soils as $soil)
                        <tr>
                            <td>{{$soil->name}}</td>
                            <td>{{$soil->description}}</td>
                            <td>
                                <div class="row">
                                    <div class="form-group">

                                        <div class="col col-3">
                                            <a class="btn btn-default" href="{{route('soil_type.edit',$soil->id)}}">Edit</a>
                                        </div>
                                        <div class="col col-3">
                                            <a class="btn btn-primary" href="{{route('soil_type.show',$soil->id)}}">View</a>
                                        </div>
                                        <div class="col col-3">
                                            <form action="{{ route('soil_type.destroy', $soil->id)}}" method="post">
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
