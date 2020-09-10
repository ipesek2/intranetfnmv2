@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-light">Uredi org. enoto</div>

                    <div class="card-body">
                        {!! Form::model($enota, ['url' => 'enota/'.$enota->id, 'method' => 'put']) !!}

                        <div class="form-group">
                            {!! Form::label('naziv', 'Naziv org. enote') !!}
                            {!! Form::text('naziv', $enota->naziv, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vodja', 'Vodja / predstojnik_ca') !!}
                            {!! Form::select('vodja', $users, $enota->vodja, ['class' => 'form-control', 'placeholder' => 'Določi vodjo']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('namestnik', 'Namestnik_ca') !!}
                            {!! Form::select('namestnik', $users, $enota->namestnik, ['class' => 'form-control', 'placeholder' => 'Določi namestnika_co']) !!}
                        </div>

                        {!! Form::submit('Shrani',['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}

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
