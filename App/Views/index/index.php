<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 login-form">
                <h2 class="text-center">Login</h2>
                <form method="POST" action="/autenticar">
                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input type="text" class="form-control" id="username" placeholder="Informe seu usuário" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" placeholder="Informe sua senha" name="senha">
                    </div>
                    <button type="button" id="btnAutenticar" class="btn btn-purple btn-block">Entrar</button>
                </form>
                <p class="text-center mt-3"><a href="#">Primeiro Acesso?</a></p>
            </div>
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const btnAutenticar = $("#btnAutenticar");
    btnAutenticar.on("click", function() {
        //console.log("inicio");
        var login = $("#username").val();
        var senha = $("#password").val();

        if (login != "" && senha != "") {
            var dados = {
                login: login,
                senha: senha
            };
            $.ajax({
                type: "POST",
                url: "/autenticar",
                data: dados,
                success: function(response) {
                    //console.log(response);

                    if (response.status = 200) {
                        //console.log("aqui");
                        window.location.href = "/dashboard"
                    }
                },
                error: function() {
                    // em caso de erro
                    alert("100 - Tente novamente mais tarde.");
                }
            });
        }
    })
</script>