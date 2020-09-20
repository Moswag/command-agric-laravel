@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Edit Farm</h2>
        <p>Update Farm</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Farm Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('farm.update',$farm->id)}}">
                    @csrf
                    @METHOD("PUT")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Farm Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="farmNumber" placeholder="Enter name" required
                                               value="{{$farm->farmNumber}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Hectares</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="hectares" placeholder="Hectares" required
                                               value="{{$farm->hectares}}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">District</label>
                                    <div class="col-sm-6">
                                        <select name="districtId"
                                                required class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($districts as $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="bg-default content-box text-center pad20A mrg25T">
                        <button class="btn btn-lg btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
