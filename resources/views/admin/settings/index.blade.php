@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <h1>Configurações do Site</h1>
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <h5><i class="icon fas fa-ban"></i>Preencha os campos solicitados!</h5>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('warning'))
<div class="alert alert-success">
    {{session('warning')}}
</div>
@endif
    <div class="card">
        <div class="card-body">
            <form action="{{route('settings.save')}}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título do Site</label>
                    <div class="col-sm-10">
                    <input type="text" name="title" value="{{$settings['title']}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub-Titulo do Site</label>
                    <div class="col-sm-10">
                    <input type="text" name="subtitle" value="{{$settings['subtitle']}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email para Contato</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" value="{{$settings['email']}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do fundo</label>
                    <div class="col-sm-10">
                    <input type="color" name="backcolor" value="{{$settings['backcolor']}}" class="form-control" style="width:70px">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do texto</label>
                    <div class="col-sm-10">
                        <input type="color" name="textcolor" value="{{$settings['textcolor']}}" class="form-control" style="width:70px">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
