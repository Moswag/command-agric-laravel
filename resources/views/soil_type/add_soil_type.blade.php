@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Add Soil Type</h2>
        <p>Create Soil Type</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Soil Type Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('soil_type.store')}}">
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
                                    <label class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                    <textarea name="description" placeholder="Description"
                                              required
                                              class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Assign Crops</label>
                                    <div class="col-sm-6">
                                        @foreach($crops as $crop)
                                            <label><input type="checkbox" name="crops[]" value="{{$crop->id}}">
                                                {{$crop->name}}</label>
                                        @endforeach
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
