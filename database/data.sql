INSERT INTO categorie (libelle) VALUES
('Famille'),('Amis'),('Travail'),('Prospects'),('Partenaires');

INSERT INTO contact (nom, prenom, email, telephone, categorie_id) VALUES
('Martin','Julie','julie.martin@example.test','+33 6 11 22 33 44',1),
('Durand','Paul','paul.durand@example.test','+33 6 22 33 44 55',2),
('Bernard','Sofia','sofia.bernard@example.test','+33 6 33 44 55 66',3),
('Petit','Hugo','hugo.petit@example.test','+33 6 44 55 66 77',3),
('Robert','Emma','emma.robert@example.test','+33 6 55 66 77 88',4),
('Richard','Nina','nina.richard@example.test','+33 6 66 77 88 99',4),
('Moreau','Leo','leo.moreau@example.test','+33 6 77 88 99 00',5),
('Fournier','Ines','ines.fournier@example.test','+33 6 88 99 00 11',NULL),
('Girard','Tom','tom.girard@example.test','+33 6 99 00 11 22',2),
('Lefevre','Sarah','sarah.lefevre@example.test','+33 7 01 02 03 04',1),
('Roux','Mehdi','mehdi.roux@example.test','+33 7 05 06 07 08',5),
('Blanc','Clara','clara.blanc@example.test','+33 7 09 10 11 12',3);
