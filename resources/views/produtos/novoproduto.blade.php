@extends('layout.app', ['current' => 'produtos'])
@section('body')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Novo produto</h5>
            <div class="card-body">
                <form action="/produtos" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input 
                            type="text" 
                            name="nomeNome"  
                            id="idNome" 
                            placeholder="Nome do Produto"
                            class="form-control">
                        <p style="visibility: hidden;" >Error</p>
                    </div>
                    <div class="form-group">
                        <label for="estoque">Estoque</label>
                        <input 
                            type="number" 
                            name="nomeEstoque" 
                            id="idEstoque"
                            class="form-control">
                        <p style="visibility: hidden;" >Error</p>
                    </div>
                    <div class="form-group">
                        <label for="preco">Preço:</label>
                        <input 
                            type="text" 
                            name="nomePreco" 
                            id="idPreco"
                            class="form-control">
                        <p style="visibility: hidden;" >Error</p>
                    </div>
                    <div class="form-group mb-5">
                        <label for="categoria">Categoria:</label>
                        <select name="nomeCategoria" id="idCategoria" class="form-control">
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="/produtos" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection