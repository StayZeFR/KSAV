INSERT INTO modelevoyage(IDTYPEVOYAGE, NOM, DESCRIPTION, DESTINATION, TOUROPERATOR) 
VALUES ("2", "Allemagne", "Au cœur de Berlin - Un hôtel moderne - Des chambres confortables", "Berlin", "SalaünHolidaysTO"),
("3", "France", "Amateurs d'authenticité, laissez-vous tenter par ce séjour de 5 jours en Alsace.", "Alsace", "HolidaysTO"),
("1", "Bresil", "La Baie de Rio - Découverte de la flore et de la faune amazoniennes - Le charme colonial de Salvador de Bahia - Brasilia, la ville de tous les possibles.", "Rio", "TOHolidays");

INSERT INTO voyage(IDMODELEVOYAGE, DATEDEPART)
VALUES ("1", "2024-02-23"),
("1", "2023-04-13"),
("2", "2023-04-12"),
("2", "2023-03-03"),
("3", "2023-07-10"),
("3", "2023-11-20");

INSERT INTO client(NOM, PRENOM, ADRESSE, EMAIL, TEL)
VALUES ("BERTRAND", "Pauline", "", "pauline.bertrand.461@gmail.com", "0752415475"),
("BLANDIN", "Ilann", "", "iblandin@gmail.com", "0685241547"),
("BLEE", "Leny", "rue du chateau", "lblee@gmail.com", "0685958474");


INSERT INTO `avis` (`IDAVIS`, `POINTSPOSITIFS`, `POINTSNEGATIFS`, `DATEAVIS`) VALUES
(1, 'Très bonne destination, à conseiller !', 'Quelques bruits la nuit dans l\'hotel', '2023-11-30'),
(2, '', '', '2023-11-30'),
(3, 'De très beaux paysages', 'Enormément de moustiques', '2023-11-30'),
(4, 'J\'ai adoré', '', '2023-11-30'),
(5, 'De très bonnes rencontres', 'Beaucoup de population dans les villes, un peu trop', '2023-11-30'),
(6, 'Incroyable voyage', '', '2023-11-30');

INSERT INTO `reservation` (`IDRESERVATION`, `IDVOYAGE`, `IDCLIENT`, `IDAVIS`) VALUES
('41254', 1, 1, 1),
('71452', 2, 2, 2),
('74125', 5, 3, 3),
('45689', 3, 1, 4),
('41253', 4, 2, 5),
('74152', 6, 3, 6);

INSERT INTO `posseder` (`IDPRESTATION`, `IDMODELEVOYAGE`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 2),
(6, 1),
(6, 3),
(7, 1),
(8, 2),
(10, 3);

INSERT INTO `note` (`IDPRESTATION`, `IDAVIS`, `NOTE`) VALUES
(1, 1, '3'),
(2, 1, '1'),
(3, 1, '3'),
(4, 1, '2'),
(6, 1, '3'),
(7, 1, '2'),
(1, 2, '3'),
(2, 2, '3'),
(3, 2, '2'),
(4, 2, '2'),
(6, 2, '1'),
(7, 2, '3'),
(2, 3, '3'),
(3, 3, '3'),
(6, 3, '1'),
(10, 3, '2'),
(2, 4, '2'),
(3, 4, '3'),
(4, 4, '2'),
(5, 4, '3'),
(8, 4, '1'),
(2, 5, '3'),
(3, 5, '3'),
(4, 5, '2'),
(5, 5, '2'),
(8, 5, '1'),
(2, 6, '1'),
(3, 6, '3'),
(6, 6, '3'),
(10, 6, '2'); 