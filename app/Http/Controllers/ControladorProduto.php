<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Produto;

class ControladorProduto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        //
        $produtos = Produto::all();
        return view('produtos.produtos', compact('produtos'));
    }
    public function index(){
        $prods = Produto::all();
        return $prods->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view('produtos.novoproduto', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $produto = new Produto();
        //no input deve ser os nomes dos campos do objeto passado no post
        $produto->nome = $request->input('nome');
        $produto->estoque = $request->input('preco');
        $produto->preco = $request->input('estoque');
        $categoria = Categoria::find($request->input('categoria_id'));
        $produto->categoria()->associate($categoria);
        $produto->save();
        //para remover a associação: categoria()->dissociate();
        return json_encode($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categorias = Categoria::all();
        $produto = Produto::find($id);
        if(isset($produto))
            return view(
                'produtos.alterarproduto', 
                [
                    'categorias' => $categorias, 
                    'produto' => $produto
                ]
            );
        
        return redirect('/produtos');
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
        //
        $produto = Produto::find($id);
        if(isset($produto)) {
            $produto->nome = $request->input('nomeNome');
            $produto->estoque = $request->input('nomeEstoque');
            $produto->preco = $request->input('nomePreco');
            $produto->categoria()->dissociate();
            $categoria = Categoria::find($request->input('nomeCategoria'));
            $produto->categoria()->associate($categoria);
            $produto->save();
        }
        return redirect('/produtos');
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
        if(isset($produto)) {
            $produto->categoria()->dissociate();
            $produto->delete();
            return response('OK',200);
        }
        return response('Produto não encontrado', 404);
    }
}
