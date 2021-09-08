@extends('layout.app', ["current"=>"produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>
            @if(count($listProdutos) > 0)
                <table class="table table-bordered table-hover">
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
                    @foreach($listProdutos as $listProdutos)
                        <tr>
                            <td>{{ $listProdutos->id }}</td>
                            <td>{{ $listProdutos->nome }}</td>
                            <td>{{ $listProdutos->estoque }}</td>
                            <td>{{ $listProdutos->preco }}</td>
                            <td>{{ $listProdutos->categoria_id }}</td>
                            <td>
                                <a href="/categorias/editar/{{$listProdutos->id}}" class="btn btn-sm btn-primary">Editar</a>
                                <a href="/categorias/remover/{{$listProdutos->id}}" class="btn btn-sm btn-danger">Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h6 class="card-text">Não existe produtos para serem exibidos.</h6>
            @endif
        </div>
        <div class="card-footer">
            <a href="/produtos/novo" class="btn btn-sm btn-primary" role="button">Novo Produto</a>
        </div>
    </div>
@endsection
