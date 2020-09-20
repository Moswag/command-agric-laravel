@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View Crops</h2>
        <p>Crops</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Distributions Table</h3>
            <div class="text-right">
                <a type="submit" href="{{route('distribution.create')}}"
                   class="btn btn-success" title="Add"><i class="fas fa-user-plus"></i> Add Distribution</a>
            </div>
        <br>
            <div class="example-box-wrapper">
                <table id="datatable-row-highlight" class="table table-striped table-bordered"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>District</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>District</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($distributions as $distribution)
                        <tr>
                            <td>{{\App\Models\District::find($distribution->district)->name}}</td>
                            <td>{{$distribution->date}}</td>
                            <td>
                                <div class="row">
                                    <div class="form-group">

                                        <div class="col col-3">
                                            <a class="btn btn-default" href="{{ route('distribution.edit', $distribution->id)}}">Edit</a>
                                        </div>
                                        <div class="col col-3">
                                            <form action="{{ route('district.destroy', $distribution->id)}}" method="post">
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
