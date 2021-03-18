CREATE DATABASE receita COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(60) NOT NULL,
    senha CHAR(60) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE receitas (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(80) NOT NULL,
    tempo VARCHAR(20) NOT NULL,
    ingrediente TEXT NOT NULL,
    preparo TEXT NOT NULL,
    data_receita TIMESTAMP,
    usuario_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)
ENGINE = InnoDB;

CREATE TABLE curtidas (
    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    receita_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ,
    FOREIGN KEY (receita_id) REFERENCES receitas(id) 
)
ENGINE = InnoDB;

INSERT INTO usuarios (email, senha) 
VALUES ('admin@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q');
