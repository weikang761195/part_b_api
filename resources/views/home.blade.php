@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listing Table
                    <a href="/create/listing" type="button" class="btn btn-sm btn-info" style="float: right">Add Listing</a>
                </div>

                <div class="card-body">
                    @if (session('create_status'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('create_status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('delete_status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('delete_status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <th>ID</th>
                        <th>List Name</th>
                        <th>Distance</th>
                        <th>User</th>
                        <th>Action</th>

                        @if(count($listing) == 0)
                        <tr>
                            <td colspan="5" class="text-danger text-center">No Data Found</td>
                        </tr>
                        @else
                        @foreach($listing as $key => $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->list_name}}</td>
                            <td>{{$data->distance}}</td>
                            <td>{{$data->users['email']}}</td>
                            <td>
                                {!! Form::open(['url' => '/delete/listing/'.$data->id.'', 'method' => 'delete']) !!}
                                @csrf
                                <input type="submit" class="btn btn-sm btn-danger" value="Remove">
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
