@extends('layouts.homes')
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
@endsection
@section('content-container')

    <div class="row">
        <div class="col-4">
            <div class="card text-bg-success mb-3" style="max-width: 18rem; height: 100%;">
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
            <div class="card text-bg-danger mb-3" style="max-width: 18rem; height: 100%;">
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
            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;height: 100%;">
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
        <div >
            <div class="col-12 ">
                <canvas id="myChart" title="Budget Chart"></canvas>
            </div>
            <div class="col-12" style="font-size: smaller; font-weight: bolder">
                yearly budget chart
            </div>
        </div>

    </div>



    <script>
        var xValues = [], inValues = [], outValues = [];

        @foreach($years as $year)
            xValues[{{$loop->iteration}}] = ({{$year}});
        @endforeach


            @foreach($insByYear as $iby)
            inValues[{{$loop->iteration}}] = ({{$iby}});
        @endforeach
            @foreach($outsByYear as $oby)
            outValues[{{$loop->iteration}}] = ({{$oby}});
        @endforeach

        new Chart("myChart", {
            type: "line",
            title: {
                text: "Styling Legend Text"
            },
            data: {
                labels: xValues,
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

@endsection
