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
                                        <th scope="col" class="col-2">
                                            Naziv
                                        </th>
                                        <th scope="col" class="col-2">
                                            Predstojnik
                                        </th>
                                        <th scope="col" class="col-2">
                                            Namestnik
                                        </th>
                                        <th scope="col" class="col-2">
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
                                        <td class="form-inline">

                                                {!! Form::open(['url' => 'enota/'.$enota->id.'/edit', 'method' => 'get', 'id' => 'form_ed_'.$enota->id ])  !!}
{{--                                                <span class="oi oi-pencil mr-1" title="Izbriši" aria-hidden="true" onclick="potrdiIzbris('{{$enota->naziv}}','form{{$enota->id}}')" role="button"></span>--}}
                                                {{ Form::button('<i class="oi oi-pencil"></i>', ['class' => 'btn btn-sm btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Uredi', 'type' => 'submit']) }}
                                                {!! Form::close() !!}

                                            @if ($enota->user_count === 0)
                                                {!! Form::open(['url' => 'enota/'.$enota->id, 'method' => 'delete', 'id' => 'form_del_'.$enota->id ])  !!}
{{--                                                <span class="oi oi-trash ml-1" title="Izbriši" aria-hidden="true" onclick="potrdiIzbris('{{$enota->naziv}}','form_del_{{$enota->id}}')" role="button"></span>--}}
                                                {{ Form::button('<i class="oi oi-trash"></i>', ['class' => 'btn btn-sm btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top',  'title' => 'Izbriši', 'onclick' => "potrdiIzbris('$enota->naziv','form_del_$enota->id')"]) }}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <br>
                            <a href="enota/create"><input class="btn btn-primary" type="button" value="Ustvari novo"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('skripte')
    <script>
        var potrdiIzbris = function(enota,id){
            bootbox.confirm({
                size: "small",
                locale: "sl",
                message: "Si prepričan, da želiš izbrisati " + enota + "?",
                callback: function(result) {
                    if (result === true){
                        $("#"+id).submit();
                    }
                }
            });
        }


    </script>
@endsection
