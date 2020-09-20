@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Add Crop</h2>
        <p>Create Crop</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Edit Crop Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('crop.update',$crop->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" placeholder="Enter name" required
                                               value="{{$crop->name}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Yield</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="yield" placeholder="Yield Per square meter (KGS)" required
                                               value="{{$crop->yield}}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea name="description"  placeholder="Description"
                                                  required class="form-control">{{$crop->description}}</textarea>
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
