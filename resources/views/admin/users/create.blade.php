@extends('adminlte::page')

@section('title', 'Novo Usuário')
    
@section('content_header')
    <h1>Novo Usuário</h1>
@endsection

@section('content')
<form action="{{route('users.store')}}" method="POST" class="form-horizontal">
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">Nome Completo</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">Confirmação da Senha</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="submit" value="Cadastrar" class="btn btn-success">
            </div>
        </div>
    </div>
</form>    
@endsection
