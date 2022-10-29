<!-- Mensagens de erro -->
<?php if (!empty(session()->getFlashdata('fail'))) : ?>
    <div class='alert alert-danger'><?= session()->getFlashdata('fail'); ?></div>
<?php endif ?>

<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class='alert alert-success'><?= session()->getFlashdata('success'); ?></div>
<?php endif ?>
<!-- Fim de mensagens de erro -->
<!-- Listagem contatos -->
<section class="listagem-section p-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tab-disponivel" type="button" role="tab" aria-controls="tab-disponivel" aria-selected="true"><span class="text-black">Novos contatos</span></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tab-respondido" type="button" role="tab" aria-controls="tab-respondido" aria-selected="false"><span class="text-black">Contatos respondidos</span></button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tab-disponivel" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <ul class="list-group lista-contatos">
                <?php
                if ($qtde_msgs_disponiveis == 0) {
                    echo '<h3>Nenhuma mensagem ainda.</h3>';
                } else {
                    foreach ($info_msgs as $msgs) {
                        if ($msgs['respondido'] == 0) { ?>

                            <li class="list-group-item list-group-item-action flex-column align-items-start p-3 item-animal">
                                <div class="d-flex">
                                    <div class="dados-animal col-12 d-flex align-items-center">
                                        <div class="conteudo col-12 p-3">
                                            <div class="d-flex w-100 justify-content-between pt-2">
                                                <div class="texto col-9">
                                                    <p class="mb-1"><strong>Nome:</strong> <?= $msgs['nome']; ?></p>
                                                    <p class="mb-1"><strong>Livro:</strong> <?= $msgs['livro']; ?></p>
                                                    <p class="mb-1"><strong>Email:</strong> <?= $msgs['email']; ?></p>
                                                    <p class="mb-1"><strong>Telefone:</strong> <?= $msgs['telefone']; ?></p>
                                                    <p class="mb-1"><strong>Mensagem:</strong> <?= $msgs['mensagem']; ?></p>
                                                </div>
                                                <div class="botao d-grid col-3">
                                                    <div class="form1 d-grid">
                                                        <?php
                                                        if (intval($msgs['respondido']) == 1) { ?>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <p class="btn btn-primary">Respondido!</p>
                                                            </div>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <form class="" action="<?= base_url('mensagens/excluir'); ?>" method="POST">
                                                                    <input type="hidden" name="id-mensagem" value="<?= $msgs['id']; ?>">
                                                                    <input type="submit" value="Excluir" class="btn btn-warning" style="margin-bottom: 10px;">
                                                                </form>
                                                            </div>
                                                        <?php } else {
                                                        ?>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <form action="<?= base_url('mensagens/marcar-respondido'); ?>" method="POST">
                                                                    <input type="hidden" name="id-mensagem" value="<?= $msgs['id']; ?>">
                                                                    <input type="submit" value="Marcar como respondido" class="btn btn-warning" style="margin-bottom: 10px;">
                                                                </form>
                                                            </div>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <form class="" action="<?= base_url('mensagens/excluir'); ?>" method="POST">
                                                                    <input type="hidden" name="id-mensagem" value="<?= $msgs['id']; ?>">
                                                                    <input type="submit" value="Excluir" class="btn btn-warning" style="margin-bottom: 10px;">
                                                                </form>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                <?php }
                    }
                } ?>
            </ul>
        </div>
        <div class="tab-pane fade" id="tab-respondido" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

            <ul class="list-group lista-contatos">
                <?php if ($qtde_msgs_respondidos == 0) {
                    echo '<h3>Nenhuma mensagem respondida.</h3>';
                } else {
                    foreach ($info_msgs as $msgs) { ?>
                        <?php if ($msgs['respondido'] == 1) { ?>
                            <li class="list-group-item list-group-item-action flex-column align-items-start p-3 item-animal">
                                <div class="d-flex">
                                    <div class="dados-animal col-12 d-flex align-items-center">
                                        <div class="conteudo col-12 p-3">
                                            <div class="d-flex w-100 justify-content-between pt-2">
                                                <div class="texto col-9">
                                                    <p class="mb-1"><strong>Nome:</strong> <?= $msgs['nome']; ?></p>
                                                    <p class="mb-1"><strong>Livro:</strong> <?= $msgs['livro']; ?></p>
                                                    <p class="mb-1"><strong>Email:</strong> <?= $msgs['email']; ?></p>
                                                    <p class="mb-1"><strong>Telefone:</strong> <?= $msgs['telefone']; ?></p>
                                                    <p class="mb-1"><strong>Mensagem:</strong> <?= $msgs['mensagem']; ?></p>
                                                </div>
                                                <div class="botao d-grid col-3">
                                                    <div class="form1 d-grid">
                                                        <?php
                                                        if (intval($msgs['respondido']) == 1) { ?>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <p class="btn btn-primary">Respondido!</p>
                                                            </div>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <form class="" action="<?= base_url('mensagens/excluir'); ?>" method="POST">
                                                                    <input type="hidden" name="id-mensagem" value="<?= $msgs['id']; ?>">
                                                                    <input type="submit" value="Excluir" class="btn btn-warning" style="margin-bottom: 10px;">
                                                                </form>
                                                            </div>
                                                        <?php } else {
                                                        ?>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <form action="<?= base_url('mensagens/marcar-respondido'); ?>" method="POST">
                                                                    <input type="hidden" name="id-mensagem" value="<?= $msgs['id']; ?>">
                                                                    <input type="submit" value="Marcar como respondido" class="btn btn-warning" style="margin-bottom: 10px;">
                                                                </form>
                                                            </div>
                                                            <div class="form1 d-flex justify-content-end">
                                                                <form class="" action="<?= base_url('mensagens/excluir'); ?>" method="POST">
                                                                    <input type="hidden" name="id-mensagem" value="<?= $msgs['id']; ?>">
                                                                    <input type="submit" value="Excluir" class="btn btn-warning" style="margin-bottom: 10px;">
                                                                </form>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                <?php }
                    }
                } ?>
            </ul>
        </div>
    </div>
</section>

<!-- Fim da listagem contatos -->