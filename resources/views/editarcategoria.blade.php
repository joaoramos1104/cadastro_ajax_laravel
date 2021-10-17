@extends('layout.app', ["current" => "categorias"])

@section('body')
    <div class="card shadow rouded">
        <div class="card-body">
            <form action="/categorias/{{$cat->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeCategoria">Nome da Categoria</label>
                    <input id="nomeCategoria" class="form-control" type="text" name="nomeCategoria" placeholder="Categoria" value="{{$cat->nome}}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm shadow">Salvar</button>
                <a href="/categorias" type="button" class="btn btn-danger btn-sm shadow">Cancelar</a>
            </form>
        </div>
    </div>
@endsection