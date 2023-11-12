<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="task-form">
                <h2 class="text-center mb-4">Adicionar Tarefa</h2>
                <form>
                    <div class="form-group">
                        <label for="taskName">Nome da Tarefa</label>
                        <input type="text" class="form-control" id="taskName" placeholder="Digite o nome da tarefa" required>
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Descrição</label>
                        <textarea class="form-control" id="taskDescription" rows="3" placeholder="Digite a descrição da tarefa"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="taskDate">Data de Conclusão</label>
                        <input type="date" class="form-control" id="taskDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Adicionar Tarefa</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="task-list">
                <h2 class="text-center mb-4">Lista de Tarefas</h2>
                <div class="task-item">
                    <h4>Nome da Tarefa 1</h4>
                    <p>Descrição da Tarefa 1</p>
                    <p>Data de Conclusão: 2023-01-01</p>
                </div>
                <div class="task-item">
                    <h4>Nome da Tarefa 2</h4>
                    <p>Descrição da Tarefa 2</p>
                    <p>Data de Conclusão: 2023-01-02</p>
                </div>
                <!-- Adicione mais tarefas conforme necessário -->
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        margin-top: 50px;
    }

    .task-form,
    .task-list {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .task-item {
        margin-bottom: 10px;
    }
</style>