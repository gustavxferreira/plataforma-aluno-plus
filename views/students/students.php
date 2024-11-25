<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'include/header.php' ?>
</head>

<body>
    <main>
        <section class="pt-3">
            <div class="overlay-spinner loading-spinner-large" style="display:none;">
                <div class="spinner-border text-white" style="width: 10rem; height: 10rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            <div class="container pt-3">
                <h4 class="text-center">Gerenciar Alunos</h4>
                <a href="alunos/criar"><button class="btn btn-dark btn-sm mb-2">Cadastrar Alunos</button></a>
                <div class="mt-3 d-flex justify-content-center">
                    <search-bar id="search-bar-id" table="table-students" columns=[1,2,3]></search-bar>
                </div>

                <div class="table-responsive">
                    <table id="table-students" class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Data de Nascimento</th>
                                <th scope="col">Matriculas</th>
                                <th scope="col">Alterar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <div class="modal modal-lg fade" id="show-enrollments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Matrículas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center gap-3">
                        <input type="hidden">
                        <table id="table-enrollments" class="table table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Nº Matrícula</th>
                                    <th scope="col">Data da Matrícula</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php include_once 'include/footer.php' ?>
    <script type="module" src="/views/students/index.js"></script>
</body>

</html>