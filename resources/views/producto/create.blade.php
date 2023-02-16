@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Enviar Mensaje') }}</div>
                <div class="container my-5">
                    <form class="form" action="{{route('product.store')}}" method="POST" enctype=multipart/form-data>
                        @csrf
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="name of product">

                        <label class="form-label">Photo</label>

                        <input type="file" class="form-control" name="photo">

                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>

                        <input type="submit" class="btn btn-success my-2" value="Send">

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection