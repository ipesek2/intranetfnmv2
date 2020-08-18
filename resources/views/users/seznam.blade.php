@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Seznam uporabnikov</div>

                    <div class="card-body">
                        @foreach($users as $user)
                            {{$user->email }} : {{$user->profil->priimek}} : {{$user->dobiNaziv()}}<br>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
