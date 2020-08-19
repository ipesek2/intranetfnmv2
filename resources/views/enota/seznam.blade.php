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
                                        <td>
                                            <span class="oi oi-pencil" title="Uredi" aria-hidden="true" role="button"></span>
                                            <span class="oi oi-trash" title="Izbriši" aria-hidden="true" onclick="potrdiIzbris('{{$enota->naziv}}')" role="button"></span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <br>
                            <a href="enote/create"><input class="btn btn-primary" type="button" value="Ustvari novo"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('skripte')
    <script>
        var potrdiIzbris = function(enota){
            bootbox.confirm({
                size: "small",
                locale: "sl",
                message: "Si prepričan, da želiš izbrisati " + enota + "?",
                callback: function(result) {
                    if (result === true){
                        console.log("true");
                    }
                }
            });
        }


    </script>
@endsection
