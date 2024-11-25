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
                <h4>Matrículas</h4>
                <form id="enrollment-create">
                    <hr>
                    <label for="enrollment_date">Data de Inicio Da Matrícula</label>
                    <input type="date" name="enrollment_date" class="form-control mb-2" required>

                    <label for="status">Status da Matrícula</label>
                    <select class="form-control" name="status" required>
                        <option value="active">Ativa</option>
                        <option value="inactive">Inativa</option>
                        <option value="suspended">Suspensa</option>
                    </select>

                    <h5 class="pt-3">Dados do Aluno</h5>
                    <hr>
                    <label for="student">Escolha o Aluno :</label>
                    <select id="student-email" name="student_id" required></select>
                    <input name="student_id" disabled type="hidden">
                    <h5 class="pt-3">Curso</h5>
                    <hr>
                    <label for="course_id">Selecione o Curso</label>
                    <select-course name="course_id" courseArchived="off"></select-course>

                    <input name="operation" value="create" type="hidden">
                    <div class="d-flex justify-content-start mt-3">
                        <button id="button-create-enrollment" class="btn btn-dark btn-sm mt-2">Cadastrar</button>
                    </div>
                </form>
            </div>
        </section>
       
    </main>
    <hr>

    <?php include_once 'include/footer.php' ?>
    <script type="module" src="/views/enrollments/forms/index.js"></script>
</body>

</html>