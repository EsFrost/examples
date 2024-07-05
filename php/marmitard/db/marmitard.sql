-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 05:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marmitard`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`) VALUES
(1, 'Appetizers', 'Starters to begin your meal.'),
(2, 'Main Courses', 'Hearty and filling main dishes.'),
(3, 'Desserts', 'Sweet treats to end your meal.'),
(4, 'Salads', 'Fresh and healthy salads.'),
(5, 'Soups', 'Warm and comforting soups.'),
(6, 'Beverages', 'Drinks to refresh you.'),
(7, 'Breakfast', 'Start your day with a good meal.'),
(8, 'Snacks', 'Light bites for any time.'),
(9, 'Breads', 'Baked goods for any occasion.'),
(10, 'Vegetarian', 'Meat-free meals.');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaires` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaires`, `id_user`, `id_recette`) VALUES
(1, 'This recipe is amazing!', 1, 1),
(2, 'I loved this dish, very tasty.', 2, 2),
(3, 'Not bad, but could use more spices.', 3, 3),
(4, 'My family enjoyed it.', 4, 4),
(5, 'Easy to make and delicious.', 5, 5),
(6, 'Will definitely make this again.', 6, 6),
(7, 'A bit too salty for my taste.', 7, 7),
(8, 'Perfect for a quick meal.', 8, 8),
(9, 'The instructions were very clear.', 9, 9),
(10, 'Could be improved with more vegetables.', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_user`, `id_recette`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `id_user`, `id_recette`, `note`) VALUES
(11, 1, 1, 'Note 1'),
(12, 2, 2, 'Note 2'),
(13, 3, 3, 'Note 3'),
(14, 4, 4, 'Note 4'),
(15, 5, 5, 'Note 5'),
(16, 6, 6, 'Note 6'),
(17, 7, 7, 'Note 7'),
(18, 8, 8, 'Note 8'),
(19, 9, 9, 'Note 9'),
(20, 10, 10, 'Note 10');

-- --------------------------------------------------------

--
-- Table structure for table `recettes`
--

CREATE TABLE `recettes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `liste_ingredients` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `photos` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recettes`
--

INSERT INTO `recettes` (`id`, `nom`, `liste_ingredients`, `description`, `status`, `photos`, `id_user`, `id_category`) VALUES
(1, 'Spaghetti Carbonara', 'Spaghetti, eggs, pancetta, Parmesan cheese', 'A classic Italian pasta dish.', 1, 'carbonara.jpg', 1, 2),
(2, 'Chicken Curry', 'Chicken, curry powder, coconut milk, onions', 'A flavorful Indian curry.', 1, '../public/img/chicken_curry.jpg', 2, 2),
(3, 'Chocolate Cake', 'Flour, sugar, cocoa powder, eggs, butter', 'A rich and moist chocolate cake.', 1, 'chocolate_cake.jpg', 3, 3),
(4, 'Caesar Salad', 'Romaine lettuce, croutons, Parmesan, Caesar dressing', 'A fresh salad with a creamy dressing.', 1, 'caesar_salad.jpg', 4, 4),
(5, 'Tomato Soup', 'Tomatoes, onions, garlic, vegetable broth', 'A warm and comforting tomato soup.', 1, 'tomato_soup.jpg', 5, 5),
(6, 'Mojito', 'White rum, sugar, lime juice, soda water, mint', 'A refreshing Cuban cocktail.', 1, 'mojito.jpg', 6, 6),
(7, 'Pancakes', 'Flour, milk, eggs, baking powder', 'Fluffy breakfast pancakes.', 1, 'pancakes.jpg', 7, 7),
(8, 'Nachos', 'Tortilla chips, cheese, jalapeños, sour cream', 'A tasty snack or appetizer.', 1, 'nachos.jpg', 8, 8),
(9, 'Garlic Bread', 'Bread, garlic, butter, parsley', 'Crispy and flavorful garlic bread.', 1, 'garlic_bread.jpg', 9, 9),
(10, 'Vegetable Stir Fry', 'Mixed vegetables, soy sauce, garlic, ginger', 'A quick and healthy vegetable stir fry.', 1, 'vegetable_stir_fry.jpg', 10, 10),
(14, 'Test', 'No ingredients', 'This is a test recipe', 0, '../public/profile_images/Test_1_2024_07_05_10_07_39_pxfuel.jpg', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `age` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `sexe` enum('Homme','Femme') NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `status` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `age`, `mdp`, `sexe`, `profile_image`, `status`) VALUES
(1, 'Doe', 'John', 'john.doe@example.com', 30, 'password123', 'Homme', 'john_doe.jpg', 'User'),
(2, 'Smith', 'Jane', 'jane.smith@example.com', 25, 'password123', 'Femme', 'jane_smith.jpg', 'User'),
(3, 'Brown', 'Charlie', 'charlie.brown@example.com', 35, 'password123', 'Homme', 'charlie_brown.jpg', 'User'),
(4, 'Wilson', 'Anna', 'anna.wilson@example.com', 28, 'password123', 'Femme', 'anna_wilson.jpg', 'User'),
(5, 'Taylor', 'James', 'james.taylor@example.com', 40, 'password123', 'Homme', 'james_taylor.jpg', 'User'),
(6, 'Johnson', 'Emily', 'emily.johnson@example.com', 22, 'password123', 'Femme', 'emily_johnson.jpg', 'User'),
(7, 'White', 'Michael', 'michael.white@example.com', 50, 'password123', 'Homme', 'michael_white.jpg', 'User'),
(8, 'Martin', 'Olivia', 'olivia.martin@example.com', 27, 'password123', 'Femme', 'olivia_martin.jpg', 'User'),
(9, 'Lee', 'David', 'david.lee@example.com', 33, 'password123', 'Homme', 'david_lee.jpg', 'User'),
(10, 'Walker', 'Sophia', 'sophia.walker@example.com', 29, 'password123', 'Femme', 'sophia_walker.jpg', 'User'),
(11, 'Test', 'Testington', 'testington@gmail.com', 50, '$2y$10$PrvQbAhXyYDNg3yWOFxtLOcVw5XTmAC46XURTsIrbN63VzQzmrT5u', 'Homme', '../public/profile_images/Test_Testington_2024_07_04_07_07_57_pxfuel.jpg', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_recette` (`id_recette`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_recette` (`id_recette`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_recette` (`id_recette`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `recettes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
