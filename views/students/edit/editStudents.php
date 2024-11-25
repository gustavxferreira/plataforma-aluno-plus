<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'include/header.php' ?>
</head>

<body>
    <main>
        <section class="container-custom">
            <div class="overlay-spinner loading-spinner-large" style="display:none;">
                <div class="spinner-border text-white" style="width: 10rem; height: 10rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            <div class="container-box-shadow">
                <div class="d-flex flex-row justify-content-between">
                    <h4>Editar Aluno</h4>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-confirm">Deletar</button>
                </div>
                <form id="student-edit">
                    <input id="student-id" type="hidden">
                    <label for="">Nome Do Aluno</label>
                    <input class="form-control mb-2" type="text" id="edit_name" name="name" placeholder="Ex: João Silva..." required>

                    <label for="">Email</label>
                    <input class="form-control mb-2" type="email" id="edit_email" name="email" required>

                    <label for="">Data de Nascimento</label>
                    <input class="form-control mb-2" type="date" id="edit_birthdate" name="birthdate" min=1950-01-01 placeholder="Ex: 19/01/2005" required>

                    <input name="operation" value="edit" type="hidden">
                    <div class="d-flex justify-content-start">
                        <button id="button-edit-student" class="btn btn-dark btn-sm mt-2">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </section>

        <div class="modal fade" id="delete-confirm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Confirmar Exclusão</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center gap-3">
                            <p>Ao excluir um aluno, todas as matrículas associadas a ele também serão removidas permanentemente.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button id="delete-course" type="button" class="btn btn-danger btn-sm">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <hr>

    <?php include_once 'include/footer.php' ?>
    <script type="module" src="/views/students/edit/index.js"></script>
</body>

</html>