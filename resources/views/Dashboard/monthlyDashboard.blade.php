@extends('layouts.homes')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@endsection
@section('content-container')

    @if( isset($_GET['month'])&& strlen($_GET['month'])==0)
        <div class="alert alert-danger">
            {{__('Ooops. you should choose month ')}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">{{ __('Monthly Dashborad') }}</div>

        <div class="card-body">

            <form method="get" action="{{ route('monthly-dashboard') }}">


                <div class="row ">

                    <div class="col-6 d-flex mb-3">


                        <label for="month" class="col-form-label text-md-end " style="margin:0 2em">{{ __('month')}}
                            : </label>

                        <input id="month" type="month"
                               name="month" value="{{old('month')}}"
                               style="width: fit-content">
                    </div>


                    <div class="col-6">
                        <button type="submit" class="btn btn-primary ">
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>


            </form>

        </div>
    </div>

    @if( isset($_GET['month'])&& strlen($_GET['month'])>0)

        <div class="row d-flex">
            <div class="col-4">
                <div class="card text-bg-success mb-3" style=" height: 100%;">
                    <div class="card-header">Incomings</div>
                    <div class="card-body">
                        <h5 class="card-title">Total</h5>
                        <p class="card-text">{{$inTotal}}</p>
                        <h5 class="card-title">Value</h5>
                        <p class="card-text">{{$inValue}}</p>
                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="card text-bg-danger mb-3" style="height: 100%;">
                    <div class="card-header">Outgoings</div>
                    <div class="card-body">
                        <h5 class="card-title">Total</h5>
                        <p class="card-text">{{$outTotal}}</p>
                        <h5 class="card-title">Value</h5>
                        <p class="card-text">{{$outValue}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-bg-secondary mb-3" style="height: 100%;  ">
                    <div class="card-header">Difference</div>
                    <div class="card-body">
                        <h5 class="card-title">Budget</h5>
                        <p class="card-text">{{$inValue - $outValue}}</p>
                        <h5 class="card-title">Status</h5>
                        <p class="card-text">
                            @if($inValue - $outValue>0)
                                Your budget is good
                            @elseif($inValue - $outValue==0)
                                Your budget is balanced
                            @else
                                Your budget is bad
                            @endif

                        </p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row  chart">
            <div>
                <div class="col-12 ">
                    <canvas id="myChart" title="Budget Chart"></canvas>
                </div>
                <div class="col-12" style="font-size: smaller; font-weight: bolder">
                    Monthly budget chart
                </div>
            </div>

        </div>




        <script type="text/javascript">
            var days = [], inValues = [], outValues = [];


            @foreach($days as $day)
                days[{{$loop->iteration}} - 1] = ({{$day}});
            @endforeach


                @foreach($insByMonth as $ibm)
                inValues[{{$loop->iteration}} - 1] = ({{$ibm}});
            @endforeach
                @foreach($outsByMonth as $obm)
                outValues[{{$loop->iteration}} - 1] = ({{$obm}});
            @endforeach


            new Chart("myChart", {
                type: "line",
                title: {
                    text: "Styling Legend Text"
                },
                data: {
                    labels: days,
                    datasets: [{
                        data: inValues,
                        borderColor: "green",
                        fill: false,
                        label: "Incomings"
                    },
                        {
                            data: outValues,
                            borderColor: "red",
                            fill: false,
                            label: "Outgoings"


                        }
                    ]
                },
                options: {

                    legend: {display: true}
                }
            });


        </script>
    @endif

@endsection
