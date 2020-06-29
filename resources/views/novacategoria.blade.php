@extends('layout.app', ['current' => 'categorias'])
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/categorias" method="POST">
                @csrf
                <label for="nomeCategoria">Nome da categoria</label>
                <input 
                    type="text"
                    class="form-control mb-3"
                    name="nomeCategoria"
                    id="idCategoria"
                    placeholder="Categoria">
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a href="/categorias" type="cancel" class="btn btn-danger btn-sm" >Cancelar</a>
            </form>
            
        </div>
    </div> 
@endsection