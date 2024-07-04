INSERT INTO `categories` (`nom`, `description`) VALUES
('Appetizers', 'Starters to begin your meal.'),
('Main Courses', 'Hearty and filling main dishes.'),
('Desserts', 'Sweet treats to end your meal.'),
('Salads', 'Fresh and healthy salads.'),
('Soups', 'Warm and comforting soups.'),
('Beverages', 'Drinks to refresh you.'),
('Breakfast', 'Start your day with a good meal.'),
('Snacks', 'Light bites for any time.'),
('Breads', 'Baked goods for any occasion.'),
('Vegetarian', 'Meat-free meals.');

INSERT INTO `users` (`nom`, `prenom`, `email`, `age`, `mdp`, `sexe`, `profile_image`, `status`) VALUES
('Doe', 'John', 'john.doe@example.com', 30, 'password123', 'Homme', 'john_doe.jpg', 'User'),
('Smith', 'Jane', 'jane.smith@example.com', 25, 'password123', 'Femme', 'jane_smith.jpg', 'User'),
('Brown', 'Charlie', 'charlie.brown@example.com', 35, 'password123', 'Homme', 'charlie_brown.jpg', 'User'),
('Wilson', 'Anna', 'anna.wilson@example.com', 28, 'password123', 'Femme', 'anna_wilson.jpg', 'User'),
('Taylor', 'James', 'james.taylor@example.com', 40, 'password123', 'Homme', 'james_taylor.jpg', 'User'),
('Johnson', 'Emily', 'emily.johnson@example.com', 22, 'password123', 'Femme', 'emily_johnson.jpg', 'User'),
('White', 'Michael', 'michael.white@example.com', 50, 'password123', 'Homme', 'michael_white.jpg', 'User'),
('Martin', 'Olivia', 'olivia.martin@example.com', 27, 'password123', 'Femme', 'olivia_martin.jpg', 'User'),
('Lee', 'David', 'david.lee@example.com', 33, 'password123', 'Homme', 'david_lee.jpg', 'User'),
('Walker', 'Sophia', 'sophia.walker@example.com', 29, 'password123', 'Femme', 'sophia_walker.jpg', 'User');

INSERT INTO `recettes` (`nom`, `liste_ingredients`, `description`, `status`, `photos`, `id_user`, `id_category`) VALUES
('Spaghetti Carbonara', 'Spaghetti, eggs, pancetta, Parmesan cheese', 'A classic Italian pasta dish.', 1, 'carbonara.jpg', 1, 2),
('Chicken Curry', 'Chicken, curry powder, coconut milk, onions', 'A flavorful Indian curry.', 1, 'chicken_curry.jpg', 2, 2),
('Chocolate Cake', 'Flour, sugar, cocoa powder, eggs, butter', 'A rich and moist chocolate cake.', 1, 'chocolate_cake.jpg', 3, 3),
('Caesar Salad', 'Romaine lettuce, croutons, Parmesan, Caesar dressing', 'A fresh salad with a creamy dressing.', 1, 'caesar_salad.jpg', 4, 4),
('Tomato Soup', 'Tomatoes, onions, garlic, vegetable broth', 'A warm and comforting tomato soup.', 1, 'tomato_soup.jpg', 5, 5),
('Mojito', 'White rum, sugar, lime juice, soda water, mint', 'A refreshing Cuban cocktail.', 1, 'mojito.jpg', 6, 6),
('Pancakes', 'Flour, milk, eggs, baking powder', 'Fluffy breakfast pancakes.', 1, 'pancakes.jpg', 7, 7),
('Nachos', 'Tortilla chips, cheese, jalapeños, sour cream', 'A tasty snack or appetizer.', 1, 'nachos.jpg', 8, 8),
('Garlic Bread', 'Bread, garlic, butter, parsley', 'Crispy and flavorful garlic bread.', 1, 'garlic_bread.jpg', 9, 9),
('Vegetable Stir Fry', 'Mixed vegetables, soy sauce, garlic, ginger', 'A quick and healthy vegetable stir fry.', 1, 'vegetable_stir_fry.jpg', 10, 10);


INSERT INTO `commentaires` (`commentaires`, `id_user`, `id_recette`) VALUES
('This recipe is amazing!', 1, 1),
('I loved this dish, very tasty.', 2, 2),
('Not bad, but could use more spices.', 3, 3),
('My family enjoyed it.', 4, 4),
('Easy to make and delicious.', 5, 5),
('Will definitely make this again.', 6, 6),
('A bit too salty for my taste.', 7, 7),
('Perfect for a quick meal.', 8, 8),
('The instructions were very clear.', 9, 9),
('Could be improved with more vegetables.', 10, 10);

INSERT INTO `likes` (`id_user`, `id_recette`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO `notes` (`id_user`, `id_recette`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);