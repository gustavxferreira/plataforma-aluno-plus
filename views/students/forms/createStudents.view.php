<div class="container-box-shadow">
    <h4>Alunos</h4>
    <form id="student-create">
        <label for="">Nome Do Aluno</label>
        <input class="form-control mb-2" type="text" name="name" placeholder="Ex: Joao Silva..." required>

        <label for="">Email</label>
        <input class="form-control mb-2" type="email" name="email" required>

        <label for="">Data de Nascimento</label>
        <input class="form-control mb-2" type="date" name="birthdate" min=1950-01-01 placeholder="Ex: 19/01/2005" required>

        <input name="operation" value="create" type="hidden">
        <div class="d-flex justify-content-start">
            <button id="button-create-student" class="btn btn-dark btn-sm mt-2">Cadastrar</button>
        </div>
    </form>
</div>

<?php startSection('scripts'); ?>
<script type="module" src="/views/students/forms/index.js"></script>
<?php endSection('scripts'); ?>