<div class="container-box-shadow">
    <h4>Cursos</h4>
    <form id="course-create">
        <label for="">Nome Do Curso</label>
        <input class="form-control mb-2" type="text" name="title" placeholder="Ex: Biologia..." required>

        <label for="">Duração do Curso (Meses)</label>
        <input class="form-control mb-2" type="text" name="duration" min=1 placeholder="Ex: 24..." required>

        <label for="">Descrição do Curso</label>
        <textarea class="form-control" name="description"></textarea>
        <div class="d-flex justify-content-start">
            <button id="button-create-course" class="btn btn-dark btn-sm mt-2">Cadastrar</button>
        </div>
    </form>
</div>

<?php startSection('scripts'); ?>
<script type="module" src="/views/courses/forms/index.js"></script>
<?php endSection('scripts'); ?>