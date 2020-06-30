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
                        <input type="hidden" id="id">
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
                                data-dismiss="modal"
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : "{{ csrf_token() }}"
            }
        });
        function novoProduto(){
            $('#id').val('');
            $('#idNome').val('');
            $('#idEstoque').val('');
            $('#idPreco').val('');
            $('#idCategoria').val('');
            $('#dlgProdutos').modal('show')
        }
        function apagar(id){
            $.ajax({
                type: "DELETE",
                url: `/api/produtos/${id}`,
                context: this,
                success: function (){
                    //comentar isso com Rodrigo
                    document.getElementById(id).textContent = '';
                },
                error: function (error){
                    console.log(error)
                }
            });
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
                for (let i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            });
        }
        function montarLinha(produto){
            return(
                 `<tr id=${produto.id}>` +
                    '<td>' + produto.id + '</td>' +
                    '<td>' + produto.nome + '</td>' +
                    '<td>' + produto.estoque + '</td>' +
                    '<td>' + produto.preco + '</td>' +
                    '<td>' + produto.categoria.nome + '</td>' +
                    '<td>' +
                        '<button class="btn btn-primary mr-3" onClick="editar('+produto.id+')"> Editar </button>' +
                        '<button class="btn btn-danger" onClick="apagar('+produto.id+')" > Apagar </button>' +
                    '</td>' +
                '<tr>'
            );
        }
        function editar(id){
            $.getJSON(`api/produtos/${id}`, function(data){
                $('#id').val(data.id);
                $('#idNome').val(data.nome);
                $('#idEstoque').val(data.estoque);
                $('#idPreco').val(data.preco);
                $('#idCategoria').val(data.categoria_id);
                $('#dlgProdutos').modal('show');
            });
        }
        function criarProduto() {
           prod = {
                nome : $('#idNome').val(),
                preco: $('#idPreco').val(),
                estoque: $('#idEstoque').val(),
                categoria_id: $('#idCategoria').val() 
            }
            $.post("/api/produtos", prod, function(data){
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaProdutos>tbody').append(linha);
            });
        }
        function salvarProduto(){
            prod = {
                id : $('#id').val(),
                nome : $('#idNome').val(),
                preco: $('#idPreco').val(),
                estoque: $('#idEstoque').val(),
                categoria_id: $('#idCategoria').val() 
            }
            $.ajax({
                type: "PUT",
                url: `/api/produtos/${prod.id}`,
                data: prod,
                context: this,
                success: function (data) {
                    produtoJson= JSON.parse(data);
                    produto = document.getElementById(produtoJson.id);
                    produto.cells[1].innerHTML = produtoJson.nome;
                    produto.cells[2].innerHTML = produtoJson.estoque;
                    produto.cells[3].innerHTML = produtoJson.preco;
                    produto.cells[4].innerHTML = produtoJson.categoria.nome;
                    /*
                    isso foi o que o professor fez:

                    prod = JSON.parse(data);
                    linhas = $('#tabelaProdutos>tbody>tr');
                    e = linhas.filter( function(i, e) { 
                        return ( e.cells[0].textContent == prod.id );
                    });
                    if (e) {
                        e[0].cells[0].textContent = prod.id;
                        e[0].cells[1].textContent = prod.nome;
                        e[0].cells[2].textContent = prod.estoque;
                        e[0].cells[3].textContent = prod.preco;
                        e[0].cells[4].textContent = prod.categoria_id;
                    }*/
                },
                error: function (error){
                    console.log(error)
                }
            });
        }
        $('#formProduto').submit(function(event){
            event.preventDefault();

            if($('#id').val() != '') {
                salvarProduto();
            } else {
                criarProduto();
            }
            
            $('#dlgProdutos').modal('hide');
        });
        
        $(function(){
            carregarCategorias();
            carregarProdutos();
        })
   </script>
@endsection