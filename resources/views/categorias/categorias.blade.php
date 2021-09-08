@extends('layout.app', ["current"=>"categorias.categorias"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            @if(count($listCategorias) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome da Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listCategorias as $listCategorias)
                            <tr>
                                <td>{{ $listCategorias->id }}</td>
                                <td>{{ $listCategorias->nome }}</td>
                                <td>
                                    <a href="/categorias/editar/{{$listCategorias->id}}" class="btn btn-sm btn-primary">Editar</a>
                                    <a href="/categorias/remover/{{$listCategorias->id}}" class="btn btn-sm btn-danger">Excluir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h6 class="card-text">Não existe categorias para serem exibidas.</h6>
            @endif
        </div>
        <div class="card-footer">
            <a href="/categorias/novo" class="btn btn-sm btn-primary" role="button">Nova Categoria</a>
        </div>
    </div>
@endsection
