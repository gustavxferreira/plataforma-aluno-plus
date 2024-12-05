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
<?php startSection('scripts'); ?>
<script type="module" src="/views/courses/edit/index.js"></script>
<?php endSection('scripts'); ?>