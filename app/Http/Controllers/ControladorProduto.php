<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ControladorProduto extends Controller
{
    public function indexView()
    {
        $listCategorias = Categoria::all();
        $listProdutos = Produto::all();
        return view('produtos.produtos')
            ->with(compact(['listProdutos','listCategorias']));
    }

    public function index()
    {
        $listProdutos = Produto::all();
        return $listProdutos->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listCategorias = Categoria::all();
        return view('produtos.novoProduto')
            ->with(compact('listCategorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produtos = new Produto();
        $produtos->nome = $request->input('nomeProduto');
        $produtos->estoque = $request->input('estoqueProduto');
        $produtos->preco = $request->input('precoProduto');
        $produtos->categoria_id = $request->input('categoriaProduto');
        $produtos->save();
        return json_encode($produtos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if (isset($produto)){
            return json_encode($produto);
        }
        return response('Produto não encontrado.',404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if(isset($produto)){
            $produto->nome = $request->input('nomeProduto');
            $produto->estoque = $request->input('estoqueProduto');
            $produto->preco = $request->input('precoProduto');
            $produto->categoria_id = $request->input('categoriaProduto');
            $produto->save();
            return json_encode($produto);
        }
        return response('Produto não encontrado.',404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        if (isset($produto)){
            $produto->delete();
            return response('OK',200);
        }
        return response('Produto não encontrado',404    );
    }
}
