<!-- Conteudo visível relevante vai dentro da main -->

<section class="listagem-section p-3">
    <!-- Mensagens de erro -->
    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div class='alert alert-danger'><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div class='alert alert-success'><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
    <!-- Fim de mensagens de erro -->
    <ul class="list-group lista-livros">
        <?php
        if (!$livros) {
            echo '<p>Nenhum livro disponível para doação.</p>';
        } else {
        ?>
            <?php if (isset($_GET['buscar'])) echo "<h3>Pesquisa para <strong>" . $_GET['buscar'] . "</strong></h3>"; ?>
            <h1>Livros</h1>
            <?php foreach ($livros as $livro) { ?>
                <li class="list-group-item list-group-item-action flex-column align-items-start p-3 item-animal">
                    <div class="d-flex">
                        <div class="img-animal col-2 d-flex  justify-content-center">
                            <img src="<?= $livro['url_img']; ?>" alt="Livro <?= $livro['nome']; ?>" class="img-fluid" style="border-radius: 10px; max-height: 150px;">
                        </div>
                        <div class="dados-animal col-10 d-flex align-items-center">
                            <div class="conteudo col-12 p-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h2 class="mb-1"><?= $livro['nome']; ?> - <?= $livro['edicao']; ?>° edição</h2>
                                    <small class="badge bg-dark text-white"><?= $livro['ano']; ?></small>
                                </div>
                                <div class="d-flex w-100 justify-content-between pt-2">
                                    <div class="texto">
                                        <p class="mb-1"><strong>Autor:</strong> <?= $livro['autor']; ?></p>
                                        <p class="mb-1"><strong>Editora:</strong> <?= $livro['editora']; ?></p>
                                        <p class="mb-1"><strong>Doador:</strong> <?= $livro['nome_usuario']; ?></p>
                                        <p class="mb-1"><strong>Local para buscar livro: </strong><?= $livro['cidade']; ?>-<?= $livro['estado']; ?></p>
                                    </div>
                                    <div class="botao d-flex align-items-end flex-column">
                                        <p><strong><?= $livro['tema']; ?></strong></p>
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#livro-<?= $livro['id']; ?>">
                                            Entrar em contato
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
        <?php }
        } ?>
    </ul>
</section>

<!-- Conteudo visível relevante vai dentro da main -->

<!-- Aqui será renderizado os modais -->
<?php foreach ($livros as $livro) { ?>
    <div class="modal fade" id="livro-<?= $livro['id']; ?>" tabindex="-1" aria-labelledby="livroLabel-<?= $livro['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="" action="<?= base_url('salva-contato'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <p class="modal-title" id="livroLabel-<?= $livro['id']; ?>">Interesse no livro <?= $livro['nome']; ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Entre em contato com <strong><?= $livro['nome_usuario']; ?></strong></p>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nome" name="nome" aria-describedby="Nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telefone" name="telefone" aria-describedby="telefone" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Dúvidas ou observações</label>
                            <textarea class="form-control" aria-label="mensagem" id="mensagem" name="mensagem" maxlength="255"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="id_usuario" value="<?= $livro['id_usuario']; ?>">
                            <input type="hidden" name="nome_livro" value="<?= $livro['nome']; ?>">
                            <input type="submit" class="btn btn-primary" value="Enviar contato">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Aqui será renderizado os modais -->