<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/livros'); ?>"><?= NOME_APP; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="<?= base_url('dashboard/livros'); ?>">Meus livros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= base_url('dashboard/contatos'); ?>">Meus contatos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" target="_blank" href="<?= base_url('livros'); ?>">Todos os livros</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown d-block d-sm-none">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Minha conta
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li class="nav-item"><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="nav-item">
      <ul class="navbar-nav d-none d-sm-block">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Minha conta
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
            <li class="nav-item"><a class=" dropdown-item" href="<?= base_url('auth/logout'); ?>">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>