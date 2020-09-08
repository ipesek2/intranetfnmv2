@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-light">Ustvari uporabnika</div>

                    <div class="card-body">
                        {!! Form::open(['url' => 'uporabnik/']) !!}
                        <div class="form-group">
                            {!! Form::label('ime', 'Ime') !!}
                            {!! Form::text('ime', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('priimek', 'Priimek') !!}
                            {!! Form::text('priimek', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'El. naslov') !!}
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Geslo') !!}
                            {!! Form::text('password', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('naziv', ' Akademski naziv') !!}
                            {!! Form::select('naziv', $naziv, null, ['class' => 'form-control', 'placeholder' => 'Določi akademski naziv']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('enota', ' Org. enota / Oddelek / Institut') !!}
                            {!! Form::select('enota', $enote, null, ['class' => 'form-control', 'placeholder' => 'Določi enoto']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('spol','Spol') !!}
                            {!! Form::select('spol', ['1' => 'Moški','2' => 'Ženski',], null, ['class' => 'form-control required', 'placeholder' => 'Izberi...']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('aktiven','Status na FNM UM') !!}
                            {!! Form::select('aktiven', ['1' => 'Zaposlen na FNM','2' => 'Zunanji sodelavec',], null, ['class' => 'form-control required', 'placeholder' => 'Izberi...']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('izvolitev','Veljavnost izvolitve v naziv') !!}<br>
                            {!! Form::radio('izvolitev', '1') !!} brez izvolitve ali trajna izvolitev <br>
                            {!! Form::radio('izvolitev', '2') !!} Izvolitev do {!! Form::text('izvolitev_do', null, ['class' => 'ml-2', 'id '=> 'datum_izvolitev']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('potrjevanje','Potrjevanje dopustov') !!}<br>
                            {!! Form::radio('potrjevanje', '1', true) !!} Predstojnik org. enote (oddelka, inštituta, itd.) <br>
                            {!! Form::radio('potrjevanje', '2') !!} Oseba (mentor, itd.): {!! Form::select('potrjevanje_oseba', $osebe, null, ['id '=> 'potrjevanje_oseba', 'placeholder' => 'Izberi...', 'class' =>'ml-2']) !!}
                        </div>

                        <div class="form-group">
                        {!! Form::submit('Ustvari uporabnika',['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                        </div>


                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('skripte')
    <script>
        $(document).ready(function() {
            $("#datum_izvolitev").datepicker({
                language: 'sl',
                weekStart: 1,
                format: 'd. m. yyyy'
            });

            $("#datum_izvolitev").change( function (){
                $("input[name=izvolitev][value='2']").prop("checked",true);
                $("input[name=izvolitev][value='1']").prop("checked",false);
            });

            $("#potrjevanje_oseba").change( function (){
                $("input[name=potrjevanje][value='2']").prop("checked",true);
                $("input[name=potrjevanje][value='1']").prop("checked",false);
            });

        })


    </script>

@endsection
