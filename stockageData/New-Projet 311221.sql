-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 31 déc. 2021 à 17:11
-- Version du serveur :  8.0.27-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `New-Projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `AffecterFigurineUF`
--

CREATE TABLE `AffecterFigurineUF` (
  `idAffectationFigurine` int NOT NULL,
  `id_Univers` int NOT NULL,
  `id_Faction` int NOT NULL,
  `id_Figurine` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `armes`
--

CREATE TABLE `armes` (
  `idArmes` int NOT NULL,
  `id_Univers` int NOT NULL DEFAULT '0',
  `id_Faction` int NOT NULL DEFAULT '0',
  `idCreateur` int NOT NULL,
  `nom` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `typeArme` tinyint(1) NOT NULL DEFAULT '0',
  `puissance` tinyint(1) NOT NULL DEFAULT '1',
  `maxRange` int NOT NULL DEFAULT '0',
  `surPuissance` tinyint(1) NOT NULL DEFAULT '0',
  `sort` tinyint(1) NOT NULL DEFAULT '0',
  `assaut` tinyint(1) NOT NULL DEFAULT '0',
  `couverture` tinyint(1) NOT NULL DEFAULT '0',
  `cadenceTir` tinyint NOT NULL DEFAULT '1',
  `lourd` tinyint(1) NOT NULL DEFAULT '0',
  `puissanceExplosif` tinyint(1) NOT NULL DEFAULT '0',
  `gabarit` tinyint(1) NOT NULL DEFAULT '0',
  `fixer` tinyint NOT NULL DEFAULT '0',
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `prix` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `armes`
--

INSERT INTO `armes` (`idArmes`, `id_Univers`, `id_Faction`, `idCreateur`, `nom`, `description`, `typeArme`, `puissance`, `maxRange`, `surPuissance`, `sort`, `assaut`, `couverture`, `cadenceTir`, `lourd`, `puissanceExplosif`, `gabarit`, `fixer`, `valide`, `prix`) VALUES
(52, 15, 24, 14, 'Vibro-Hache', 'Arme de puissance faite pour découper.', 0, 2, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1.088),
(54, 15, 25, 14, 'Vibro-Lame', 'Une arme énergétique sobre et élégeante.', 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1.138),
(55, 15, 25, 14, 'Fusil C12', 'Fusil d\'assaut compact des forces Tau.', 1, 2, 14, 1, 0, 1, 0, 1, 0, 0, 0, 1, 1, 1.54091),
(56, 15, 24, 14, 'K\'lach', 'Fusil d\'assaut bricoler Ork.', 1, 2, 14, 0, 0, 0, 1, 2, 0, 0, 0, 1, 1, 1.29058),
(57, 15, 26, 14, 'Fusil laser', 'Fusil laser de la garde impérial.', 1, 2, 16, 0, 0, 1, 1, 2, 0, 0, 0, 1, 1, 1.28985),
(58, 15, 26, 14, 'Grenade anti-personnelle', 'Grenade anti-personnelle simple.', 2, 1, 6, 0, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1.19488),
(59, 15, 26, 14, 'Canon', 'Canon lourd', 2, 1, 24, 0, 0, 0, 0, 1, 1, 2, 3, 1, 1, 2.39692),
(60, 17, 29, 14, 'Volubilis', 'Ce sort permet de créer des dommages sur une cible au contact du sorcier.', 0, 2, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1.39072),
(61, 15, 26, 14, 'Lance Grenade', 'Petit et compact, ce lance grenade propulse une charge explosive.', 2, 1, 12, 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `armesFigurine`
--

CREATE TABLE `armesFigurine` (
  `idDotation` int NOT NULL,
  `id_figurine_Dotation` int NOT NULL,
  `id_Arme_Dotation` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `armesRules`
--

CREATE TABLE `armesRules` (
  `idAffectation` int NOT NULL,
  `id_Armes` int NOT NULL,
  `id_Rules` int NOT NULL,
  `tauxRules` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `armesRules`
--

INSERT INTO `armesRules` (`idAffectation`, `id_Armes`, `id_Rules`, `tauxRules`) VALUES
(46, 52, 12, 1.1),
(47, 54, 13, 1.15),
(49, 57, 20, 1.1),
(50, 56, 12, 1.1),
(53, 56, 20, 1.1),
(54, 55, 20, 1.1),
(55, 58, 17, 1.15),
(57, 59, 14, 1.2),
(58, 59, 9, 1.25),
(59, 59, 17, 1.15),
(63, 60, 31, 1.04),
(64, 60, 26, 1.18),
(66, 61, 17, 1.15),
(67, 61, 17, 1.15),
(68, 61, 9, 1.25);

-- --------------------------------------------------------

--
-- Structure de la table `factions`
--

CREATE TABLE `factions` (
  `idFaction` int NOT NULL,
  `idCreateur` int NOT NULL,
  `idUnivers` int NOT NULL,
  `nomFaction` varchar(60) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `partager` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `factions`
--

INSERT INTO `factions` (`idFaction`, `idCreateur`, `idUnivers`, `nomFaction`, `valide`, `partager`) VALUES
(24, 14, 15, 'Ork', 1, 0),
(25, 14, 15, 'Tau', 1, 0),
(26, 14, 15, 'Garde Impérial', 1, 0),
(27, 14, 16, 'Les A', 1, 0),
(28, 14, 16, 'Les non A', 1, 0),
(29, 14, 17, 'Les sorciers', 1, 0),
(30, 14, 17, 'Les mangemorts', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `figurines`
--

CREATE TABLE `figurines` (
  `idFigurine` int NOT NULL,
  `id_User` int NOT NULL,
  `nomFigurine` varchar(60) NOT NULL,
  `description` text,
  `typeFigurine` tinyint(1) NOT NULL,
  `tailleFigurine` tinyint(1) NOT NULL,
  `DQM` tinyint(1) NOT NULL,
  `DC` tinyint(1) NOT NULL,
  `svg` tinyint(1) NOT NULL,
  `pdv` tinyint NOT NULL,
  `mouvement` tinyint NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `partager` tinyint(1) NOT NULL DEFAULT '0',
  `figurineFixer` tinyint(1) NOT NULL DEFAULT '0',
  `prix` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lore`
--

CREATE TABLE `lore` (
  `idLore` int NOT NULL,
  `idUnivers` int NOT NULL,
  `titreLore` varchar(60) NOT NULL,
  `texteLore` text NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `partager` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `lore`
--

INSERT INTO `lore` (`idLore`, `idUnivers`, `titreLore`, `texteLore`, `valide`, `partager`) VALUES
(20, 16, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec feugiat velit eu nisl elementum, quis finibus tellus cursus. Aliquam cursus, ipsum ut aliquam consequat, ante libero eleifend risus, in laoreet mi nisi in felis. Aenean ut finibus risus. Phasellus tincidunt venenatis nulla, ac faucibus lectus pulvinar at. Etiam risus enim, maximus a quam sed, malesuada finibus enim. Mauris nec erat ut dui sagittis volutpat at convallis libero. Nullam quis bibendum lectus. Nulla feugiat eros a ante tempor fringilla. Donec ac mauris a ligula placerat tincidunt.\r\n\r\nCurabitur et nulla blandit, fringilla velit eget, rutrum nunc. Proin convallis felis quis metus condimentum consequat. Integer malesuada magna vel nisi auctor varius. Quisque pulvinar tortor non magna semper, vitae mollis nunc fringilla. Aenean nec neque semper, placerat ex non, sodales neque. Nulla ac turpis blandit, mollis ligula ac, suscipit ex. Donec ultrices, arcu et ornare efficitur, massa ligula tincidunt urna, eget tempus nulla mauris vitae orci. Mauris feugiat blandit est, a maximus ipsum. Sed ornare ullamcorper eros id mattis. Nam aliquet eros convallis auctor ultricies. Integer non libero commodo, faucibus quam eget, ornare velit. In diam magna, aliquam et eros id, molestie malesuada sem. Nulla vel pulvinar velit, eu ultricies justo. Suspendisse sagittis mauris nisi. Praesent sed est in nunc tempor ullamcorper sagittis vitae nibh. Integer commodo, libero ut venenatis cursus, ex diam maximus orci, a consequat leo eros ut nunc.\r\n\r\nAliquam erat volutpat. Mauris a sem at lacus egestas interdum nec bibendum eros. Duis in eleifend magna. Nullam scelerisque mauris nec ligula hendrerit, quis bibendum turpis consequat. Donec dictum dolor vel nisi suscipit pellentesque. Aliquam pulvinar orci sed semper fermentum. Nunc pellentesque sapien non tellus ultricies, in luctus ante condimentum. Donec at dui dignissim, finibus elit id, commodo enim.', 1, 1),
(24, 17, 'Scrap', 'Beaucoup d’entreprises scrapent les sites e-commerce concurrents à la recherche de toutes modifications de prix, de descriptions de produits et d’images, afin d’obtenir toutes les données possibles pour stimuler l’analyse et la modélisation prédictive des données.\r\n\r\nÀ moins que les tarifs ne soient concurrentiels, les sites e-commerce peuvent fermer leurs portes en un rien de temps.\r\n\r\nMême constat avec les sites de voyage qui extraient les prix des sites des compagnies aériennes depuis longtemps.\r\n\r\nDes solutions de web scraping personnalisées vous aideront à obtenir toutes les données imaginables dont vous pourriez avoir besoin.\r\n\r\nDe cette façon, vous pouvez collecter des données et créer votre propre database.', 1, 1),
(25, 16, 'Les enclaves d\'Orion', 'Le web scraping pour monitorer la réputation d’une marque\r\nLa réputation en ligne est très importante aujourd’hui car de nombreuses entreprises dépendent du bouche à oreille pour leur croissance.\r\n\r\nIci, le scraping de données sur les réseaux sociaux ou écoute sociale, aide à comprendre l’opinion et les sentiments actuels d’une audience définie par rapport à un sujet.\r\n\r\nUne fois l’écoute réalisée vous pourrez communiquer de la meilleure façon possible pour répondre parfaitement aux besoins de cette audience. Tout ça, basé sur leurs vrais sentiments.\r\n\r\nDans de futures articles nous vous apprendrons à scraper le web en Node.js simplement.\r\n\r\nJe vous invite à vous abonner à notre newsletter pour faire partie des premiers à découvrir nos derniers articles.', 1, 0),
(26, 15, 'TEST', 'Trouver les données de n’importe qui ou qu’elle entité\r\nLe web scraping permet de récupérer n’importe quelle donnée sur un individu X ou sur une entreprise Y. (surtout grâce aux réseaux sociaux)\r\n\r\nCes données sont ensuite utilisées pour des analyses, des comparaisons, des décisions d’investissement, une embauche et plus encore.\r\n\r\nDe nombreuses entreprises font du website scraping aujourd’hui sur des sites comme Le Bon Coin ou Indeed par exemple.', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `nav`
--

CREATE TABLE `nav` (
  `idNav` int NOT NULL,
  `nomLien` varchar(60) NOT NULL,
  `cheminNav` varchar(255) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `levelAdmi` tinyint NOT NULL,
  `ordre` tinyint NOT NULL,
  `centrale` tinyint NOT NULL DEFAULT '0',
  `classement` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `nav`
--

INSERT INTO `nav` (`idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`, `ordre`, `centrale`, `classement`) VALUES
(1, 'Inscription', 'formulaires/inscription.php', 1, 0, 0, 0, 0),
(2, 'index', 'environnement/corpsDeflaut.php', 1, 0, 2, 0, 0),
(3, 'Admin Liens', 'administration/addLien.php', 1, 3, 1, 0, 0),
(4, 'Connexion', 'formulaires/connexion.php', 1, 0, 3, 0, 0),
(5, 'index', 'environnement/corpsDeflaut.php', 1, 1, 1, 0, 0),
(6, 'Deconnexion', 'formulaires/deconnexion.php', 1, 1, 10, 0, 0),
(7, 'Déconnexion', 'formulaires/deconnexion.php', 1, 3, 10, 0, 0),
(10, 'Admin Users', 'administration/user.php', 1, 3, 3, 0, 0),
(11, 'Profil', 'formulaires/profil.php', 1, 1, 2, 0, 0),
(14, 'Déconnexion', 'formulaires/deconnexion.php', 1, 2, 10, 0, 0),
(24, 'index', 'environnement/corpsDeflaut.php', 1, 2, 2, 0, 0),
(36, 'profil User', 'administration/profilUser.php', 1, 3, 0, 1, 0),
(37, 'Votre profil', 'formulaires/profil.php', 1, 3, 4, 0, 0),
(39, 'Gestion Univers', 'environnement/gestionUnivers.php', 1, 1, 3, 0, 0),
(40, 'Ajouter un univers', 'formulaires/univers.php', 1, 1, 0, 2, 0),
(41, 'Factions', 'formulaires/factions.php', 1, 1, 0, 2, 1),
(42, 'Ajouter un texte de Lore', 'formulaires/lore.php', 1, 1, 0, 2, 3),
(43, 'liste Lore', 'formulaires/listeLore.php', 1, 1, 0, 2, 4),
(44, '', 'formulaires/affichageLore.php', 0, 1, 0, 2, 0),
(45, 'Règles Spéciales', 'formulaires/reglesSpeciales.php', 1, 2, 1, 0, 0),
(47, 'Gestion Armes', 'environnement/gestionArmes.php', 1, 1, 4, 0, 0),
(48, 'Création d\'armes de mêlée', 'formulaires/armesCC.php', 1, 1, 0, 3, 0),
(49, 'Création d\'arme de tir', 'formulaires/armesT.php', 1, 1, 0, 3, 1),
(50, 'Création d\'arme de zone', 'formulaires/armesE.php', 1, 1, 0, 3, 2),
(51, 'Fixer les armes', 'formulaires/fixerArme.php', 1, 1, 0, 3, 10),
(52, 'Factions &amp; fiches', 'formulaires/factionArme.php', 1, 1, 0, 3, 3),
(53, 'fiche Armes', 'formulaires/ficheArme.php', 0, 1, 0, 3, 0),
(54, '', 'affichages/ficheArme.php', 0, 1, 0, 3, 0),
(55, 'Figurines', 'environnement/gestionFigurine.php', 1, 1, 5, 0, 0),
(56, 'Créer une figurine', 'formulaires/creationFigurine.php', 1, 1, 0, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `rules`
--

CREATE TABLE `rules` (
  `idRules` int NOT NULL,
  `nomRules` varchar(60) NOT NULL,
  `descriptionRules` text NOT NULL,
  `modification` float NOT NULL,
  `typeRules` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rules`
--

INSERT INTO `rules` (`idRules`, `nomRules`, `descriptionRules`, `modification`, `typeRules`) VALUES
(7, 'Mobile', 'Les armures avec l’option mobile donne un avantage lorsque la figurine subit un jet de combat, pour toucher une figurine avec une armure « mobile » ajoute +1 à la difficulté pour toucher. \r\n\r\nExemple\r\nUn soutier de l’espace est touché sur 4+, mais, ces vêtements de travail lui confère la règle spéciale « Mobile » ce qui lui donne une difficulté pour toucher de 5+.', 1.1, 1),
(8, 'Endurante', 'Les unités équipées d’armures endurantes sont immunisés à la règle de « tête baissée » en cas de nombreuse touche sur la figurine. Ces armures sont si efficaces, que les impacts de balle n’affecte pas le courage des combattants et ils peuvent avancer sous une pluie de feu, dans un calme absolu. Les armures avec 3+ ou 3++ sont naturellement endurante.', 1.2, 1),
(9, 'Surprise', 'Les armes « surprise » passe automatiquement le statut d’une unité en « Tête baissée » à la fin de son action de combat (tir ou mêlée). Les véhicules sont affectés uniquement si la règles spécial « anti-véhicule » est associé à la règle « surprise », sinon, la simple règle « surprise » n’a pas d’effet sur un véhicule. Une arme de mêlée ou d’assaut qui a l’option « surprise » passe la figurine adverse en « baisser la tête » à la fin du combat de mêlée. Ainsi, elle ne peut pas se défendre lors du prochain combat.', 1.25, 0),
(10, 'Fumigène', 'Les gabarits de fumigènes bloquent les lignes de vue. Au début de chaque tour, tester le fumigène, sur 4+ le fumigène se dissipe et le nuage associé disparaît. Les figurines peuvent entrer dans la zone du fumigène mais ne pourront pas y combattre sauf au contact. Impossible de charger dans ou au travers d’une zone « fumigène », ni tirer à distance.', 1.05, 0),
(12, 'Perce-armure', 'Les armes perce-armure sont capable de réduire la capacité de sauvegarde si elle touche. Considéré que la cible touchée test sa sauvegarde avec un -1 à leur dé de sauvegarde (D6-1).\r\n\r\nExemple\r\nUne figurine obtient une blessure par tir avec une arme perce-amure. Le joueur sauvegarde la figurine avec la procédure habituelle, mais il ajoute +1 au résultat du D6 pour sauvegarder.', 1.1, 0),
(13, 'Rafale', 'Une arme capable de créer une rafale, permet de répartir ces touches sur plusieurs figurines d’une même unité au lieu de la concentré sur une seule figurine ou cible.', 1.15, 0),
(14, 'Anti-véhicule', 'Les armes anti-véhicule sont faite pour détruire les véhicules efficacement. Voir la section « véhicule » pour plus de détail.\r\nLes armes anti-véhicule sur les drones et robots et les figurines vivantes ont un double effet « perce-armure » sur eux,  avec un -2 à leur dé de sauvegarde (D6-2).\r\nLes armes anti-véhicule sont aussi faite pour impacter un véhicule à pleine puissance quand elles sont transportées par une figurine.\r\n\r\nExemple\r\nUne figurine obtient une blessure par tir avec une arme anti-véhicule. Le joueur sauvegarde la figurine avec la procédure habituelle, mais il ajoute +2 au résultat du D6 pour sauvegarder.', 1.2, 0),
(15, 'Visée sûre', 'Une arme avec visé sûre permet d’annuler l’effet des couverts léger dans le calcul qui rend une cible invisible derrière 3 couverts. Ainsi, une figurine n’est invisible que si derrière 3 couverts lourd uniquement, les couvert léger ne compte pas.', 1.12, 0),
(16, 'Gros calibre', 'Une arme dotée d’un gros calibre annule tous les modificateurs lier aux couverts légers qui protègent directement une cible.', 1.1, 0),
(17, 'Tir en lobe', 'Le tir en lobe permet de doubler la distance de la portée d’une arme. Cependant la difficulté de base pour tirer passe de 4+ à 6+. Noter que les tirs en lobe nécessite de voir les figurines avec une ligne de vue théorique sans couvert entre le tireur et la cible. \r\nNoter qu’un tir en lobe peut aussi se faire sans ligne de vu direct, dans ce cas, il faut qu’une unité allier puisse éclairer la cible et la localiser. Dans ce cas, la difficulté de base passe de 6+ à 8+, toutefois on n’applique aucune règle de couvert au tir entre la cible et le tireur.', 1.15, 0),
(18, 'Arme sainte', 'Les armes saintes sont des armes qui ont été portée par un saint ou qui sont portée par un saint. Celle-ci sont soit des reliques soit des armes saintes. Elle possède un +1 à son dé de puissance.', 1.25, 0),
(19, 'Arme divine', 'Les armes divines sont par nature très efficace en combat, les Dieux n’aiment pas perdre. Le dé de puissance bénéficie d’un +2 à leur jet. Les armes divines sont portée soit par des Dieux, leur serviteur ou de simple créature mortelle, qui les auraient trouvé ou au service des Dieux.', 1.45, 0),
(20, 'Viseur holographique', 'Ce système permet de localiser de manière rapide une cible. Elle annule le +1 d’une cible en mouvement tactique.', 1.1, 0),
(21, 'Lunette de visée', 'Le tireur a -1 pour viser une cible immobile.', 1.08, 0),
(22, 'Crosse rétractable', 'L’arme peut rétracter sa crosse rendant l’arme plus efficace en combat au contact. Elle gagne alors un ++ dans sa CC si c’est une arme d’assaut.', 1.12, 0),
(23, 'Smart Google', 'Rend la portée maximal de l’arme en combat nocturne.', 1.04, 1),
(24, 'Lampe tactique / éclairage IR ou UV', 'Donne -1 au tireur quand il opère dans un décor considéré comme un bâtiment ou un ruine pour tirer. Rend la portée maximal de l’arme en combat nocturne.', 1.08, 0),
(25, 'Pointeur Laser', 'Le pointeur-laser permet de visualiser en temps réel le point exact visé par l’arme. Les tirs à mi-portée de ces armes dotée de l’option pointeur laser donne moins +1 au dé de tir.', 1.1, 0),
(26, 'Empoissonnée', 'L’arme est enduite de poison, qui la rendent toxique pour une victime. Si elle est touchée, elle perd 2 point de vie au lieu d’un seul, puis 1 point de vie par tour sur un jet de 4+ sur 1D6 jusqu’à ce qu’elles meurent ou se fasse soigner. Les robots et les combattants artificiels, les véhicules ne sont pas affectés par cette option.', 1.18, 0),
(27, 'Arme à deux mains (mêlée uniquement)', 'Les armes à deux mains font perdre 2 points de vie ou de structure quand elle touche si la sauvegarde n’annule pas les dommages.', 1.15, 0),
(29, 'Strangulation (mêlée uniquement)', 'Au lieu de faire les dommages de l’arme, le joueur qui contrôle la figurine peut choisir une strangulation, l’unité reste au contact, passe en « Tête baissée ». À chaque phase de regroupement, la victime de la strangulation pourra tenter de s’échapper. Le test est de 4+ au premier tour, puis 5+ au second, etc. Chaque test échoué fait perdre 1 point de vie à la victime de la strangulation. \r\nTant que la figurine étrangle une victime, elle ne peut pas bouger ni combattre, ni tirer. Elle peut durant la phase de contact relâcher son étreinte pour agir normalement.', 1.05, 0),
(30, 'Enflammée', 'L’effet enflammé oblige une figurine enflammée à faire une sauvegarde à la fin du tour. Si elle échoue, elle perd un point de vie. Si elle réussit, les flammes sont éteintes. Le test se fait jusqu’à ce que la figurine arrive à 0 point de vie / structure ou qu’elle réussisse sa sauvegarde et que le feu soit éteint. Ajouter le pion « enflammé » à côté de chaque figurine subissant les effets d’une arme « enflammé ».', 1.15, 0),
(31, 'Petite arme (mêlée uniquement)', 'Les petites arme touche avec un +1 en raison de leur faible puissance en combat de mêlée. Mais gagne automatiquement « perce-armure » en règle spécial si elle touche. Une petite arme peut trouver facilement les faille d’une armure.\r\nExemple\r\nSi la difficulté est de 4+ pour toucher une figurine de taille standard, touché avec une petite arme passe alors à 5+.', 1.04, 0),
(33, 'Bouclier de combat de mêlée', 'Ce bouclier confère un +1 quand un adversaire tente de vous toucher en combat de mêlée.', 1.05, 0),
(34, 'Bouclier balistique', 'Ce bouclier vous donne un +1 quand un adversaire tente de vous toucher avec une arme de tir. Le bouclier balistique agit quelques soit les règles spéciales de l’arme qui tir sur votre figurine.', 1.1, 0),
(35, 'Champs de force', 'Un champs de force détourne la puissance des tirs ou les projectiles dans un court rayon atour d\'une figurine. \r\nLes tir contre une figurine doter d\'un champs de force gagne un -1 sur le dé du tireur.', 1.15, 1),
(36, 'Champs de force', 'Un champs de force détourne la puissance des tirs ou les projectiles dans un court rayon atour d\'un véhicule. \r\nLes tir contre un véhicule doter d\'un champs de force gagne un -1 sur le dé du tireur.', 1.15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `univers`
--

CREATE TABLE `univers` (
  `idUnivers` int NOT NULL,
  `idProprietaire` int NOT NULL,
  `nomUnivers` varchar(60) NOT NULL,
  `NTUnivers` tinyint NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `partager` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `univers`
--

INSERT INTO `univers` (`idUnivers`, `idProprietaire`, `nomUnivers`, `NTUnivers`, `valide`, `partager`) VALUES
(15, 14, 'Solaris', 12, 1, 0),
(16, 14, 'Lorem Upsim', 6, 1, 0),
(17, 14, 'Potterverse 1890', 9, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `mdp` varchar(80) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `universLibre` tinyint NOT NULL DEFAULT '0',
  `mailSecurite` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `token` mediumint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `nom`, `prenom`, `login`, `mdp`, `valide`, `role`, `universLibre`, `mailSecurite`, `token`) VALUES
(14, 'User', 'User', 'Utilisateur', '$2y$10$GwjApCKyN9SJTjkgUY0ryOYXfLYrRIAKAGj7iOlD4KaI3Nv7nK/Hm', 1, 1, 0, 'christophe.calmes2020@laposte.net', 0),
(15, 'Admin', 'Admin', 'Admin', '$2y$10$4msnp68RxcZM0KnlqOiaiucj7bOV7Z0hco1d.akJdBPFOqbpenNk2', 1, 3, 0, NULL, 0),
(16, 'Moderateur', 'Moderateur', 'Moderateur', '$2y$10$3iJkRzGUWWY2oSosULIBY.dwXuqMRf/lu/AK/X4geCymmvE7A2naa', 1, 2, 0, NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `AffecterFigurineUF`
--
ALTER TABLE `AffecterFigurineUF`
  ADD PRIMARY KEY (`idAffectationFigurine`),
  ADD KEY `univers_figurine` (`id_Univers`),
  ADD KEY `univers_faction` (`id_Faction`),
  ADD KEY `figurine_affectation` (`id_Figurine`);

--
-- Index pour la table `armes`
--
ALTER TABLE `armes`
  ADD PRIMARY KEY (`idArmes`),
  ADD KEY `proprietaire_Armes` (`idCreateur`),
  ADD KEY `id_univers_arme` (`id_Univers`);

--
-- Index pour la table `armesFigurine`
--
ALTER TABLE `armesFigurine`
  ADD PRIMARY KEY (`idDotation`),
  ADD KEY `figurine_arme` (`id_Arme_Dotation`),
  ADD KEY `armes_figurines` (`id_figurine_Dotation`);

--
-- Index pour la table `armesRules`
--
ALTER TABLE `armesRules`
  ADD PRIMARY KEY (`idAffectation`),
  ADD KEY `affecterArmes` (`id_Armes`),
  ADD KEY `affecterRules` (`id_Rules`);

--
-- Index pour la table `factions`
--
ALTER TABLE `factions`
  ADD PRIMARY KEY (`idFaction`),
  ADD KEY `proprietaire` (`idCreateur`),
  ADD KEY `univers` (`idUnivers`);

--
-- Index pour la table `figurines`
--
ALTER TABLE `figurines`
  ADD PRIMARY KEY (`idFigurine`),
  ADD KEY `User-Figurine` (`id_User`);

--
-- Index pour la table `lore`
--
ALTER TABLE `lore`
  ADD PRIMARY KEY (`idLore`),
  ADD KEY `loreUnivers` (`idUnivers`);

--
-- Index pour la table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`idNav`);

--
-- Index pour la table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`idRules`);

--
-- Index pour la table `univers`
--
ALTER TABLE `univers`
  ADD PRIMARY KEY (`idUnivers`),
  ADD KEY `proprieter` (`idProprietaire`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `AffecterFigurineUF`
--
ALTER TABLE `AffecterFigurineUF`
  MODIFY `idAffectationFigurine` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `armes`
--
ALTER TABLE `armes`
  MODIFY `idArmes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `armesFigurine`
--
ALTER TABLE `armesFigurine`
  MODIFY `idDotation` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `armesRules`
--
ALTER TABLE `armesRules`
  MODIFY `idAffectation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `factions`
--
ALTER TABLE `factions`
  MODIFY `idFaction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `figurines`
--
ALTER TABLE `figurines`
  MODIFY `idFigurine` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `lore`
--
ALTER TABLE `lore`
  MODIFY `idLore` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `nav`
--
ALTER TABLE `nav`
  MODIFY `idNav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `rules`
--
ALTER TABLE `rules`
  MODIFY `idRules` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `univers`
--
ALTER TABLE `univers`
  MODIFY `idUnivers` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `AffecterFigurineUF`
--
ALTER TABLE `AffecterFigurineUF`
  ADD CONSTRAINT `figurine_affectation` FOREIGN KEY (`id_Figurine`) REFERENCES `figurines` (`idFigurine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `univers_faction` FOREIGN KEY (`id_Faction`) REFERENCES `factions` (`idFaction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `univers_figurine` FOREIGN KEY (`id_Univers`) REFERENCES `univers` (`idUnivers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `armes`
--
ALTER TABLE `armes`
  ADD CONSTRAINT `id_univers_arme` FOREIGN KEY (`id_Univers`) REFERENCES `univers` (`idUnivers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proprietaire_Armes` FOREIGN KEY (`idCreateur`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `armesFigurine`
--
ALTER TABLE `armesFigurine`
  ADD CONSTRAINT `armes_figurines` FOREIGN KEY (`id_figurine_Dotation`) REFERENCES `figurines` (`idFigurine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `figurine_arme` FOREIGN KEY (`id_Arme_Dotation`) REFERENCES `armes` (`idArmes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `armesRules`
--
ALTER TABLE `armesRules`
  ADD CONSTRAINT `affecterArmes` FOREIGN KEY (`id_Armes`) REFERENCES `armes` (`idArmes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `affecterRules` FOREIGN KEY (`id_Rules`) REFERENCES `rules` (`idRules`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `factions`
--
ALTER TABLE `factions`
  ADD CONSTRAINT `proprietaire` FOREIGN KEY (`idCreateur`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `univers` FOREIGN KEY (`idUnivers`) REFERENCES `univers` (`idUnivers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `figurines`
--
ALTER TABLE `figurines`
  ADD CONSTRAINT `User-Figurine` FOREIGN KEY (`id_User`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lore`
--
ALTER TABLE `lore`
  ADD CONSTRAINT `loreUnivers` FOREIGN KEY (`idUnivers`) REFERENCES `univers` (`idUnivers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `univers`
--
ALTER TABLE `univers`
  ADD CONSTRAINT `proprieter` FOREIGN KEY (`idProprietaire`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
