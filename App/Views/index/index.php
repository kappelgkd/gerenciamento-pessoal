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
                <h2 class="text-center">Login!!!!</h2>
                <form method="POST" action="/autenticar">
                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input type="text" class="form-control" id="username" placeholder="Informe seu usuário" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" placeholder="Informe sua senha" name="senha">
                    </div>
                    <button type="submit" class="btn btn-purple btn-block">Entrar</button>
                </form>
                <p class="text-center mt-3"><a href="#">Primeiro Acesso?</a></p>
            </div>
        </div>
    </div>
</body>
</html>