@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Edit Profile</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('edit-profile.process') }}" method="post" id="main-form">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-12 col-lg-2 col-form-label">Name:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->guard('web')->user()->name }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-12 col-lg-2 col-form-label">Email:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->guard('web')->user()->email }}"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4 w-100">
                                    <button class="btn btn-primary w-100" type="submit" id="submitButton">
                                        <span id="loader" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection