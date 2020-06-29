@extends('layout.app', ['current' => 'categorias'])
@section('body')
    <div class="card border">
        <div class="card-body">
        <form action="/categorias/{{$categoria->id}}" method="POST">
                @csrf
                <label for="nomeCategoria">Nome da categoria</label>
                <input 
                    type="text"
                    class="form-control mb-3"
                    name="nomeCategoria"
                    id="idCategoria"
                    placeholder="Categoria"
                    value="{{$categoria->nome}}">
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
            
        </div>
    </div> 
@endsection