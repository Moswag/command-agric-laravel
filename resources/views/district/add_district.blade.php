@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Add District</h2>
        <p>Create District</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">District Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('district.store')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" placeholder="Enter name" required
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Chief</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="chief" placeholder="Chief" required
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Soil Type</label>
                                    <div class="col-sm-6">
                                        <select name="soilTypeId"
                                                required class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($soils as $soil)
                                                <option value="{{$soil->id}}">{{$soil->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="bg-default content-box text-center pad20A mrg25T">
                        <button class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
