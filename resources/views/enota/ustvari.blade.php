@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-light">Ustvari novo org. enoto</div>

                    <div class="card-body">
                        {!! Form::open(['url' => 'enote/']) !!}
                        <div class="form-group">
                            {!! Form::label('naziv', 'Naziv org. enote') !!}
                            {!! Form::text('naziv', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vodja', 'Vodja / predstojnik_ca') !!}
                            {!! Form::select('vodja', $users, null, ['class' => 'form-control', 'placeholder' => 'Določi vodjo']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('namestnik', 'Namestnik_ca') !!}
                            {!! Form::select('namestnik', $users, null, ['class' => 'form-control', 'placeholder' => 'Določi namestnika_co']) !!}
                        </div>

                        {!! Form::submit('Ustvari',['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
