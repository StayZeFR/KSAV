INSERT INTO typevoyage (LIBELLE, DESCRIPTION) VALUES ("Circuit", ""),
    ("Séjour", ""),
    ("Croisière", "");
INSERT INTO prestation (LIBELLE, DESCRIPTION) VALUES ("Transfert", ""),
    ("Hotel", ""),
    ("Restaurant", ""),
    ("Service/Accueil", ""),
    ("Animation", ""),
    ("Excursions/Guide", ""),
    ("Transport aerien", ""),
    ("Transport car", ""),
    ("Thalasso/SPA", ""),
    ("Croisiere", "");
INSERT INTO role (IDROLE, LIBELLE) VALUES (1, "admin"), (2, "utilisateur");
INSERT INTO utilisateur (PSEUDO, NOM, PRENOM, MDP, IDROLE, SEXE, DATECREATION) VALUES ("admin.admin", "admin", "admin", "$2y$10$cKD52jszt5utE1ozipFsMOzbqRqYmjQCi0w1j/XIsdkylmrp7uZ82", 1, 0, NOW());