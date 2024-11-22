<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/style/style.css">
    <title>Aluno+</title>
</head>

<body>
    <main class="min-vh-100 min-vw-100">
        <section class="d-flex flex-column justify-content-center align-items-center min-vh-100 ">
            <div class="p-3 shadow-lg rounded">
                <h1 class="text-center bg-dark text-white rounded border border-dark p-3">Aluno +</h1>
                <form id="login-form" class="d-flex flex-column gap-3 text-center">
                    <label for="user">Insira o usuário</label>
                    <input class="form-control" id="user" type="text" required>

                    <label for="password">Insira a senha</label>
                    <input class="form-control" id="password" type="text" required>
                    <button class="btn btn-dark" type="submit">Logar</button>
                </form>
            </div>
        </section>
    </main>
    <script src="/views/login/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>