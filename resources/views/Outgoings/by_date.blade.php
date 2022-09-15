@extends('layouts.homes')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
@endsection
@section('content-container')

    <div>
        @if( isset($_GET['date'])&& strlen($_GET['date'])==0)
            <div class="alert alert-danger">
               {{__('Ooops. you should choose date ')}}

            </div>
        @endif

        <div class="card">
            <div class="card-header">{{ __('Serach outgoings by date') }}</div>

            <div class="card-body">

                <form method="get" action="{{ route('outgoing-dis-date') }}">


                    <div class="row ">

                        <div class="col-md-6 col-sm-6 col-lg-6 d-flex justify-content-around mb-3">
                            <label for="date" class=" col-form-label text-md-end ">{{ __('Date')}}: </label>

                            <input id="date" type="date"
                                   name="date" value="{{old('Date')}}" required>
                        </div>
                        <div class="col-md-6  col-sm-6 col-lg-6">
                            <button type="submit" class="btn btn-primary ">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
    <div>

        @if(sizeof($outs)>0&& isset($_GET['date'])&& strlen($_GET['date'])>0)
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#.</th>
                    <th>Value</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($outs as $out)
                    <tr>

                        <td>{{$loop->iteration}}</td>
                        <td>{{$out->value}}</td>
                        <td>{{$out->details}}</td>

                @endforeach
                </tbody>

            </table>
            <strong>Total of outgoings for {{$_GET['date']}} is: {{$total}}</strong>

        @elseif(sizeof($outs)==0&&isset($_GET['date'])&& strlen($_GET['date'])>0)

            <div class="alert alert-danger">
                There is not any outgoings for this date
            </div>

        @endif
    </div>
@endsection
