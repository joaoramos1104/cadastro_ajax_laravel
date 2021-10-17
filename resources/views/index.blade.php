@extends('layout.app', ["current" => "home"])

@section('body')
    <div class="container p-3 bg-light shadow">
        <div class="row">
            <div class="card-group">
                <div class="card shadow m-2">
                    <div class="card-header">
                        Cadastro Produtos
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de produtos</h5>
                        <p class="card-text">
                            Aqui você cadastra todos os seus produtos.
                            Só não esqueça de cadastrar previamente as categorias.
                        </p>
                        <a href="/produtos" class="btn btn-primary rounded shadow"> Cadastre seus produtos</a>
                    </div>
                </div>
                <div class="card shadow m-2">
                    <div class="card-header">
                        Cadastro Categorias
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Categorias</h5>
                        <p class="card-text">
                           Cadastre as categorias dos seus produtos
                        </p>
                        <a href="/produtos" class="btn btn-primary rounded shadow"> Cadastre suas categorias</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
