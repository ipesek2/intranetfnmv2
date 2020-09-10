@extends('layouts.app')

@section('content')
    <div class="container">
                <div class="card">
                    @if (!empty($sporocilo))
                        <div class="bg-success card-header">
                            {{$sporocilo}}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4>Seznam uporabnikov
                        <a href="uporabnik/create"><input class="btn btn-primary float-right" type="button" value="Ustvari uporabnika"></a>
                        </h4>
                    </div>

                    <div class="card-body small seznam">
                        <div class="row bg-light border border-gray">
                            <div class="col-6 col-md ">
                                Ime in priimek
                            </div>
                            <div class="col-6 col-md">
                                E. naslov
                            </div>
                            <div class="col-6 col-md">
                                Org. enota
                            </div>
                            <div class="col-6 col-md">
                                Akademski naziv
                            </div>
                            <div class="col-6 col-md">
                                Izvolitev do
                            </div>
                            <div class="col-6 col-md">
                                Potrjevanje
                            </div>
                            <div class="col-6 col-md">
                                Operacije
                            </div>
                        </div>
                        @foreach($users as $user)
                                <div class="row border border-gray mt-1">
                                    <div class="col-6 col-md inline-block">
                                        {{$user->profil->ime}}  {{$user->profil->priimek}}
                                    </div>
                                    <div class="col-6 col-md">
                                        {{$user->email }}
                                    </div>
                                    <div class="col-6 col-md">
                                        {{$user->enota->naziv}}
                                    </div>
                                    <div class="col-6 col-md">
                                        {{$user->dobiNaziv()}}
                                    </div>
                                    <div class="col-6 col-md">
                                        {{$user->profil->izvolitev_do}}
                                    </div>
                                    <div class="col-6 col-md">
                                        {{$user->dobiPotrjevanje()}}
                                    </div>
                                    <div class="col-6 col-md form-inline">
                                        {!! Form::open(['url' => 'uporabnik/'.$user->id.'/edit', 'method' => 'get', 'id' => 'form_ed_'.$user->id ])  !!}
                                        {{ Form::button('<i class="oi oi-pencil"></i>', ['class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Uredi', 'type' => 'submit']) }}
                                        {!! Form::close() !!}

                                        {!! Form::open(['url' => 'uporabnik/'.$user->id, 'method' => 'delete', 'id' => 'form_del_'.$user->id ])  !!}
                                        @if ($user->jeAktiven())
                                            {{ Form::button('<i class="oi oi-circle-check"></i>', ['class' => 'btn btn-sm btn-success', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Deaktiviraj', 'type' => 'submit']) }}
                                        @else
                                            {{ Form::button('<i class="oi oi-circle-x"></i>', ['class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Aktiviraj', 'type' => 'submit']) }}
                                        @endif
                                        {!! Form::close() !!}


                                    </div>
                                </div>
                        @endforeach


                    </div>
                </div>
    </div>
@endsection
