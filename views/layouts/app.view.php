<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="/public/style/style.css">
    <?php yieldSection('styles'); ?>
    <title>Aluno +</title>
</head>

<body>
    <div class="overlay-spinner loading-spinner-large" style="display:none;">
        <div class="spinner-border text-white" style="width: 10rem; height: 10rem;" role="status">
            <span class="sr-only"></span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand p-3" href="#"> Aluno +</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto gap-3">

                <li class="nav-item">
                    <a class="nav-link" href="/alunos">Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/matriculas">Matrículas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cursos">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Sair</a>
                </li>
            </ul>

        </div>
    </nav>

    <main>
        <section class="container-custom">
            <?= $content ?>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php yieldSection('scripts'); ?>
</body>

</html>