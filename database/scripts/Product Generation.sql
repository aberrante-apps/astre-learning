INSERT INTO ProductCategories
(cat_name)
VALUES
('Technology');

INSERT INTO ProductCategories 
(cat_name)
VALUES
('Astronomy');

INSERT INTO ProductCategories
(cat_name)
VALUES
('Biology');

INSERT INTO Products 
(prod_name, prod_type, prod_description, prod_picture, 
prod_price, prod_avail, ProductCategories_cat_id) 
VALUES 
('Discovery™ Build & Create Robotics Kit', 
'Kit',
'Boost the imagination of the budding engineer in your family with this robotics kit from Discovery.
Equipped with all the essential gear to build the robots, this set will enhance your little ones\' motor skills.
The kit comes complete with full instructions so that getting started is simple and easy.
	Details:
	Includes 9 robotic designs
	Makes 3 robots
	Set up time: 10 minutes
	Powered by solar, salt and electric energy
	Includes instructions
	For ages 12 and up
	Contents:
	Spider robot component
	Salt-water car component
	7-in-1 robot components
	1 PVC battery sleeve
	1 decal sheet', 
'DiscoveryRoboticsKit.jpg', 
'49.99', 
100, 
1);

INSERT INTO Products 
(prod_name, prod_type, prod_description, prod_picture, 
prod_price, prod_avail, ProductCategories_cat_id) 
VALUES 
('Discovering Planets & Moons: The Ultimate Guide to the Most Fascinating Features of our Solar System', 
'Book',
'With a unique glow-in-the dark tactile book cover that recreates the cratered surface of the moon, DISCOVERING PLANETS AND MOONS is the ultimate guide to the most fascinating features of our solar system.
Blast off into outer space with DISCOVERINGS PLANETS AND MOONS! From the icy outer reaches of our solar system to the blazing heat of the Sun, this action-packed, full-color book is bursting with gripping facts, fun tidbits, and dynamic artwork that bring the mysteries of our galaxy to life!', 
'DiscoveringPlanetsAndMoons.png', 
'10.00', 
100, 
2);

INSERT INTO Products 
(prod_name, prod_type, prod_description, prod_picture, 
prod_price, prod_avail, ProductCategories_cat_id) 
VALUES 
('Coding Games in Python', 
'Book',
'Build and play your own computer games, from creative quizzes to perplexing puzzles, by coding them in the Python programming language!
Whether you\'re a seasoned programmer or a beginner hoping to learn Python, you\'ll find Coding Games in Python fun to read and easy to follow. Each chapter shows you how to construct a complete working game in simple numbered steps. Using freely available resources such as Pygame, Pygame Zero, and a downloadable pack of images and sounds, you can add animations, music, scrolling backgrounds, scenery, and other exciting professional touches.
After building the game, find out how to adapt it to create your own personalised version with secret hacks and cheat codes!
You\'ll master the key concepts that programmers need to write code - not just in Python, but in all programming languages. Find out what bugs, loops, flags, strings, and turtles are. Learn how to plan and design the ultimate game, and then play it to destruction as you test and debug it.
Before you know it, you\'ll be a coding genius!',
'CodingGamesInPython.png', 
'25.99', 
100, 
1);

INSERT INTO Products 
(prod_name, prod_type, prod_description, prod_picture, 
prod_price, prod_avail, ProductCategories_cat_id) 
VALUES 
('Wild Planet: Creatures Big and Small', 
'Book',
'A fun, picture-filled encyclopedia of some of the planets most interesting living creatures. From miscroscopic \'water bears\' that can live in space, to marine mammals that can make a city bus look small, this book looks at each of these organisms in detail. Come learn about animals you\'ve never heard of, and learn things you\'d never have guessed about the ones you see every day. Time to get Wild!', 
'WildPlanet.jpg', 
'29.99', 
100, 
3);

INSERT INTO Products 
(prod_name, prod_type, prod_description, prod_picture, 
prod_price, prod_avail, ProductCategories_cat_id) 
VALUES 
('MicroCosm Microscope and Sample Slides Kit', 
'Kit',
'There\'s a whole other world out there waiting to be explored; it\'s just too small to see with the regular eye! But with the help of this microscope kit, you can see tiny organisms and cell structures far smaller than a human hair. This kit comes with an assortment of 20 different pre-made slides for you, as well as another 30 blank slides that you can use for whatever experiments you like!', 
'MicroscopeKit.jpg', 
'119.99', 
100, 
3);

INSERT INTO Products 
(prod_name, prod_type, prod_description, prod_picture, 
prod_price, prod_avail, ProductCategories_cat_id) 
VALUES 
('What If? Imagining Extreme Life on Other Planets', 
'Book',
'So far, humanity has yet to find evidence of life elsewhere in the universe. But the universe is a vast and mysterious place, where seemingly anything can happen. What might life look like out there, just beyond what we can currently see? This book explores the possibility of extraterrestrial life by comparing the way life has adapted to extreme and dangerous environments on Earth, to guess at what could happen on other moons and planets.', 
'WhatIfBook.jpg', 
'59.99', 
100, 
2);

SELECT * FROM Products;















    