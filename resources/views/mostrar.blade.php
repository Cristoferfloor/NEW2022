@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mensaje') }}</div>
                <div class="card-body">
                    <div class="form-floating">
                        <input type="text" class="form-control-plaintext" value="{{$data[1]->name}}" disabled>
                        <label>Usuario:</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control-plaintext" value="{{$data[1]->email}}" disabled>
                        <label>Email:</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control-plaintext" value="{{$data[0]->body}}" disabled>
                        <label>Mensaje:</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control-plaintext" value="{{$data[0]->created_at->diffForHumans()}}" disabled>
                        <label>Fecha:</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection