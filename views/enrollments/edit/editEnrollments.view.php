<div class="container-box-shadow">
    <div class="d-flex flex-row justify-content-between">
        <h4>Editar Matrícula</h4>
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-confirm">Deletar</button>
    </div>

    <form id="enrollment-edit">
        <input id="enrollment-id" type="hidden">

        <h5 class="pt-3">Dados Matrícula</h5>
        <hr>
        <label for="">Nº Matrícula</label>
        <input value="" id="enrollment-code" class="form-control mb-2" disabled>

        <label for="enrollment_date">Data de Inicio Da Matrícula</label>
        <input type="date" value="" id="edit-enrollment-date" name="enrollment_date" class="form-control mb-2" required>

        <label for="status">Status da Matrícula</label>
        <select class="form-control" name="status" id="edit-status">
            <option value="active">Ativa</option>
            <option value="inactive">Inativa</option>
            <option value="suspended">Suspensa</option>
        </select>

        <h5 class="pt-3">Dados do Aluno</h5>
        <hr>
        <label for="">Nome Do Aluno</label>
        <input value="" id="student-name" class="form-control mb-2" disabled>

        <label for="">Data de Nascimento</label>
        <input value="" id="birthdate" class="form-control mb-2" disabled>

        <label for="">Email</label>
        <input value="" id="email" class="form-control mb-2" disabled>

        <h5 class="pt-3">Dados do Curso</h5>
        <hr>

        <label for="">Nome do Curso</label>
        <input value="" id="course-title" class="form-control mb-2" disabled>

        <label for="">Duração do Curso (Meses)</label>
        <input value="" id="duration" class="form-control mb-2" disabled>

        <input name="operation" value="edit" type="hidden">
        <div class="d-flex justify-content-start">
            <button id="button-edit-enrollment" class="btn btn-dark btn-sm mt-2">Salvar Alterações</button>
        </div>
    </form>
</div>
<div class="modal fade" id="delete-confirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Confirmar Exclusão</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center gap-3">
                    <p>Esta ação é irreversível, deseja mesmo excluir?.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button id="delete-enrollment" type="button" class="btn btn-danger btn-sm">Deletar</button>
            </div>
        </div>
    </div>
</div>
<?php startSection('scripts'); ?>
<script type="module" src="/views/enrollments/edit/index.js"></script>
<?php endSection('scripts'); ?>