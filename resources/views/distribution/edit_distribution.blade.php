@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Add Distribution</h2>
        <p>Create Distribution</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Distribution Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('distribution.update',$distribution->id)}}">
                    @csrf
                    @METHOD("PUT")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">District</label>
                                    <div class="col-sm-6">
                                        <select type="text" name="district" required
                                                class="form-control">
                                            <option value="{{$distribution->district}}">{{\App\Models\District::find($distribution->district)->name}}</option>
                                            @foreach($districts as $district)
                                                @if($district->id!=$distribution->district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Date Of Distribution</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="date" placeholder="Date" required
                                               value="{{$distribution->date}}"
                                               class="form-control">
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
