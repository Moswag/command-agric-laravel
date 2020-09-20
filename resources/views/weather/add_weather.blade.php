@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Add Weather Notification</h2>
        <p>Create Weather Notification</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Weather Notification Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('weather.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Notification</label>
                                    <div class="col-sm-6">
                                    <textarea name="notification" placeholder="Description"
                                              required
                                              class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">District</label>
                                    <div class="col-sm-6">
                                        <select name="district"
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
                        <button class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
