@extends('layouts.app')
@section('title')
    @if (Request::route()->getName() === 'categories.create')
        Create Category
    @elseif(Request::route()->getName() === 'categories.edit')
        Edit Category
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <h2 class="title">
                        @if (Request::route()->getName() === 'categories.create')
                            Create Category
                        @elseif(Request::route()->getName() === 'categories.edit')
                            Edit Category
                        @endif
                    </h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ isset($data) ? route('categories.edit.process', $data->id) : route('categories.create.process') }}"  method="POST" enctype="multipart/form-data" id="main-form">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-lg-2 col-form-label">Name:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $data->name ?? '') }}" required />
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
