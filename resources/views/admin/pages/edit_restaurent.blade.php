@extends('admin.layouts.master')
@section('page_title','Restaurent - Add Restaurent')
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Update Restaurent</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('restaurent.update',$data->id) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter name..." value="{{ $data->name }}" required>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">file</label>
                                                <input type="file" class="form-control" name="file">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Min Cost</label>
                                                <input type="number" class="form-control" name="min"
                                                    placeholder="Enter min cost..." min="1" value="{{ $data->min }}" required>
                                                @error('min')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Max Cost</label>
                                                <input type="number" class="form-control" name="max"
                                                    placeholder="Enter max cost..." min="1" value="{{ $data->max }}" required>
                                                @error('max')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Location</label>
                                                <input type="text" class="form-control" name="location"
                                                    placeholder="Enter location..." value="{{ $data->location }}" required>
                                                @error('location')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!--Services-->
                                        <div class="service_field_wrapper">
                                           @forelse($data->services as $item)
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Services</label>
                                                    <input type="text" class="form-control" value="{{ $item->name }}" name="type_services[]"
                                                        placeholder="Enter service..." required>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Services</label>
                                                    <input type="text" class="form-control" name="type_services[]"
                                                        placeholder="Enter service..." required>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary add_service_button">Add More +</button>
                                            </div>
                                        </div>
                                        <!---end Services-->

                                        <!--Foods-->
                                        <div class="foods_field_wrapper">
                                            @forelse($data->foods as $item)
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Foods</label>
                                                    <input type="text" class="form-control" value="{{ $item->name }}" name="type_foods[]"
                                                        placeholder="Enter foods..." required>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Foods</label>
                                                    <input type="text" class="form-control" name="type_foods[]"
                                                        placeholder="Enter foods..." required>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary add_foods_button">Add More +</button>
                                            </div>
                                        </div>
                                        <!---end Foods-->


                                        <!--occasion-->
                                        <div class="occasion_field_wrapper">
                                            @forelse($data->occasion as $item)
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Occasion</label>
                                                    <input type="text" class="form-control" value="{{ $item->name }}" name="type_occasion[]"
                                                        placeholder="Enter occasion..." required>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Occasion</label>
                                                    <input type="text" class="form-control" name="type_occasion[]"
                                                        placeholder="Enter occasion..." required>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary add_occasion_button">Add More +</button>
                                            </div>
                                        </div>
                                        <!---end occasion-->

                                        <!--Meals-->
                                        <div class="meals_field_wrapper">
                                            @forelse($data->meals as $item)
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Meals</label>
                                                    <input type="text" class="form-control" value="{{ $item->name }}" name="type_meals[]"
                                                        placeholder="Enter meals..." required>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-md-6">
                                                <div class="mb-3 error-placeholder">
                                                    <label class="form-label">Add Meals</label>
                                                    <input type="text" class="form-control" name="type_meals[]"
                                                        placeholder="Enter meals..." required>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary add_meals_button">Add More +</button>
                                            </div>
                                        </div>
                                        <!---end Meals-->
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
