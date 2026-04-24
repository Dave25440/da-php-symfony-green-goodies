-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 21 avr. 2026 à 11:45
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `green_goodies`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260408112549', '2026-04-08 11:27:05', 67),
('DoctrineMigrations\\Version20260408134520', '2026-04-08 14:03:38', 24),
('DoctrineMigrations\\Version20260420210156', '2026-04-20 21:04:15', 46),
('DoctrineMigrations\\Version20260421114201', '2026-04-21 11:42:36', 44);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `total` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_item`
--

CREATE TABLE `order_item` (
  `id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `product_id` int NOT NULL,
  `purchase_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `full_description` longtext NOT NULL,
  `price` double NOT NULL,
  `picture` varchar(255) NOT NULL,
  `archive` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `short_description`, `full_description`, `price`, `picture`, `archive`) VALUES
(1, 'Savon Bio', 'Thé, Orange & Girofle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 18.9, 'savon-bio-1.webp', 0),
(2, 'Nécessaire, déodorant Bio', '50 ml déodorant à l’eucalyptus', 'Déodorant Nécessaire, une formule révolutionnaire composée exclusivement d\'ingrédients naturels pour une protection efficace et bienfaisante.\n\nChaque flacon de 50 ml renferme le secret d\'une fraîcheur longue durée, sans compromettre votre bien-être ni l\'environnement. Conçu avec soin, ce déodorant allie le pouvoir antibactérien des extraits de plantes aux vertus apaisantes des huiles essentielles, assurant une sensation de confort toute la journée.\n\nGrâce à sa formule non irritante et respectueuse de votre peau, Nécessaire offre une alternative saine aux déodorants conventionnels, tout en préservant l\'équilibre naturel de votre corps.', 8.5, 'necessaire-deodorant-bio-2.webp', 0),
(3, 'Kit couvert en bois', 'Revêtement Bio en olivier & sac de transport', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 12.3, 'kit-couvert-en-bois-3.webp', 0),
(4, 'Brosse à dent', 'Bois de hêtre rouge issu de forêts gérées durablement', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 5.4, 'brosse-a-dent-4.webp', 0),
(5, 'Bougie Lavande & Patchouli', 'Cire naturelle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 32, 'bougie-lavande-patchouli-5.webp', 0),
(6, 'Disques Démaquillants x3', 'Solution efficace pour vous démaquiller en douceur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 19.9, 'disques-demaquillants-x3-6.webp', 0),
(7, 'Gourde en bois', '50 cl, bois d’olivier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 16.9, 'gourde-en-bois-7.webp', 0),
(8, 'Shot Tropical', 'Fruits frais, pressés à froid', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 4.5, 'shot-tropical-8.webp', 0),
(9, 'Kit d\'hygiène recyclable', 'Pour une salle de bain eco-friendly', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.', 24.99, 'kit-d-hygiene-recyclable-9.webp', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`) VALUES
(1, 'dave@mail.com', '[]', '$2y$13$/CV7zm7.Z6RZaHab.RBaG.kYBfpw8AkIgqEnOlAPKt6wg6jhGxSDa', 'David', 'Horès');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Index pour la table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_52EA1F094584665A` (`product_id`),
  ADD KEY `IDX_52EA1F09558FBEB9` (`purchase_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_52EA1F094584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_52EA1F09558FBEB9` FOREIGN KEY (`purchase_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
