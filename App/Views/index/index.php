<div class="bgLogin row">
    <div class="card boxFormulário col-12 col-md-5">
        <img src="img/letrag.png" class="card-img-top alinhaCentro" alt="..." style="width:76px; margin-left:42%; margin-top:10px;">
        <div class="card-body col-md">
            <form method="POST" action="/autenticar">
                <div class="alinhaCentro form-group">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="alinhaCentro form-group">
                    <input type="text" size="30px" placeholder="Usuário" name="login"></input>
                </div>
                
                <div class="alinhaCentro form-group">
                    <input type="password" size="30px" placeholder="Senha" name="senha"></input><br/><br/>
                </div>
                
                <div class="alinhaCentro form-group">
                    <input type="submit" class="btn btn-primary"></input>
                </div>
                
                <?php
                // recuperando valor do atributo login no view. É onde define o valor em caso de erro.
                if($this->view->login == 'erro')
                {
                    ?>
                    <!-- TRATAR POSICIONAMENTO DA MENSAGEM DE ERRO -->
                    <span class="text text-danger">Login ou senha invalidos</span>
                <?php
                }?>
            </form>
        </div>
    </div>
</div>