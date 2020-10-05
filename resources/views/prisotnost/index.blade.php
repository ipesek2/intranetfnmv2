@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-md-8 ">

            <div class="btn-group col justify-content-center ">

                {!! Form::open(['url' => 'prisotnost/', 'method' => 'get'])  !!}
                {!! Form::hidden('datum',$predhodniMesec->toDateString()) !!}
                {{ Form::button('<i class="oi oi-arrow-circle-left"></i>', ['class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Naslednji mesec', 'type' => 'submit']) }}
                {!! Form::close() !!}

                <h4 class="display-5 mb-4 ml-3 mr-3">{{$today->locale('sl')->monthName}} {{$today->year}}</h4>

                {!! Form::open(['url' => 'prisotnost/', 'method' => 'get'])  !!}
                {!! Form::hidden('datum',$predhodniMesec->addMonth(2)->toDateString()) !!}
                {{ Form::button('<i class="oi oi-arrow-circle-right"></i>', ['class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Naslednji mesec', 'type' => 'submit']) }}
                {!! Form::close() !!}


            </div>
            <div class="row d-none d-sm-flex p-1 bg-primary text-white">

                <h5 class="col-sm p-1 text-center">Ponedeljek</h5>
                <h5 class="col-sm p-1 text-center">Torek</h5>
                <h5 class="col-sm p-1 text-center">Sreda</h5>
                <h5 class="col-sm p-1 text-center">Četrtek</h5>
                <h5 class="col-sm p-1 text-center">Petek</h5>
                <h5 class="col-sm p-1 text-center">Sobota</h5>
                <h5 class="col-sm p-1 text-center">Nedelja</h5>
            </div>

        <div class="row border border-right-0 border-bottom-0">
                @for($i = 1; $i < $firstDay->dayOfWeekIso; $i++ )
                    <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                        <h5 class="row align-items-center">
                            <span class="date col-1"></span>
                            <small class="col d-sm-none text-center text-muted"></small>
                            <span class="col-1"></span>
                        </h5>
                        <p class="d-sm-none">No events</p>
                    </div>
                @endfor

                @for($j = 1; $j <= $today->daysInMonth; $j++ )
                    <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                        <h5 class="row align-items-center">
                            <span class="date col-1">{{$j}}</span>
                            <small class="col d-sm-none text-center text-muted">{{\Carbon\Carbon::createFromDate($today->year,$today->month,$j)->locale('sl')->dayName}}</small>
                            <span class="col-1"></span>
                        </h5>
                        <p class="d-sm-none">No events</p>
                    </div>
                    @if (($firstDay->dayOfWeekIso + $j - 1) % 7 === 0)
                        <div class="w-100"></div>
                    @endif
                @endfor

                    @for($i = $today->endOfMonth()->dayOfWeekIso; $i < 7; $i++ )
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                            <h5 class="row align-items-center">
                                <span class="date col-1"></span>
                                <small class="col d-sm-none text-center text-muted">Sunday</small>
                                <span class="col-1"></span>
                            </h5>
                            <p class="d-sm-none">No events</p>
                        </div>
                    @endfor
                    <div class="w-100"></div>



{{--            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">--}}
{{--                <h5 class="row align-items-center">--}}
{{--                    <span class="date col-1">3</span>--}}
{{--                    <small class="col d-sm-none text-center text-muted">Friday</small>--}}
{{--                    <span class="col-1"></span>--}}
{{--                </h5>--}}
{{--                <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Test Event 1">Test Event 1</a>--}}
{{--            </div>--}}


        </div>
        </div>
        </div>
    </div>
@endsection
