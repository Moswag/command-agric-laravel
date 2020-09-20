@extends('layouts.master')
@section('content')
    <div id="page-title"><h2>Add Admin</h2>
        <p>Create System Admin.</p>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-body"><h3 class="title-hero">Admin Form</h3>
            <div class="example-box-wrapper">
                <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="" method="POST"
                      action="{{route('admin.store')}}">
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
                                    <label class="col-sm-3 control-label">Surname</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="surname" placeholder="Surname" required
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" data-parsley-type="email"
                                               placeholder="Email address" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">PhoneNumber</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="phoneNumber" data-parsley-type="digits"
                                               placeholder="Phone Number" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea name="address"  placeholder="Address"
                                                  required class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" id="ps1" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 control-label">Repeat Password</label>
                                    <div class="col-sm-6"><input type="password" name="confirmPassword"
                                                                 data-parsley-equalto="#ps1" required
                                                                 class="form-control">
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
