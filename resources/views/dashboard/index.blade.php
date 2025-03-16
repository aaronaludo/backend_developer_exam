@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Dashboard</h2></div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Products</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-heart"></i>
                                <h2 class="float-end">{{ $total_products }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('products') }}">Click to View Products...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Categories</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-table-list"></i>
                                <h2 class="float-end">{{ $total_categories }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('categories') }}">Click to View Categories...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Admins</div>
                            <div class="tile-body">
                                <i class="fa-solid fa-user"></i>
                                <h2 class="float-end">{{ $total_admins }}</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('products') }}">Click to View Products...</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between">
                                <h5>Latest Products</h5>
                                <a href="{{ route('products') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latest_products as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category ? $item->category->name : 'No Category' }}</td>
                                                <td>{!! $item->description !!}
                                                <td>{{ $item->date_and_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
