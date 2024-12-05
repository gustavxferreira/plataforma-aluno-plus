<div class="container pt-3">
    <h4 class="text-center">Gerenciar Matrículas</h4>
    <a href="matriculas/criar"><button class="btn btn-dark btn-sm mb-2">Cadastrar Matrículas</button></a>
    <div class="mt-3 d-flex justify-content-center gap-2">

        <select class="border border-dark rounded" id="status-enrollment-filter">
            <option selected value="all">Todos Status</option>
            <option value="active">Ativa</option>
            <option value="inactive">Inativa</option>
            <option value="suspended">Suspensa</option>
        </select>
        <select-course showAllOption="on" courseArchived="on"></select-course>
        <button id="apply-enrollment-filter" class="btn btn-dark btn-sm">Aplicar Filtros</button>
        <br>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        <search-bar id="search-bar-id" table="table-enrollments" columns=[1,2,3,4,5,6]></search-bar>
    </div>

    <div class="table-responsive">
        <table id="table-enrollments" class="table table-striped table-hover text-center">
            <thead>
                <tr class="text-left">
                    <td id="result-quantity"></td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <th scope="col">Nº Matrícula</th>
                    <th scope="col">Data da Matrícula</th>
                    <th scope="col">Nome do Aluno</th>
                    <th scope="col">Email do Aluno</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Status</th>
                    <th scope="col">Alterar</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<?php startSection('scripts'); ?>
<script type="module" src="/views/enrollments/index.js"></script>
<?php endSection('scripts'); ?>