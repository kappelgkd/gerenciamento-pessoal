<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#7b68ee!IMPORTANT">
    <div class="container" style="padding:0px; background-color:#7b68ee!IMPORTANT">
        <a class="navbar-brand" href="#">Seu Logotipo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="/dashboard">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/biblioteca">Biblioteca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Tarefas</a>
                </li>

            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
    <h2>Listagem de Arquivos</h2>
    <table id="tabela" class="table table-bordered table-striped display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Arquivo</th>
                <th>Criado Em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
        </tbody>

    </table>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {

        /*
            NÃO ESTOU CONSEGUINDO MONTAR O DATATABLE. 
            AO CHAMAR A CLASSE .DataTable() POR ALGUMA RAZÃO 
            APARECE SEMPRE O AVISO QUE NÃO HÁ DADOS MESMO COM A TABELA JÁ PREENCHIDA PELA FUNÇÃO 
            ABAIXO.
        */

        // Quando o botão for clicado
        // Realiza a solicitação AJAX
        $.ajax({
            type: "GET",
            url: "/lista-arquivos",

            success: function(data) {
                var aDemoItems = JSON.parse(data);
                var tbody = $("#tbody");
                var linha = ""
                aDemoItems.msg.forEach(function(item) {

                    linha = "<tr><td id='idItem'>"+item.id+"</td><td>"+item.arquivo+"</td><td>"+item.criado_em+"</td><td><button class='btn btn-primary'>Deletar</button></td></tr>"
                    tbody.append(linha);
                });
                
            },
            error: function() {
                // em caso de erro
                alert("100 - Tente novamente mais tarde.");
            }
        });
    });
</script>