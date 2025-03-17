@extends('layouts.app')
@section('title')
    @if (Request::route()->getName() === 'products.create')
        Create Product
    @elseif(Request::route()->getName() === 'products.edit')
        Edit Product
    @endif
@endsection

@section('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <style>
        #description-editor .ql-editor {
            min-height: 200px;
            max-height: 600px;
            resize: vertical;
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <h2 class="title">
                        @if (Request::route()->getName() === 'products.create')
                            Create Product
                        @elseif(Request::route()->getName() === 'products.edit')
                            Edit Product
                        @endif
                    </h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ isset($data) ? route('products.edit.process', $data->id) : route('products.create.process') }}"  method="POST" enctype="multipart/form-data" id="main-form">
                                @csrf
                                <div id="step1" class="form-step">
                                    <div class="mb-3 row">
                                        <label class="col-sm-12 col-lg-2 col-form-label">Name:</label>
                                        <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $data->name ?? '') }}" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-12 col-lg-2 col-form-label">Categories: </label>
                                        <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                            <select class="form-control" name="category_id" required>
                                                <option value="0">No Category</option>
                                                @foreach($categories as $item)
                                                    <option value="{{ $item->id }}" {{ isset($data->category_id) && $data->category_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-12 col-lg-2 col-form-label">Description:</label>
                                        <div class="col-lg-10 col-sm-12">
                                            <div id="description-editor">{!! old('description', $data->description ?? '') !!}</div>
                                            <input type="hidden" name="description" id="description" value="{{ old('description', $data->description ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5 pt-5 w-100">
                                        <button class="btn btn-primary next-step w-100" type="button">
                                            Next
                                        </button>
                                    </div>
                                </div>
                                <div id="step2" class="form-step d-none">
                                    <div class="mb-3 row">
                                        <label class="col-sm-12 col-lg-2 col-form-label">Product Images:</label>
                                        <div class="col-lg-10 col-sm-12">
                                            <input type="file" class="form-control" name="images[]" multiple accept="image/*" />
                                            <small class="text-muted">You can upload multiple images.</small>
                                        </div>
                                    </div>
                                    @if(!empty($data->product_images) && count($data->product_images) > 0)
                                        <div class="mb-3 row">
                                            <label class="col-sm-12 col-lg-2 col-form-label">Uploaded Images:</label>
                                            <div class="col-lg-10 col-sm-12">
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($data->product_images as $image)
                                                        <div class="d-flex flex-column">
                                                            <div style="position: relative; display: inline-block;">
                                                                <img src="{{ asset($image->filename) }}" alt="Product Image" class="img-thumbnail" style="width: 200px;height: 200px;object-fit: contain;">
                                                            </div>
                                                            <div>
                                                                <button type="button" class="btn btn-danger my-2 w-100" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $image->id }}">
                                                                    Delete
                                                                </button>
                                                                <div class="modal fade" id="deleteModal{{ $image->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $image->id }}" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="deleteModalLabel{{ $image->id }}">Delete this image?</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <img src="{{ asset($image->filename) }}" alt="image" class="img-fluid">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="button" class="btn btn-danger delete-image-btn" data-id="{{ $image->id }}">Yes, Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-center mt-5 w-100">
                                        <button class="btn btn-secondary prev-step w-100" type="button">
                                            Back
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2 w-100">
                                        <button class="btn btn-primary next-step w-100" type="button">
                                            Next
                                        </button>
                                    </div>
                                </div>
                                <div id="step3" class="form-step d-none">
                                    <div class="mb-3 row">
                                        <label class="col-sm-12 col-lg-2 col-form-label">Date and Time:</label>
                                        <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                            <input type="datetime-local" class="form-control" name="date_and_time" 
                                                value="{{ old('date_and_time', $data->date_and_time ?? '') }}" required />
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5 w-100">
                                        <button class="btn btn-secondary prev-step w-100" type="button">
                                            Back
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2 w-100">
                                        <button class="btn btn-primary w-100" type="submit" id="submitButton">
                                            <span id="loader" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentStep = 1;
        const steps = document.querySelectorAll(".form-step");
        const nextButtons = document.querySelectorAll(".next-step");
        const prevButtons = document.querySelectorAll(".prev-step");
        const form = document.getElementById("main-form");

        var quill = new Quill("#description-editor", { theme: "snow" });

        function showStep(step) {
            steps.forEach((el, index) => {
                el.classList.toggle("d-none", index + 1 !== step);
            });
        }

        nextButtons.forEach(btn => {
            btn.addEventListener("click", function () {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
        });

        prevButtons.forEach(btn => {
            btn.addEventListener("click", function () {
                currentStep--;
                showStep(currentStep);
            });
        });

        function validateStep(step) {
            if (step === 1) {
                const name = document.querySelector("[name='name']").value.trim();
                const category = document.querySelector("[name='category_id']").value;
                if (!name || category === "0") {
                    alert("Please fill in all required fields in Step 1.");
                    return false;
                }
                document.querySelector("[name='description']").value = quill.root.innerHTML;
            } else if (step === 2) {
                const images = document.querySelector("[name='images[]']").files.length;
                const existingImages = {{ !empty($data->product_images) && count($data->product_images) > 0 ? 'true' : 'false' }};

                if (images === 0 && !existingImages) {
                    alert("Please upload at least one image.");
                    return false;
                }
            }
            return true;
        }

        form.addEventListener("submit", function () {
            document.querySelector("[name='description']").value = quill.root.innerHTML;
        });

        document.querySelectorAll(".delete-image-btn").forEach(button => {
            button.addEventListener("click", function () {
                const imageId = this.getAttribute("data-id");
                const deleteUrl = `{{ route('products.delete_product_image', ':id') }}`.replace(":id", imageId);

                fetch(deleteUrl, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    }
                })
                .then(() => {
                    document.getElementById(`image-${imageId}`)?.remove();
                    location.reload();
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });
        });
    });
</script>
@endsection
