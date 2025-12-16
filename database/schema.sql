DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS categorie;

CREATE TABLE categorie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE contact (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  telephone VARCHAR(30) NOT NULL,
  categorie_id INT NULL,
  CONSTRAINT fk_contact_categorie
    FOREIGN KEY (categorie_id) REFERENCES categorie(id)
    ON DELETE SET NULL ON UPDATE CASCADE,
  UNIQUE KEY uq_contact_email (email),
  INDEX idx_contact_categorie (categorie_id),
  INDEX idx_contact_nom_prenom (nom, prenom)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
