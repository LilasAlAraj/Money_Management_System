@extends('layouts.homes')
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
@endsection
@section('content-container')

    @if( isset($_GET['year'])&& strlen($_GET['year'])==0)
        <div class="alert alert-danger">
            {{__('Ooops. you should choose month ')}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">{{ __('Manually Dashborad') }}</div>

        <div class="card-body">

            <form method="get" action="{{ route('manually-dashboard') }}">


                <div class="row ">

                    <div class="col-6 d-flex  mb-3">


                        <label for="year" class=" col-form-label text-md-end " style="margin:0 2em">{{ __('year')}}: </label>

                        <input type="number" min="1900" max="2099"
                               name="year" value="{{$year}}"
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

    @if( isset($_GET['year'])&& strlen($_GET['year'])>0)

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
            <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="col-12 ">
                    <canvas id="outsChart" title="Outgoings Chart"></canvas>
                </div>
                <div class="col-12" style="font-size: smaller; font-weight: bolder">
                    Monthly outgoings chart
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="col-12 ">
                    <canvas id="insChart" title="Incomings Chart"></canvas>
                </div>
                <div class="col-12" style="font-size: smaller; font-weight: bolder">
                    Monthly incomings chart
                </div>
            </div>

        </div>
    @endif


    <script type="text/javascript">
        var inValues = [], outValues = [];
        var months = ['January', 'February', 'March', 'April'
            , 'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December'];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145",
            "#b9ac1d",
            "#ab0075",
            "#7a0404",
            "#550c57",
            "#8d650f",
            "#081031",
            "#1fee80"
        ];

        var year = {{$year}};
        console.log(year);

        @foreach($insByMonth as $ibm)
            inValues[{{$loop->iteration}} - 1] = ({{$ibm}});
        @endforeach
            @foreach($outsByMonth as $obm)
            outValues[{{$loop->iteration}} - 1] = ({{$obm}});

        @endforeach


        new Chart("insChart", {
            type: "doughnut",
            data: {
                labels: months,
                datasets: [{
                    backgroundColor: barColors,
                    data: inValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "incomings of months while " + year
                }
            }
        });


        new Chart("outsChart", {
            type: "doughnut",
            data: {
                labels: months,
                datasets: [{
                    backgroundColor: barColors,
                    data: outValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: " outgoings of months while " + year
                }
            }
        });


    </script>

@endsection
