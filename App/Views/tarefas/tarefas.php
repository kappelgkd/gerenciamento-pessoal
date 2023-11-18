<style>
    /* body {
      background-color: #f8f9fa;
    } */
    .container {
        max-width: 1200px;
    }

    .calendar-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .calendar-header {
        background-color: #4285f4;
        color: #fff;
        padding: 15px;
        text-align: center;
        border-bottom: 2px solid #fff;
        display: flex;
        justify-content: space-between;
    }

    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        height: 500px;
    }

    .day {
        padding: 15px;
        text-align: center;
        border-right: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }

    .day:hover {
        background-color: #f1f8ff;
    }
</style>


<div class="container col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="calendar-container">
        <div class="calendar-header">
            <div>
                <button onclick="previous()" class="btn btn-danger">Anterior</button>
                <span id="currentMonthYear"></span>
                <button onclick="next()" class="btn btn-danger">Próximo</button>
            </div>
        </div>
        <div class="calendar-body" id="calendarDays">
            <!-- Dias serão adicionados dinamicamente aqui -->
        </div>
    </div>
</div>

<script>
    const currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const monthNames = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    function updateCalendar() {
        const currentMonthYearElement = document.getElementById('currentMonthYear');
        const calendarDaysElement = document.getElementById('calendarDays');

        currentMonthYearElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        // Limpar os dias existentes
        calendarDaysElement.innerHTML = '';

        // Obter o primeiro dia do mês
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();

        // Obter o último dia do mês
        const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();

        // Adicionar os dias do mês
        for (let i = 0; i < firstDay; i++) {
            // Adicionar células vazias para preencher o início do mês
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('day', 'text-muted');

            calendarDaysElement.appendChild(emptyDay);
        }

        for (let i = 1; i <= lastDay; i++) {
            // Adicionar os dias do mês
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');
            dayElement.id = i;
            dayElement.textContent = i;

            // Adicionar evento de clique para chamar a função abrirTarefas
            dayElement.addEventListener('click', function() {
                abrirTarefas(i, currentMonthYearElement.textContent);
            });

            calendarDaysElement.appendChild(dayElement);

        }

    }

    // 

    function previous() {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        updateCalendar();
    }

    function next() {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        updateCalendar();
    }

    function mesLetras(mesExtenso) {

        const meses = {
            'janeiro': 1,
            'fevereiro': 2,
            'março': 3,
            'abril': 4,
            'maio': 5,
            'junho': 6,
            'julho': 7,
            'agosto': 8,
            'setembro': 9,
            'outubro': 10,
            'novembro': 11,
            'dezembro': 12
        };

        var mes = mesExtenso.toLowerCase();
        // console.log(mes);

        // verifico se existe chave que inclua o mes que recebi como parametro
        if (Object.keys(meses).includes(mes)) {
            return meses[mes];
        } else {
            // Retorna null ou outro valor indicando que o mês é inválido
            return null;
        }

    }

    // mesLetras("novembro");

    function abrirTarefas(dia) {
        var anoMes = document.getElementById('currentMonthYear');
        var anoMes = anoMes.textContent;
        var mesExtenso = anoMes.split(" ")[0];
        var ano = anoMes.split(" ")[1];
        
        const dataAtual = new Date();
        const mesAtual = dataAtual.getMonth() + 1; // Adicionamos 1 porque os meses começam em 0
        const anoAtual = dataAtual.getFullYear();
        // Obter o dia do mês atual
        const diaAtual = dataAtual.getDate();
        
        console.log(anoAtual+"-"+mesAtual+"-"+diaAtual);
        var dataPresente = anoAtual+"-"+mesAtual+"-"+diaAtual;

        if (dia < 10) {
            dia = "0" + dia
        }

        var mesNumerico = mesLetras(mesExtenso);

        // console.log(dia + '/' + mesNumerico + "/" + ano)
        console.log(ano + mesNumerico + dia)
        var diaTarefa = ano+"-"+mesNumerico+"-"+dia
        $("#data").val(dia + "/" + mesNumerico + "/" + ano);


        // checagem de data para não permitir cadastrar tarefa em dias passados;
        if(diaTarefa>=dataPresente){ 
            $("#exampleModal").modal("show");
        }
        
    }

    updateCalendar(); // Atualizar o calendário inicial
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Tarefa</h5>
                <!-- Botão de fechar no cabeçalho do modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar">X</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data:</label>
                        <input type="text" class="form-control" id="data" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Descrição da tarefa:</label>
                        <input type="text" class="form-control" id="desc" placeholder="">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem:</label>
                        <textarea class="form-control" id="mensagem" rows="3" placeholder="Digite sua mensagem"></textarea>
                    </div> -->
                </form>

            </div>
            <div class="modal-footer">
                <!-- Botão de fechar no rodapé do modal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>