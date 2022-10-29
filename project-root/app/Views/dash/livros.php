<!-- Mensagens de erro -->
<?php if (!empty(session()->getFlashdata('fail'))) : ?>
    <div class='alert alert-danger'><?= session()->getFlashdata('fail'); ?></div>
<?php endif ?>

<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class='alert alert-success'><?= session()->getFlashdata('success'); ?></div>
<?php endif ?>
<!-- Fim de mensagens de erro -->
<div class="py-3 mb-4 border-bottom">
    <div class="container-fluid">
        <div class="container d-flex flex-wrap justify-content-center">
            <div class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <span class="fs-4"><?= $title; ?></span>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Adicionar livro
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar novo livro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="" action="<?= base_url('livros/salvar'); ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="nome">Nome do livro<span class="text-danger">*</span></label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="<?= set_value('nome'); ?>" required>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="autor">Autor<span class="text-danger">*</span></label>
                                            <input type="text" id="autor" name="autor" class="form-control" value="<?= set_value('autor'); ?>" required>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="editora">Editora<span class="text-danger">*</span></label>
                                            <input type="text" id="editora" name="editora" class="form-control" value="<?= set_value('editora'); ?>" required>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="edicao">Edição<span class="text-danger">*</span></label>
                                            <input type="number" id="edicao" name="edicao" class="form-control" value="<?= set_value('edicao'); ?>" required>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="ano">Ano<span class="text-danger">*</span></label>
                                            <input type="number" id="ano" name="ano" class="form-control" value="<?= set_value('ano'); ?>" required>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="ano">Tema<span class="text-danger">*</span></label>
                                            <select class="form-select" name="tema">
                                                <option value="Português">Português</option>
                                                <option value="Matemática">Matemática</option>
                                                <option value="Literatura">Literatura</option>
                                                <option value="Química">Química</option>
                                                <option value="Física">Física</option>
                                                <option value="Inglês">Inglês</option>
                                                <option value="Literatura">Literatura</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="ano">Estado do livro<span class="text-danger">*</span></label>
                                            <select class="form-select" name="estado">
                                                <option value=1>Novo</option>
                                                <option value=2>Usado</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="img">Foto<span class="text-danger">*</span></label>
                                            <?= form_open_multipart('upload/upload') ?>
                                            <input type="file" accept=".png, .jpg, .jpeg" id=" img" name="img" class="form-control" value="<?= set_value('img'); ?>" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cadastrar novo livro</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Listagem livros -->

<section class="listagem-section p-3">
    <?php
    if (!$info_livros) {
        echo '<p>Nenhum livro adicionado.</p>';
    } else { ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Edição</th>
                        <th scope="col">Tema</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($info_livros as $livro) { ?>
                        <tr>
                            <td>
                                <?= $livro['url_img'] ? '<img width=50 class="img-fluid"src="' . $livro['url_img'] . '"/>' : ''; ?>
                                <?= $livro['nome']; ?>
                            </td>
                            <td>
                                <?= $livro['autor']; ?>
                            </td>
                            <td>
                                <?= $livro['editora']; ?>
                            </td>
                            <td>
                                <?= $livro['edicao']; ?>
                            </td>
                            <td>
                                <?= $livro['tema']; ?>
                            </td>
                            <td>
                                <?= $livro['ano']; ?>
                            </td>
                            <td>
                                <?= $livro['novo'] == 1 ? 'Usado' : 'Novo'; ?>
                            </td>
                            <td>
                                <form class="" action="<?= base_url('livros/excluir'); ?>" method="POST">
                                    <input type="hidden" name="id_livro" value="<?= $livro['id']; ?>">
                                    <input type="submit" value="Excluir" class="btn btn-warning" style="margin-bottom: 10px;">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</section>

<!-- Fim da listagem livros -->