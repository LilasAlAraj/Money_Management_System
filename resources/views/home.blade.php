@extends('layouts.homes')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content-container')

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
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="incomings-tab" data-bs-toggle="tab" data-bs-target="#incomings-tab-pane"
                    type="button" role="tab" aria-controls="incomings-tab-pane" aria-selected="true">Incomings
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="outgoings-tab" data-bs-toggle="tab" data-bs-target="#outgoings-tab-pane"
                    type="button" role="tab" aria-controls="outgoings-tab-pane" aria-selected="false">Outgoings
            </button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade  show active" id="incomings-tab-pane" role="tabpanel" aria-labelledby="incomings-tab"
             tabindex="0">
            <div style="margin-top: 2em">
                @if(sizeof($ins)>0)
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#.</th>
                            <th>Value</th>
                            <th>Details</th>
                            <th>Ceated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ins as $in)
                            <tr>

                                <td>{{$loop->iteration}}</td>
                                <td>{{$in->value}}</td>
                                <td>{{$in->details}}</td>
                                <td>{{$in->date()}}</td>
                                <td>
                                    <div class="actions">

                                        <form method="POSt" action="{{Route('incoming-edit')}} ">
                                            @csrf
                                            {{--                                    {{method_field('delete')}}--}}
                                            <input type="hidden" name="ID" value='{{$in->id}}'>
                                            <button class="btn btn-primary btn-sm action">Edit
                                            </button>
                                        </form>
                                        <form method="POSt" action="{{Route('incoming-delete')}} ">
                                            @csrf
                                            {{method_field('delete')}}
                                            <input type="hidden" name="ID" value='{{$in->id}}'>
                                            <button class="btn btn-danger btn-sm action"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)">Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                @else
                    <p> There is not any incomings yet
                    </p>
                @endif</div>
        </div>
        <div class="tab-pane fade" id="outgoings-tab-pane" role="tabpanel" aria-labelledby="outgoings-tab"
             tabindex="0">
            <div style="margin-top: 2em">
                @if(sizeof($outs)>0)

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#.</th>
                    <th>Value</th>
                    <th>Details</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($outs as $out)
                    <tr>

                        <td>{{$loop->iteration}}</td>
                        <td>{{$out->value}}</td>
                        <td>{{$out->details}}</td>
                        <td>{{$out->date()}}</td>

                        <td>
                            <div class="actions">

                                <form method="POSt" action="{{Route('outgoing-edit')}} ">
                                    @csrf
                                    <input type="hidden" name="ID" value='{{$out->id}}'>
                                    <button class="btn btn-primary btn-sm action">Edit
                                    </button>
                                </form>
                                <form method="POSt" action="{{Route('outgoing-delete')}} ">
                                    @csrf
                                    {{method_field('delete')}}
                                    <input type="hidden" name="ID" value='{{$out->id}}'>
                                    <button class="btn btn-danger btn-sm action"
                                            onclick="return confirm(&quot;Confirm delete?&quot;)">Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>@else
                    <p> There is not any outgoings yet
                    </p>
                @endif</div>
        </div>
    </div>
@endsection
