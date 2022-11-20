<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/livros'); ?>"><?= NOME_APP; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="<?= base_url('livros'); ?>">Livros</a>
        </li>
      </ul>
    </div>
    <div class="nav-item d-flex">
      <ul class="nav">
        <li class="nav-item p-1"><a href="<?= base_url('auth/sigin'); ?>" class="nav-link text-white px-2 btn btn-primary">Entrar</a></li>
        <li class="nav-item p-1"><a href="<?= base_url('auth/registration'); ?>" class="nav-link text-white btn btn-primary px-2">Registrar como doador</a></li>
      </ul>
    </div>
  </div>
</nav>