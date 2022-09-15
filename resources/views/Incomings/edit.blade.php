@extends('layouts.homes')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">

@endsection
@section('content-container')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Edit incoming') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('incoming-update') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="value" class="col-md-4 col-form-label text-md-end">{{ __('Value') }}</label>

                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control @error('value') is-invalid @enderror"
                                       name="value" value="{{$in->value}}" autofocus>

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
                                       class="form-control @error('details') is-invalid @enderror" name="details"
                                       value="{{$in->details}}">

                                @error('details')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>

                            </div>
                        </div>

                        <input id="incomingID" type="hidden"
                                name="incomingID"
                               value="{{$in->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
