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
                    <h4>Editar Curso</h4>
                <form id="course-edit">
                    <input id="course-id" type="hidden">
                    <label for="">Nome Do Curso</label>
                    <input class="form-control mb-2" type="text" id="edit_title" name="title" placeholder="Ex: Biologia..." required>

                    <label for="">Duração do Curso (Meses)</label>
                    <input class="form-control mb-2" type="text" id="edit_duration" name="duration" min=1 placeholder="Ex: 24..." required>

                    <label for="">Descrição do Curso</label>
                    <textarea class="form-control" id="edit_description" name="description"></textarea>

                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" role="switch" name="date_archived_status" id="date-archived-status">
                        <label class="form-check-label" for="date-archived-status">Arquivado?</label>
                    </div>

                    <div class="d-flex justify-content-start">
                        <button id="button-edit-course" class="btn btn-dark btn-sm mt-2">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <hr>

    <?php include_once 'include/footer.php' ?>
    <script type="module" src="/views/courses/edit/index.js"></script>
</body>

</html>