<div class="container">
    <div class="row">
        <div class="col-md-12 menuDashboard">
            <div class="card text-center">
                <div class="card-header">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab" href="#nav-task" role="tab" aria-controls="nav-task" aria-selected="true">Task</a>

                            <a class="nav-item nav-link" id="nav-library-tab" data-toggle="tab" href="#nav-library" role="tab" aria-controls="nav-library" aria-selected="false">Library</a>

                        </div>
                    </nav>
                    <div class="tab-content areaCentral" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-task" role="tabpanel" aria-labelledby="nav-task-tab">
                            <!--COMPONENTE-->
                            <div class="topoTarefas" id="tab-titulo">
                                <h3>Tarefas</h3>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p>Lista de Tarefas do dia:</p>
                                        <div class="formTarefasDia">
                                            <form action="/finalizar-tarefa" method="post">
                                                <div class="form-group">
                                                    
                                                    <input type="checkbox" name="tarefa1">Tarefa 1</input>
                                                    
                                                </div>

                                                <div class="form-group">
                                                    
                                                    <input type="checkbox" name="tarefa2">Tarefa 1</input>
                                                    
                                                </div>

                                                <div class="form-group">
                                                    
                                                    <input type="checkbox" name="tarefa3">Tarefa 1</input>
                                                    
                                                </div>

                                                <div class="botaoEnviarTarefaDia">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="linha-vertical">

                                    </div>

                                    <div class="col-md-5">
                                        <p>Uma de três colunas</p>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="nav-library" role="tabpanel" aria-labelledby="nav-library-tab">
                            <!--COMPONENTE-->
                            <div class="topoTarefas" id="tab-titulo"></div>

                            <div class="row">
                                <div class="col-md-5">

                                </div>

                                <div class="col-md-2 linha-vertical">

                                </div>

                                <div class="col-md-5">

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .menuDashboard {
        margin-top: 10%;
    }

    .areaCentral {
        height: 400px;
    }

    .linha-vertical {
        border-left: 2px ridge;
        /* Adiciona borda esquerda na div como ser fosse uma linha.*/
        box-sizing: border-box;
        height: 315px;
        margin-left: 9%;
        /* margin-right: 50%; */
    }

    .topoTarefas {
        margin-top: 1%;
        margin-bottom: 1%;
    }

    .formTarefasDia{
        margin-right: 80%;
    }

    .botaoEnviarTarefaDia{
        margin-left:180px;
    }
</style>

<script>
    // fazendo request para a api que irá listar todas as tarefas
    window.addEventListener("load", (event) => {
        fetch('/listar-tarefa')
        .then((body) => body.json())
        .then((data) => {
            console.log(data)
        })
        .catch((error) => console.error('Erro:', error.message || error))
    });
</script>