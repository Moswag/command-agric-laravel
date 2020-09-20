@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Edit GMB Price</h2>
        <p>Update GMB Price</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">GMB Price Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('gmb.update',$gmb->id)}}">
                    @csrf
                    @METHOD('PUT')

                    <input type="hidden" name="cropId" required
                           value="{{$crop->id}}"
                           />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Crop</label>
                                    <div class="col-sm-6">
                                            <input type="text" placeholder="Enter price" required
                                                   value="{{$crop->name}}"
                                                   class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Price Per KG</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="price" placeholder="Enter price" required
                                               value="{{$gmb->price}}"
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
