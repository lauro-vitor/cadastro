@extends('layout.app', ['current' => 'categorias'])
@section('body')
    <div class="card border" >
        <div class="card-body" >
            <h5 class="card-title">Registros de Categorias</h5>
            @if(count($categorias) > 0)
            <table class="table table-hover">
                <thead >
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome da Categoria</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                        <tr>
                            <td>{{$categoria->id}}</td>
                            <td>{{$categoria->nome}}</td>
                            <td>
                                <a href="/categorias/editar/{{$categoria->id}}"
                                    class="btn btn-sm btn-primary">
                                    Editar
                                </a>
                                <a href="/categorias/apagar/{{$categoria->id}}"
                                    class="btn btn-sm btn-danger">
                                    Apagar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <div class="card-footer">
            <a href="/categorias/novo" class="btn btn-primary" role="button">Nova categoria</a>
        </div>
    </div>
@endsection