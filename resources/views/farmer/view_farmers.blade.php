@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View Farmers</h2>
        <p>Farmers</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Farmers Table</h3>
            <div class="text-right">
                <a type="submit" href="{{route('farmer.create')}}"
                   class="btn btn-success" title="Add"><i class="fas fa-user-plus"></i> Add Farmer</a>
            </div>
            <br>
            <div class="example-box-wrapper">
                <table id="datatable-row-highlight" class="table table-striped table-bordered"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>PhoneNumber</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>PhoneNumber</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($farmers as $farmer)
                        <tr>
                            <td>{{\App\Models\User::find($farmer->userId)->name}}</td>
                            <td>{{\App\Models\User::find($farmer->userId)->surname}}</td>
                            <td>{{\App\Models\User::find($farmer->userId)->email}}</td>
                            <td>{{$farmer->phoneNumber}}</td>
                            <td>{{$farmer->address}}</td>
                            <td>{{\App\Models\User::find($farmer->userId)->status}}</td>
                            <td>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col col-3">
                                            <form action="{{ route('admin.destroy', $farmer->id)}}" method="post">
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
