@extends('layouts.app')
@section('title', 'Change Password')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Change Password</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('change-password.process') }}" method="POST" id="main-form">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="old_password" class="col-sm-12 col-lg-2 col-form-label">Old Password:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="old_password" name="old_password" required/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="new_password" class="col-sm-12 col-lg-2 col-form-label">New Password:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="new_password" name="new_password" required/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="new_password_confirmation" class="col-sm-12 col-lg-2 col-form-label">Confirm New Password:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required/>
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