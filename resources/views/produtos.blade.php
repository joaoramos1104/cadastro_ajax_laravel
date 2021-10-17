@extends('layout.app', ["current" => "produtos"])

@section('body')
    <div class="card shadow rouded">
        <div class="card-header bg-light">
            <h5 class="card-title">Cadastro de Produtos</h5>
        </div>
        <div class="card-body">

            <table class="table table-ordered table-hover bg-light" id="tabelaProdutos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição Produto</th>
                        <th>Estoque</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

        </div>
        <div class="card-footer bg-light">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end m-2">
                <button class="btn btn-success btn-sm shadow" role="button" onclick="novoProduto()">Novo Produto</button>
            </div>
        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="dlgProduto" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" class="form-horizontal" id="formProduto">
            <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Cadastro de Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input id="id" type="hidden" class="form-control">

                <div class="form-group">
                    <label for="nomeProduto" class="control-label">Descrição do Produto</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nomeProduto" placeholder="Descrição do Produto">
                    </div>
                </div>
                <div class="form-group">
                    <label for="precoProduto" class="control-label">Preço</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="precoProduto" placeholder="Preço do Produto">
                    </div>
                </div>

                <div class="form-group">
                    <label for="estoqueProduto" class="control-label">Estoque</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="estoqueProduto" placeholder="Estoque">
                    </div>
                </div>

                <div class="form-group">
                    <label for="categoriaProduto" class="control-label">Categoria</label>
                    <div class="input-group">
                        <select class="form-select" id="categoriaProduto">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="justify-content-md-end">
                    <button type="submit" class="btn btn-success btn-sm shadow">Salvar</button>
                    <button type="button" class="btn btn-warning btn-sm shadow" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>


@endsection

@section('javascript')
    <script type="text/javascript">
    // csrf-toke laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
//------------------------------------------------------------
    //input modal
        function novoProduto(){
            $('#id').val('');
            $('#nomeProduto').val('');
            $('#precoProduto').val('');
            $('#estoqueProduto').val('');
            $('#dlgProduto').modal('show')
        }

        function carregarCategorias(){
            $.getJSON('/api/categorias', function(data){
                for (i=0;i<data.length;i++) {
                    opcao = '<option value ="' + data[i].id + ' ">' + data[i].nome + '</option>';
                $('#categoriaProduto').append(opcao);

                }
            });
        }
//------------------------------------------------------------
        //Carregar produtos na tabela
        function montarLinha(p) {
            var linha = "<tr>" +
                        "<td>" + p.id + "</td>" +
                        "<td>" + p.nome + "</td>" +
                        "<td>" + p.estoque + "</td>" +
                        "<td>" + p.preco + "</td>" +
                        "<td>" + p.categoria_id + "</td>" +
                        "<td>"+
                        '<button class="btn btn-sm btn-info shadow m-1 rounded-pill" onclick="editar('+ p.id +')">Editar</button>' +
                        '<button class="btn btn-sm btn-danger shadow m-1 rounded-pill" onclick="remover(' + p.id +')">Apagar</button>' +
                        "</td>" +
                        "</tr>";
                        return linha;
        }

        function carregarProdutos(){
            $.getJSON('/api/produtos', function(produtos){
                for (i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);

                }
            });
        }
//------------------------------------------------------------
        function editar(id) {
            $.getJSON('/api/produtos/' + id, function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#nomeProduto').val(data.nome);
                $('#precoProduto').val(data.preco);
                $('#estoqueProduto').val(data.estoque);
                $('#catgoriaProduto').val(data.categoria_id);
                $('#dlgProduto').modal('show')
            });
        }

//------------------------------------------------------------
        //Remover Produto
        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/produtos/" + id,
                context: this,
                success: function () {
                    alert('Produto Excluido!');
                    //removendo a linha da tabela
                    linhas = $("#tabelaProdutos>tbody>tr");
                    e = linhas.filter(function (i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });
                    if (e) {
                        e.remove();
                    }
                },
                error: function (error) {
                    alert('Ocorreu um erro');
                }
            });
        }

//------------------------------------------------------------
        //Envio do Formularia modal (Cadastro de Produtos)
        function criarProduto() {
            prod = {
                    nome: $("#nomeProduto").val(),
                    preco: $("#precoProduto").val(),
                    estoque: $("#estoqueProduto").val(),
                    categoria_id: $("#categoriaProduto").val()
            };

            $.post("/api/produtos", prod, function(data){
                //Add linha na tabela dinamicamente após novo cadastro.
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $("#tabelaProdutos>tbody").append(linha);
            });
        }

//------------------------------------------------------------
        //Atualizar Produto
        function atualizarProduto(){
            prod = {
                    id: $("#id").val(),
                    nome: $("#nomeProduto").val(),
                    preco: $("#precoProduto").val(),
                    estoque: $("#estoqueProduto").val(),
                    categoria_id: $("#categoriaProduto").val()
            };

            $.ajax({
                type: "PUT",
                url: "/api/produtos/" + prod.id,
                context: this,
                data: prod,
                success: function (data) {
                    prod = JSON.parse(data);
                    alert('Produto Atualizado!');
                    //atualizar as linhas da tabela após update do produto
                    linhas = $("#tabelaProdutos>tbody>tr");
                    elemento = linhas.filter(function(i, elemento){
                        return (elemento.cells[0].textContent == prod.id);
                    });
                    if (elemento) {
                        elemento[0].cells[0].textContent = prod.id;
                        elemento[0].cells[1].textContent = prod.nome;
                        elemento[0].cells[2].textContent = prod.estoque;
                        elemento[0].cells[3].textContent = prod.preco;
                        elemento[0].cells[4].textContent = prod.categoria_id;
                    }
                },

                error: function (error) {
                    alert('Ocorreu um erro');
                }
            });
        }

        $("#formProduto").submit(function(event){
            event.preventDefault();
            //Condicional novo produto e editar produto
            if($("#id").val() != '')
                atualizarProduto();
            else
                criarProduto();

            //hide modal
            $("#dlgProduto").modal('hide');
        });
//------------------------------------------------------------
        //chamado a função
        $(function(){
            carregarCategorias();
            carregarProdutos();
        })


    </script>

@endsection
