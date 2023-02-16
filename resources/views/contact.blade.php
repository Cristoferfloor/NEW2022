@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Enviar Mensaje') }}</div>
                
                <form method="POST" action="{{ route('send') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Destinatario</label>
                            <select name="recipient_id" class="form-select">
                                <option selected>Elegir destinatario...</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mensaje</label>
                            <textarea name="body_message" class="form-control"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection