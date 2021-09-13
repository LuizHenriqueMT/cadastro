@extends('layout.app', ["current"=>"produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>
                <table class="table table-bordered table-hover" id="tabelaProdutos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome do Produto</th>
                            <th>Estoque</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            <a class="btn btn-sm btn-primary" role="button" onclick="novoProduto()">Novo Produto</a>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto">

                    <div class="modal-header">
                        <h5 class="modal-title">Novo Produto</h5>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="nomeProduto" class="control-label">Nome do Produtos</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="estoqueProduto" class="control-label">Estoque do Produtos</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="estoqueProduto" placeholder="Estoque do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço do Produtos</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="precoProduto" placeholder="Preço do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoriaProduto" class="control-label">Categoria do Produtos</label>
                            <div class="input-group">
                                <select class="form-control" id="categoriaProduto">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : "{{ csrf_token() }}"
            }
        });

        function novoProduto() {
            $('#nomeProduto').val('');
            $('#estoqueProduto').val('');
            $('#precoProduto').val('');
            $('#categoriaProduto').val('');

            $('#dlgProdutos').modal('show');
        }

        function carregarCategorias(){
            $.getJSON('/api/categorias', function (categoria){
                for(i=0; i < categoria.length; i++){
                    opcao = '<option value ="' + categoria[i].id + '">' + categoria[i].nome + '</option>';
                    $('#categoriaProduto').append(opcao);
                }
            })
        }

        function montarLinhas(paramProduto){
            var linha =
                "<tr>" +
                    "<td>" + paramProduto.id + "</td>" +
                    "<td>" + paramProduto.nome + "</td>" +
                    "<td>" + paramProduto.estoque + "</td>" +
                    "<td>" + paramProduto.preco + "</td>" +
                    "<td>" + paramProduto.categoria_id + "</td>" +
                    "<td>" +
                        '<button class="btn btn-sm btn-primary" onclick="editar(' + paramProduto.id + ')"> Editar </button>' +
                        '<button class="btn btn-sm btn-danger" onclick="remover(' + paramProduto.id + ')"> Remover </button>' +
                    "</td>" +
                "</tr>";
            return linha;
        }

        function editar(id){
            $.getJSON('/api/produtos/'+id, function (data){
                $('#id').val(data.id);
                $('#nomeProduto').val(data.nome);
                $('#estoqueProduto').val(data.estoque);
                $('#precoProduto').val(data.preco);
                $('#categoriaProduto').val(data.categoria_id);
                $('#dlgProdutos').modal('show');
            });
        }

        function remover(id){
            $.ajax({
                type: "DELETE",
                url: "/api/produtos/" + id,
                context: this,
                success: function (){
                    linhasRemove = $('#tabelaProdutos>tbody>tr');
                    remover = linhasRemove.filter(function( i, produto){
                        return produto.cells[0].textContent == id;
                    })
                    remover.remove();
                },
                error: function(error){
                    console.log(error);
                },
            })
        }

        function carregarProdutos(){
            $.getJSON('/api/produtos', function(produtos){
                for(i=0; i < produtos.length; i++){
                    linha = montarLinhas(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            })
        }

        function criarProduto() {
            produto = {
                nomeProduto: $('#nomeProduto').val(),
                estoqueProduto: $('#estoqueProduto').val(),
                precoProduto: $('#precoProduto').val(),
                categoriaProduto: $('#categoriaProduto').val()
            };

            $.post("/api/produtos",produto, function(varProduto){
                produto = JSON.parse(varProduto);
                linha = montarLinhas(produto);
                $('#tabelaProdutos>tbody').append(linha);
            })
        }

        function editarProduto(){
            produto = {
                id: $('#id').val(),
                nomeProduto: $('#nomeProduto').val(),
                estoqueProduto: $('#estoqueProduto').val(),
                precoProduto: $('#precoProduto').val(),
                categoriaProduto: $('#categoriaProduto').val()
            };

            $.ajax({
                type: "PUT",
                url: "/api/produtos/" + produto.id,
                context: this,
                data: produto,
                success: function(data){
                    linhasUpdate = $('#tabelaProdutos>tbody>tr');
                    produto = JSON.parse(data);

                    atualizar = linhasUpdate.filter(function( i, elemento ){
                        return elemento.cells[0].textContent == produto.id;
                    });

                    if (atualizar){
                        atualizar[0].cells[0].textContent = produto.id;
                        atualizar[0].cells[1].textContent = produto.nome;
                        atualizar[0].cells[2].textContent = produto.estoque;
                        atualizar[0].cells[3].textContent = produto.preco;
                        atualizar[0].cells[4].textContent = produto.categoria_id;
                    }
                },
                error: function(error){
                    console.log (error);
                },
            });
        }

        $('#formProduto').submit(function(event){
            event.preventDefault();
            if ( $("#id").val() != '' ){
                editarProduto();
            } else {
                criarProduto();
            }
            $('#dlgProdutos').modal('hide');
        })

        $(function(){
            carregarCategorias();
            carregarProdutos();
        })

    </script>
@endsection
