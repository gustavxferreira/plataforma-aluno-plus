<div class="container pt-3">
    <h4 class="text-center">Gerenciar Cursos</h4>
    <a href="cursos/criar"><button class="btn btn-dark btn-sm mb-2">Cadastrar Cursos</button></a>
    <div class="mt-3 d-flex justify-content-center">
        <search-bar id="search-bar-id" table="table-courses" columns=[1]></search-bar>
    </div>
    <div class="table-responsive">
        <table id="table-courses" class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Duração (Meses)</th>
                    <th scope="col">Status</th>
                    <th scope="col">Alterar</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
</div>
<?php startSection('scripts'); ?>
<script type="module" src="/views/courses/index.js"></script>
<?php endSection('scripts'); ?>