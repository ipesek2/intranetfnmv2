@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-light">Organizacijske enote na FNM</div>

                    <div class="card-body">
                        <p class="font-weight-bolder">{{$besedilo}}</p>

                        <br>
                        <a href="enota"><input class="btn btn-primary" type="button" value="Nazaj na seznam"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
