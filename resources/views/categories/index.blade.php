@extends('layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Categories</h2></div>
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{{ route('categories.create') }}}"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create Category</a>
                </div>
            </div>
            <div class="col-lg-12 mb-20">
                <div class="box">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="input-group mb-3 mb-lg-0 w-100">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" placeholder="Search by" name="search" value="{{ request('search') }}"/>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <select class="form-select mb-3" name="search_column">
                                    <option value="id" {{ request('search_column') == 'id' ? 'selected' : '' }}>ID</option>
                                    <option value="name" {{ request('search_column') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="created_at" {{ request('search_column') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                                    <option value="updated_at" {{ request('search_column') == 'updated_at' ? 'selected' : '' }}>Updated Date</option>
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
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->updated_at }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $item->id }}" data-id="{{ $item->id }}" title="View" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <div class="action-button"><a href="{{ route('categories.edit', $item->id) }}" title="Edit"><i class="fa-solid fa-pencil text-primary"></i></a></div>
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
                                                            <h5 class="modal-title" id="rejectModalLabel">Category View</h5>
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
                                                                    <div class="col fw-bold">Created At:</div>
                                                                    <div class="col">{{ $item->created_at }}</div>
                                                                </div>
                                                                <div class="row mb-2 pb-2">
                                                                    <div class="col fw-bold">Updated At:</div>
                                                                    <div class="col">{{ $item->updated_at }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                                                            Are you sure you want to delete (Category ID: {{ $item->id }})?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('categories.delete', $item->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Submit</button>
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
