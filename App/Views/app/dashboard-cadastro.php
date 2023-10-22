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
            <ul class="list-group" id="listaTextos">
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
                const lista = document.getElementById('listaTextos')
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                let h4 = document.createElement('h4');
                h4.classList.add('text-primary');
                h4.textContent = "Não há conteudo cadastrado.";
                li.appendChild(h4);
                lista.appendChild(li);
                
                if (retorno.status == "200") {
                    
                    let textos = retorno.msg;
                    textos.forEach((texto) => {
                        li.classList.add('list-group-item');
                        h4.classList.add('text-primary');
                        h4.textContent = texto['titulo'];

                        // criando o campo texto
                        const p = document.createElement('p');
                        p.classList.add('text-primary');
                        p.textContent = texto['texto'];
                        li.appendChild(h4);
                        li.appendChild(p);
                        lista.appendChild(li);

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