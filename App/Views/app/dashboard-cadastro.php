<div class="container mt-5">
    <div class="row">
        <!-- Formulário de Cadastro -->
        <div class="col-md-6 col-sm-2">
            <h2>Cadastro de Publicação</h2>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título da publicação">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo:</label>
                <textarea class="form-control" id="texto" name="texto" rows="5" placeholder="Conteúdo da publicação"></textarea>
            </div>
            <button class="btn btn-primary" name="cadastrarTexto" id="cadastrarTexto">Cadastrar</button>
        </div>

        <!-- Lista de Posts Cadastrados -->
        <div class="col-md-6">
            <h2>Posts Cadastrados</h2>
            <ul class="list-group" id="listaTextos" style='list-style:none;'>
                
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Quando o botão for clicado
        var btnCadastrarTexto = $("#cadastrarTexto")
        $("#cadastrarTexto").click(function() {
            var tituloTexto = $("#titulo").val();
            var conteudoTexto = $("#texto").val();
            // Realiza a solicitação AJAX
            $.ajax({
                type: "POST",
                url: "/cadastrar-texto",
                data: {
                    titulo: tituloTexto,
                    texto: conteudoTexto
                },
                success: function(response) {

                    var retorno = JSON.parse(response);
                    alert(retorno.msg);
                    // estou recarregando a página pois não consegui limpar o campo dos inputs.
                    window.location.reload();

                },
                error: function() {
                    // em caso de erro
                    alert("A informação não pôde ser cadastrada.");
                }
            });
        });
    });

    $(document).ready(function() {
        // Quando o botão for clicado
        // Realiza a solicitação AJAX
        $.ajax({
            type: "GET",
            url: "/listar-texto",
            success: function(response) {
                var retorno = JSON.parse(response);
                //  console.log(retorno);
                
                /*
                    NO BLOCO ABAIXO EU ASSUMO QUE NÃO HAVERÁ NENHUM RETORNO
                    E CRIO OS CAMPOS E EXIBO A MENSAGEM
                    CASO EXISTA RETORNO DE CONTEUDO DO BACK END
                    CRIO OS CAMPOS PARA EXIBIR O QUE VIER DO BANCO DE DADOS.
                */

                if (retorno.status == "200") {

                    var textos = retorno.msg;
                    // console.log(textos);
                    var ul = $("#listaTextos");
                    var linha = "";
                    textos.forEach((texto) => {
                        linha += "<h4>"+texto['titulo']+"</h4><p>"+texto['texto']+"</p>";
                        console.log(titulo);
                        ul.html(linha);
                        
                    });
                }

            },
            error: function() {
                // em caso de erro
                alert("100 - Tente novamente mais tarde.");
            }
        });
    });
</script>