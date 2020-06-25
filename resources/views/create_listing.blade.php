@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Listing</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('add.listing') }}">
                            @csrf
                        <div class="form-group">
                            <label>Listing Name</label>
                            <input type="text" class="form-control" id="list_name" name="list_name" placeholder="" value="{{old('list_name')}}">
                        </div>
                            @error('list_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        <div class="form-group">
                            <label>Distance</label>
                            <input type="text" class="form-control" id="distance" name="distance" placeholder="" value="{{old('distance')}}">
                        </div>
                            @error('distance')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <hr>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
