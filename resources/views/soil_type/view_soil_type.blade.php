@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>View Soil Type</h2>
        <p>Show Soil Type</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Soil Type</h3>
            <div class="example-box-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Name: </label>
                                    <div class="col-sm-6">
                                        <label class="col-sm-9 control-label">{{$soil->name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Description: </label>
                                    <div class="col-sm-6">
                                        <label class="col-sm-9  control-label">{{$soil->description}}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="col-sm-3 control-label">Crops: </label>
                                        <div class="col-sm-6">
                                            @foreach($crops as $crop)
                                                <label>{{\App\Models\Crop::findOrFail($crop->cropId)->name}},</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
            </div>
        </div>
    </div>
@endsection
