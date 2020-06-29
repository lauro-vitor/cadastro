@extends('layout.app', ['current' => 'produtos'])
@section('body')
   <div class="card">
       <div class="card-body">
           <h4 class="card-title">Registros de Produtos</h4>
            @if(sizeof($produtos) > 0)
                <table class="table table-hover" id="tabelaProdutos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Estoque</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            @else 
                <h4>Nenhum produto cadastrado</h4>
            @endif
       </div>
       <div class="card-footer">
            <button 
                class="btn btn-sm btn-primary" 
                role="button" 
                onclick="novoProduto()">
                    Novo Produto
            </button>
       </div>
   </div>
   <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
        <div class="modal-dialog"role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Produto</h5>
                    </div>
                    <div class="modal-body">
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
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button 
                                type="cancel" 
                                class="btn btn-secondary" 
                                data-dissmiss="modal"
                            >
                                Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
   </div>
@endsection

@section('javascript')
   <script type="text/javascript">
        function novoProduto(){
            $('idNome').val('');
            $('idEstoque').val('');
            $('idPreco').val('');
            $('idCategoria').val('');
            $('#dlgProdutos').modal('show')
        }
        function carregarCategorias(){
            $.getJSON('/api/categorias', function(data){
                for(let i = 0; i < data.length; i++) {
                    opcao = 
                        '<option value ="' +
                        data[i].id +
                        '">' +
                        data[i].nome +
                        '</option>';
                    $('#idCategoria').append(opcao);
               }
            });
        }
        function carregarProdutos(){
            $.getJSON('/api/produtos', function(produtos){
                for(let i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            });
        }
        function montarLinha(produto){
            return(
                '<tr>' +
                    '<td>' + produto.id + '</td>' +
                    '<td>' + produto.nome + '</td>' +
                    '<td>' + produto.estoque + '</td>' +
                    '<td>' + produto.preco + '</td>' +
                    '<td>' + produto.categoria_id + '</td>' +
                    '<td>' +
                        '<button class="btn btn-primary mr-3" > Editar </button>' +
                        '<button class="btn btn-danger" > Apagar </button>' +
                    '</td>' +
                '<tr>'
            );
        }
        $(function(){
            carregarCategorias();
            carregarProdutos();
        })
   </script>
@endsection