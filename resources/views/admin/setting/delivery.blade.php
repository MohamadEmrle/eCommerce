@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.delivery.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('type Number') }}</label>

                            <div class="col-md-6">
                                <input value="{{ $type }}" type="text" readonly class="form-control @error('type_number') is-invalid @enderror" name="type_number" value="{{ old('type_number') }}" autocomplete="type_number" autofocus>

                                @error('type_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Delivery') }}</label>

                            <div class="col-md-6">
                                @if($type == 1)
                                    <input type="text" readonly value="Free Delivery" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required autocomplete="email">
                                @elseif($type == 2)
                                    <input type="text" readonly value="Internal Delivery" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required autocomplete="email">
                                @elseif($type == 3)
                                    <input type="text" readonly value="Outside Delivery" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required autocomplete="email">
                                @endif

                                @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Value') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('value') is-invalid @enderror" name="value" required autocomplete="off">

                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value='Save'>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
