CREATE SCHEMA IF NOT EXISTS `troca` DEFAULT CHARACTER SET utf8 ;
USE `troca` ;

-- -----------------------------------------------------
-- Table `troca`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `troca`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `universidade` VARCHAR(45) NOT NULL,
  `polo` VARCHAR(45) NOT NULL,
  `estado` CHAR(2) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `troca`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `troca`.`livros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `editora` VARCHAR(45) NOT NULL,
  `autor` VARCHAR(100) NOT NULL,
  `url_img` VARCHAR(255) NOT NULL,
  `tema` VARCHAR(45) NOT NULL,
  `edicao` SMALLINT NOT NULL,
  `ano` SMALLINT NOT NULL,
  `novo` TINYINT NOT NULL DEFAULT 0,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id`, `id_usuario`),
  INDEX `fk_livros_usuarios_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_livros_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `troca`.`usuarios` (`id`));


-- -----------------------------------------------------
-- Table `troca`.`mensagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `troca`.`mensagens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `livro` VARCHAR(100) NOT NULL,
  `respondido` TINYINT NOT NULL DEFAULT 0,
  `id_usuario` INT NOT NULL,
  `mensagem` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`, `id_usuario`),
  INDEX `fk_contatos_usuarios1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_contatos_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `troca`.`usuarios` (`id`));
