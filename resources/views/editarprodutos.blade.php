@extends('layout.app', ["current" => "produtos"])

@section('body')
    <div class="card shadow rouded">
        <div class="card-body">
        
            <form action="/produtos/{{$prod->id}}" method="POST">
                @csrf
                <div class="form-group">
                
                    <label for="nomeProduto">Descrição do Produto</label>
                    <input id="nomeProduto" value="{{$prod->nome}}" class="form-control rounded-pill" type="text" name="nomeProduto" placeholder="Descrição" required>

                    <label for="precoProduto">Preço</label>
                    <input id="precoProduto" value="{{$prod->preco}}" class="form-control rounded-pill" type="text" name="precoProduto" placeholder="Preço" required>
                    
                    <label for="estoqueProduto">Estoque</label>
                    <input id="estoqueProduto" value="{{$prod->estoque}}" class="form-control rounded-pill" type="number" name="estoqueProduto" placeholder="Estoque" required>
                    
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" class="form-control rounded-pill" name="categoriaProduto">
                            <option value="{{$prod->categoria_id}}">{{$prod->categoria_id}}</option>
                            @foreach($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                  
                </div>
                <button type="submit" class="btn btn-primary btn-sm shadow">Salvar</button>
                <a href="/produtos" type="button" class="btn btn-danger btn-sm shadow">Cancelar</a>
            </form>
          
        </div>
    </div>
@endsection