SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `DBCasamento` ;
CREATE SCHEMA IF NOT EXISTS `DBCasamento` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `DBCasamento` ;

-- -----------------------------------------------------
-- Table `DBCasamento`.`Categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Categoria` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT ,
  `Descricao` VARCHAR(100) NULL ,
  PRIMARY KEY (`idCategoria`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Item` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Item` (
  `idItem` INT NOT NULL AUTO_INCREMENT ,
  `Descricao` VARCHAR(100) NULL ,
  `FK_idCategoria` INT NOT NULL ,
  PRIMARY KEY (`idItem`, `FK_idCategoria`) ,
  INDEX `fk_Item_Categoria_idx` (`FK_idCategoria` ASC) ,
  CONSTRAINT `fk_Item_Categoria`
    FOREIGN KEY (`FK_idCategoria` )
    REFERENCES `DBCasamento`.`Categoria` (`idCategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Usuario` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT ,
  `EMail` VARCHAR(150) NULL ,
  `Senha` VARCHAR(100) NULL ,
  `Nome` VARCHAR(100) NULL ,
  `Perfil` VARCHAR(1) NULL DEFAULT '1' COMMENT '0- Administrador\\n1- Noivos\\n2- Cerinomialista/Assessoria' ,
  `Confirmado` TINYINT(1) NULL DEFAULT 0 ,
  PRIMARY KEY (`idUsuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Casamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Casamento` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Casamento` (
  `idCasamento` INT NOT NULL AUTO_INCREMENT ,
  `Noiva` INT NULL ,
  `Noivo` INT NULL ,
  `Cerimonial` INT NULL ,
  `DataCasamento` DATE NULL ,
  PRIMARY KEY (`idCasamento`) ,
  INDEX `fkNoivaUsuario_idx` (`Noiva` ASC) ,
  INDEX `fkNoivoUsuario_idx` (`Noivo` ASC) ,
  INDEX `fkCerimonialUsuario_idx` (`Cerimonial` ASC) ,
  CONSTRAINT `fkNoivaUsuario`
    FOREIGN KEY (`Noiva` )
    REFERENCES `DBCasamento`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkNoivoUsuario`
    FOREIGN KEY (`Noivo` )
    REFERENCES `DBCasamento`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkCerimonialUsuario`
    FOREIGN KEY (`Cerimonial` )
    REFERENCES `DBCasamento`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Planejamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Planejamento` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Planejamento` (
  `idPlanejamento` INT NOT NULL AUTO_INCREMENT ,
  `TotalPrevisto` DOUBLE NULL ,
  `TotalRealizado` DOUBLE NULL ,
  `TotalPago` DOUBLE NULL ,
  `SaldoDevedor` DOUBLE NULL ,
  `Percentual` DOUBLE NULL ,
  `FK_idCasamento` INT NOT NULL ,
  PRIMARY KEY (`idPlanejamento`, `FK_idCasamento`) ,
  INDEX `fk_Planejamento_Casamento1_idx` (`FK_idCasamento` ASC) ,
  CONSTRAINT `fk_Planejamento_Casamento1`
    FOREIGN KEY (`FK_idCasamento` )
    REFERENCES `DBCasamento`.`Casamento` (`idCasamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Fornecedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Fornecedor` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Fornecedor` (
  `idFornecedores` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(100) NULL ,
  `Telefone` VARCHAR(15) NULL ,
  `Celular` VARCHAR(15) NULL ,
  `Responsável` VARCHAR(100) NULL ,
  `Endereco` VARCHAR(100) NULL ,
  `Site` VARCHAR(150) NULL ,
  `EMail` VARCHAR(150) NULL ,
  PRIMARY KEY (`idFornecedores`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`ItemPlanejamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`ItemPlanejamento` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`ItemPlanejamento` (
  `FK_idItem` INT NOT NULL ,
  `FK_idPlanejamento` INT NOT NULL ,
  `ValorPrevisto` DOUBLE NULL ,
  `ValorRealizado` DOUBLE NULL ,
  `ValorPago` DOUBLE NULL ,
  `Percentual` DOUBLE NULL ,
  `SaldoDevedor` DOUBLE NULL ,
  `FK_idFornecedor` INT NOT NULL ,
  `DataExecucao` DATE NULL ,
  `FormaPagamento` VARCHAR(1) NULL DEFAULT 'V' COMMENT 'V- Vista\\nP- Prazo' ,
  PRIMARY KEY (`FK_idItem`, `FK_idPlanejamento`) ,
  INDEX `fk_Item_has_Planejamento_Planejamento1_idx` (`FK_idPlanejamento` ASC) ,
  INDEX `fk_Item_has_Planejamento_Item1_idx` (`FK_idItem` ASC) ,
  INDEX `fk_ItemPlanejamento_Fornecedores1_idx` (`FK_idFornecedor` ASC) ,
  CONSTRAINT `fk_Item_has_Planejamento_Item1`
    FOREIGN KEY (`FK_idItem` )
    REFERENCES `DBCasamento`.`Item` (`idItem` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_has_Planejamento_Planejamento1`
    FOREIGN KEY (`FK_idPlanejamento` )
    REFERENCES `DBCasamento`.`Planejamento` (`idPlanejamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ItemPlanejamento_Fornecedores1`
    FOREIGN KEY (`FK_idFornecedor` )
    REFERENCES `DBCasamento`.`Fornecedor` (`idFornecedores` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Convite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Convite` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Convite` (
  `idConvite` INT NOT NULL AUTO_INCREMENT ,
  `Entregue` TINYINT(1) NULL DEFAULT 0 ,
  `Confirmado` TINYINT(1) NULL DEFAULT 0 ,
  `Compareceu` TINYINT(1) NULL DEFAULT 0 ,
  `Categoria` VARCHAR(1) NULL DEFAULT 0 COMMENT '0- Não Definido\\n1- Família Noiva\\n2- Família Noivo\\n3- Amigo Noiva\\n4- Amigo Noivo\\n5- Amigo Comum\\n6- Outros' ,
  `NomeConvite` VARCHAR(100) NULL ,
  `NumeroConvidados` INT NULL ,
  `FK_idCasamento` INT NOT NULL ,
  PRIMARY KEY (`idConvite`, `FK_idCasamento`) ,
  INDEX `fk_Convite_Casamento1_idx` (`FK_idCasamento` ASC) ,
  CONSTRAINT `fk_Convite_Casamento1`
    FOREIGN KEY (`FK_idCasamento` )
    REFERENCES `DBCasamento`.`Casamento` (`idCasamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Cidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Cidade` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Cidade` (
  `idCidade` INT NOT NULL ,
  `Nome` VARCHAR(100) NULL ,
  `UF` VARCHAR(2) NULL ,
  PRIMARY KEY (`idCidade`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Convidado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Convidado` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Convidado` (
  `idConvidado` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(100) NULL ,
  `Telefone` VARCHAR(15) NULL ,
  `Celular` VARCHAR(15) NULL ,
  `EMail` VARCHAR(150) NULL ,
  `Endereco` VARCHAR(150) NULL ,
  `Cidade` INT NULL ,
  `Bairro` VARCHAR(100) NULL ,
  `CEP` VARCHAR(9) NULL ,
  `FK_idConvite` INT NOT NULL ,
  PRIMARY KEY (`idConvidado`, `FK_idConvite`) ,
  INDEX `fk_Convidado_Convite1_idx` (`FK_idConvite` ASC) ,
  INDEX `fkConvidadeCidade_idx` (`Cidade` ASC) ,
  CONSTRAINT `fk_Convidado_Convite1`
    FOREIGN KEY (`FK_idConvite` )
    REFERENCES `DBCasamento`.`Convite` (`idConvite` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkConvidadeCidade`
    FOREIGN KEY (`Cidade` )
    REFERENCES `DBCasamento`.`Cidade` (`idCidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBCasamento`.`Pagamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DBCasamento`.`Pagamento` ;

CREATE  TABLE IF NOT EXISTS `DBCasamento`.`Pagamento` (
  `idPagamento` INT NOT NULL AUTO_INCREMENT ,
  `Data` DATE NULL ,
  `Valor` TINYINT(1) NULL ,
  `FK_idItem` INT NOT NULL ,
  `FK_idPlanejamento` INT NOT NULL ,
  PRIMARY KEY (`idPagamento`, `FK_idItem`, `FK_idPlanejamento`) ,
  INDEX `fk_Pagamento_ItemPlanejamento1_idx` (`FK_idItem` ASC, `FK_idPlanejamento` ASC) ,
  CONSTRAINT `fk_Pagamento_ItemPlanejamento1`
    FOREIGN KEY (`FK_idItem` , `FK_idPlanejamento` )
    REFERENCES `DBCasamento`.`ItemPlanejamento` (`FK_idItem` , `FK_idPlanejamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
