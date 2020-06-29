@extends('layout.app', ['current' => 'produtos'])
@section('body')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Alterar produto</h5>
        <div class="card-body">
            <form action="/produtos/atualizar/{{$produto->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input 
                        type="text" 
                        name="nomeNome"  
                        id="idNome" 
                        placeholder="Nome do Produto"
                        class="form-control"
                        value="{{$produto->nome}}"
                    >
                    <p style="visibility: hidden;" >Error</p>
                </div>
                <div class="form-group">
                    <label for="estoque">Estoque</label>
                    <input 
                        type="number" 
                        name="nomeEstoque" 
                        id="idEstoque"
                        class="form-control"
                        value="{{$produto->estoque}}"
                    >
                    <p style="visibility: hidden;" >Error</p>
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input 
                        type="text" 
                        name="nomePreco" 
                        id="idPreco"
                        class="form-control"
                        value="{{$produto->preco}}"
                    >
                    <p style="visibility: hidden;" >Error</p>
                </div>
                <div class="form-group mb-5">
                    <label for="categoria">Categoria:</label>
                    <select name="nomeCategoria" id="idCategoria" class="form-control">
                        @foreach($categorias as $categoria)
                            <option
                                @if($produto->categoria_id == $categoria->id)
                                    value="{{$categoria->id}}"
                                    selected
                                @else
                                    value="{{$categoria->id}}"
                                @endif
                            >
                                {{$categoria->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="/produtos" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
@endsection