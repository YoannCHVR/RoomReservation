SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `chambres` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `prix` int(11) DEFAULT NULL,
  `id_lit` int(11) DEFAULT NULL,
  `id_standing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `chambres` (`id`, `nom`, `description`, `prix`, `id_lit`, `id_standing`) VALUES
(1, 'Chambord', 'En plein milieu du parc, vivez au plus près dela nature', 250, 2, 3),
(2, 'Blois', 'En plein centre ville, découvrer la vieille cité médiévale', 200, 2, 2),
(3, 'Affaire', 'Pour vos déplacements à la rencontre de vos clients grand compte, chambre tout confort', 220, 2, 3),
(4, 'Business', 'Pour vos rdv client hors de votre région', 150, 1, 2),
(5, 'Sémianaires', 'Pour les séminaires d\'entreprise', 80, 3, 1);

CREATE TABLE `lit` (
  `id` int(11) NOT NULL,
  `lit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lit` (`id`, `lit`) VALUES
(1, 'Petit lit'),
(2, 'Grand lit'),
(3, 'Lits superposés');

CREATE TABLE `standing` (
  `id` int(11) NOT NULL,
  `standing` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `standing` (`id`, `standing`) VALUES
(1, 'Basique'),
(2, 'Comfort'),
(3, 'Luxe');


ALTER TABLE `chambres`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lit`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `standing`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `chambres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `lit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `standing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;SET FOREIGN_KEY_CHECKS=1;
