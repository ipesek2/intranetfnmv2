@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Organizacijske enote na FNM</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-4">
                                            Naziv
                                        </th>
                                        <th scope="col" class="col-4">
                                            Predstojnik
                                        </th>
                                        <th scope="col" class="col-3">
                                            Namestnik
                                        </th>
                                        <th scope="col" class="col-3">
                                            Operacije
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($enote as $enota)
                                    <tr>
                                        <td>{{$enota->naziv}}</td>
                                        <td>{{$enota->dobiPredstojnikIme()}}</td>
                                        <td>{{$enota->dobiNamestnikIme()}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
