@extends('layouts.app')
@section('title', 'Products')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Products</h2></div>
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{{ route('products.create') }}}"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create Product</a>
                </div>
            </div>
            <div class="col-lg-12 mb-20">
                <div class="box">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="input-group mb-3 mb-lg-0 w-100">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" placeholder="Search by name and description" name="search" value="{{ request('search') }}"/>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <select class="form-select mb-3" name="search_category">
                                    <option value="">No Category</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{ request('search_category') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>                                    
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <div class="col-lg-12 mb-20">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Date and Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category ? $item->category->name : 'No Category' }}</td>
                                                <td>{{ $item->date_and_time }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $item->id }}" data-id="{{ $item->id }}" title="View" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <div class="action-button"><a href="{{ route('products.edit', $item->id) }}" title="Edit"><i class="fa-solid fa-pencil text-primary"></i></a></div>
                                                        <div class="action-button">
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}" data-id="{{ $item->id }}" title="Delete" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                                <i class="fa-solid fa-trash text-danger"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal modal-lg fade" id="viewModal-{{ $item->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Product View</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container border p-3 rounded">
                                                                <div class="row mb-2 border-bottom pb-2">
                                                                    <div class="col fw-bold">ID:</div>
                                                                    <div class="col">{{ $item->id }}</div>
                                                                </div>
                                                                <div class="row mb-2 border-bottom pb-2">
                                                                    <div class="col fw-bold">Name:</div>
                                                                    <div class="col">{{ $item->name }}</div>
                                                                </div>
                                                                <div class="row mb-2 border-bottom pb-2">
                                                                    <div class="col fw-bold">Category:</div>
                                                                    <div class="col">{{ $item->category ? $item->category->name : 'No Category' }}</div>
                                                                </div>
                                                                <div class="row mb-2 border-bottom pb-2">
                                                                    <div class="col-12 fw-bold">Description:</div>
                                                                    <div class="col"><br/>{!! $item->description !!}</div>
                                                                </div>
                                                                <div class="row mb-2 border-bottom pb-2">
                                                                    <div class="col-12 fw-bold">Product Images:</div>
                                                                    <div class="col"><br/>
                                                                    @if(!empty($item->product_images) && count($item->product_images) > 0)
                                                                        <div class="mb-3 row">
                                                                            <div class="col-lg-10 col-sm-12">
                                                                                <div class="d-flex flex-wrap gap-1">
                                                                                    @foreach($item->product_images as $image)
                                                                                        <div class="d-flex flex-column">
                                                                                            <div style="position: relative; display: inline-block;">
                                                                                                <img src="{{ asset($image->filename) }}" alt="Product Image" class="img-thumbnail" style="width: 100px;height: 100px;object-fit: contain;">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2 pb-2">
                                                                    <div class="col fw-bold">Date and Time:</div>
                                                                    <div class="col">{{ $item->date_and_time }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Delete Confirmation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete (Product ID: {{ $item->id }})?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('products.delete', $item->id) }}" method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="d-flex justify-content-center">
                                                                    <button class="btn btn-danger w-100 submit-button-delete" type="submit">
                                                                        <span class="spinner-border spinner-border-sm me-2 d-none loader-delete" role="status" aria-hidden="true"></span>
                                                                        Yes, Delete
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $data->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
