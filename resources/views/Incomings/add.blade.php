@extends('layouts.homes')
@section('style')
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">

@endsection
@section('content-container')


    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('fall'))
                <div class="alert alert-danger">
                    {{ session()->get('fall') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Add new incoming') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('incoming-store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="value" class="col-md-4 col-form-label text-md-end">{{ __('Value') }}</label>

                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control @error('value') is-invalid @enderror"
                                       name="value" autofocus>

                                @error('value')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="details" class="col-md-4 col-form-label text-md-end">{{ __('Details') }}</label>

                            <div class="col-md-6">
                                <input id="details" type="text"
                                       class="form-control @error('details') is-invalid @enderror" name="details">

                                @error('details')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
