<section class="content-section-registration col-12 m-3 d-flex aligns-items-center justify-content-center">
    <div class="content-form-registration col-md-5 p-3 border rounded-3 align-self-center bg-white">
        <h1 class="text-center">Registro</h1>
        <div class="spacing-30"></div>
        <form class="" action="<?= base_url('auth/save-registration'); ?>" method="POST">
            <?= csrf_field(); ?>
            <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                <div class='alert alert-danger mt-1'><?= session()->getFlashdata('fail'); ?></div>
            <?php endif ?>

            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class='alert alert-success'><?= session()->getFlashdata('success'); ?></div>
            <?php endif ?>
            <div class="row mb-3">
                <label for="inputName" class="col-sm-3 col-form-label">Nome<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" id="inputName" name="name" class="form-control" value="<?= set_value('name'); ?>" required placeholder="Nome">
                    <?php
                    if (isset($validation) && display_errors_forms($validation, 'name') != '') {
                        echo '<div class="alert alert-danger mt-1">';
                        echo display_errors_forms($validation, 'name');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="email" value="<?= set_value('email'); ?>" class="form-control" id="inputEmail" name="email" required placeholder="Email">
                    <?php
                    if (isset($validation) && display_errors_forms($validation, 'email') != '') {
                        echo '<div class="alert alert-danger mt-1">';
                        echo display_errors_forms($validation, 'email');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputCity" class="col-sm-3 col-form-label">Cidade:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputCity" name="city" value="<?= set_value('city'); ?>" required placeholder="Cidade">
                    <?php
                    if (isset($validation) && display_errors_forms($validation, 'city') != '') {
                        echo '<div class="alert alert-danger mt-1">';
                        echo display_errors_forms($validation, 'city');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputState" class="col-sm-3 col-form-label">Estado:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select class="form-select" id="estado" name="state">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        <option value="EX">Estrangeiro</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputUniversity" class="col-sm-3 col-form-label">Universidade:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputUniversity" name="university" value="<?= set_value('university'); ?>" required placeholder="Universidade">
                </div>
            </div>
            <div class="row mb-3">
                <label for="campusUniversity" class="col-sm-3 col-form-label">Polo:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputCampusUniversity" name="campusUniversity" value="<?= set_value('campusUniversity'); ?>" required placeholder="Polo Universidade">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-3 col-form-label">Senha<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputPassword" name="password" required minlength="5" maxlength="12" placeholder="Senha">
                    <?php
                    if (isset($validation) && display_errors_forms($validation, 'password') != '') {
                        echo '<div class="alert alert-danger mt-1">';
                        echo display_errors_forms($validation, 'password');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword4" class="col-sm-3 col-form-label">Repetir senha<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputPassword4" name="password2" required minlength="5" maxlength="12" placeholder="Repetir senha">
                    <?php
                    if (isset($validation) && display_errors_forms($validation, 'password2') != '') {
                        echo '<div class="alert alert-danger mt-1">';
                        echo display_errors_forms($validation, 'password2');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Registrar como doador" />
                </div>
            </div>
            <div class="spacing-30"></div>
            <div class="row">
                <span class="text-center d-block">Já tenho conta</span>
                <a href="<?= base_url('auth/sigin'); ?>" class="d-block text-center">Entrar</a>
            </div>
        </form>
    </div>
</section>