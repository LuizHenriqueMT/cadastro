@extends('layout.app',["current"=>"home"])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">

                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Produtos</h5>
                        <p class="card-text">
                            Todos os produtos devem serem cadastrados clicando no botão abaixo!
                        </p>
                        <a href="produtos" class="btn btn-primary">Cadastrar Produtos</a>
                    </div>
                </div>

                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Categoria</h5>
                        <p class="card-text">
                            Todos as categorias devem serem cadastrados clicando no botão abaixo!
                        </p>
                        <a href="categorias" class="btn btn-primary">Cadastrar Categorias</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
