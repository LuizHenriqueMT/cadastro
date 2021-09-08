@extends('layout.app', ["current"=>"novoProduto"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Produto"><br>

                    <label for="estoqueProduto">Estoque do Produto</label>
                    <input type="text" class="form-control" name="estoqueProduto" id="estoqueProduto" placeholder="Estoque"><br>

                    <label for="precoProduto">Preço do Produto</label>
                    <input type="text" class="form-control" name="precoProduto" id="precoProduto" placeholder="Preço">

                    <p></p>
                    <label for="categoriaProduto">Categoria do Produto</label><br>
                    <select class="form-select" aria-label="Default select example" name="categoriaProduto">
                        @foreach($listCategorias as $listCategorias)
                        <option value="{{ $listCategorias['id'] }}"> {{ $listCategorias["nome"] }} </option>
                        @endforeach

                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection
