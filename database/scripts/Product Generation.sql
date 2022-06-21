-- -----------------------------------------------------------------------------------------
-- Automated Script For Insertion of Pre-Made Product Information Into the Products Table
-- Script Also Automatically Generates All Available Product Categories and Types Beforehand
-- -----------------------------------------------------------------------------------------

INSERT INTO Categories
(name)
VALUES
('Astronomy');

INSERT INTO Categories 
(name)
VALUES
('Biology');

INSERT INTO Categories
(name)
VALUES
('Chemistry');

INSERT INTO Categories
(name)
VALUES
('Math');

INSERT INTO Categories
(name)
VALUES
('Physics');

INSERT INTO Categories
(name)
VALUES
('Technology');

INSERT INTO Types
(name)
VALUES
('Book');

INSERT INTO Types
(name)
VALUES
('Kit');

INSERT INTO Products 
(name, description, picture, price, stock) 
VALUES 
('Discovery™ Build & Create Robotics Kit',
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
'product_images/DiscoveryRoboticsKit.jpg', 
'49.99', 
100);

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(1, 6);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(1, 2);


INSERT INTO Products 
(name, description, picture, price, stock) 
VALUES 
('Discovering Planets & Moons: The Ultimate Guide to the Most Fascinating Features of our Solar System', 
'With a unique glow-in-the dark tactile book cover that recreates the cratered surface of the moon, DISCOVERING PLANETS AND MOONS is the ultimate guide to the most fascinating features of our solar system.
Blast off into outer space with DISCOVERINGS PLANETS AND MOONS! From the icy outer reaches of our solar system to the blazing heat of the Sun, this action-packed, full-color book is bursting with gripping facts, fun tidbits, and dynamic artwork that bring the mysteries of our galaxy to life!', 
'product_images/DiscoveringPlanetsAndMoons.png', 
'10.00', 
100);

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(2, 1);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(2, 1);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('Coding Games in Python', 
'Build and play your own computer games, from creative quizzes to perplexing puzzles, by coding them in the Python programming language!
Whether you\'re a seasoned programmer or a beginner hoping to learn Python, you\'ll find Coding Games in Python fun to read and easy to follow. Each chapter shows you how to construct a complete working game in simple numbered steps. Using freely available resources such as Pygame, Pygame Zero, and a downloadable pack of images and sounds, you can add animations, music, scrolling backgrounds, scenery, and other exciting professional touches.
After building the game, find out how to adapt it to create your own personalised version with secret hacks and cheat codes!
You\'ll master the key concepts that programmers need to write code - not just in Python, but in all programming languages. Find out what bugs, loops, flags, strings, and turtles are. Learn how to plan and design the ultimate game, and then play it to destruction as you test and debug it.
Before you know it, you\'ll be a coding genius!',
'product_images/CodingGamesInPython.png', 
'25.99', 
100);

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(3, 6);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(3, 1);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('STEM STARTERS FOR KIDS ENGINEERING ACTIVITY BOOK: Packed with Activities and Engineering Facts', 
'STEM stands for Science, Technology, Engineering, and Math. Here is a great way to get boys and kids excited about the last one; Engineering! 
Engineering is what brings machines to life. Little learners can discover more about engineering at home by reading the simple explanations and doing the beautifully illustrated activities on each page. 
This full-color activity book filled with marvelous mazes, puzzles, quizzes, and more. It will help parents and teachers kickstart a lifelong passion for STEM subjects and inspire children to, one day, contribute an invention of their own to the world.',
'product_images/EngineeringActivityBook.png', 
'6.99', 
100);

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(4, 6);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(4, 1);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('Thames & Kosmos Physics Workshop', 
'Almost everyone has heard of a chemistry set. But until this kit was introduced, a physics set was almost unheard of. Physics is an essential science for everyone, and this kit provides a comprehensive explanation of mechanical physics. 
Through building 36 models and conducting subsequent experiments with the models, you will learn the fundamental laws of mechanical physics. Start by building small models, such as a fixed pulley, to learn about basic forces and simple machines. 
Then, work your way up to more complex machines, such as a pendulum clock, to learn more advanced concepts like work and centripetal force. This hands-on approach is both fun and effective because the principles of physics are demonstrated right in front of you.', 
'product_images/PhysicsWorkshopKit.jpg', 
'69.99', 
'100');

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(5, 5);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(5, 2);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('Weird But True Animals', 
'The next in the best-selling Weird But True line features National Geographic Kids\' two best topics--Weird But True and animals--together in an irresistable combination!\r\n\r\n
Get ready to ooh, ahh, and awww with wacky stats, tidbits, and trivia about the many ways animals can be incredibly WEIRD! Did you know that you can take a yoga class with goats? Or that there\'s a pig that loves to paint? Or that slugs have green blood? 
The wild world of animals just got a little bit weirder in this new edition, packed with 300 facts and photos to encourage curiosity and keep kids entertained, amazed, and laughing for hours!', 
'product_images/WeirdButTrueAnimals.jpg', 
'11.99', 
'100');

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(6, 2);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(6, 1);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('The Kitchen Pantry Scientist Chemistry for Kids: Science Experiments and Activities Inspired by Awesome Chemists, Past and Present', 
'* 2021 AAAS/Subaru SB&F Prize for Excellence in Science Books in Middle Grade Longlist\r\n* 2021 NSTA-CBC Outstanding Science Trade Book \r\n* 2021 EUREKA! Nonfiction Childrenâ€™s Honor Book\r\n\r\n
Aspiring young chemists will discover an amazing group of role models and memorable experiments in Chemistry for Kids, the debut book of The Kitchen Pantry Scientist series.\r\n
Replicate a chemical reaction similar to one Marie Curie used to purify radioactive elements. Distill perfume using a method created in ancient Mesopotamia by a woman named Tapputi.\r\n\r\n
This engaging guide offers a series of snapshots of 25 scientists famous for their work with chemistry, from ancient history through today. 
Each lab tells the story of a scientist along with some background about the importance of their work, and a description of where it is still being used or reflected in todayâ€™s world.\r\n\r\n
A step-by-step illustrated experiment paired with each story offers kids a hands-on opportunity for exploring concepts the scientists pursued, or are working on today. 
Experiments range from very simple projects using materials you probably already have on hand, to more complicated ones that may require a few inexpensive items you can purchase online. 
Just a few of the incredible people and scientific concepts youâ€™ll explore:\r\n\r\nGalen (b. 129 AD)\r\nMake soap from soap base, oil, and citrus peels.\r\n
Modern application: medical disinfectants\r\n\r\nJoseph Priestly (b. 1733)\r\nCarbonate a beverage using CO2 from yeast or baking soda and vinegar mixture.\r\nModern application: soda fountains\r\n\r\nAlessandra Volta (b. 1745)\r\n
Make a battery using a series of lemons and use it to light an LED.\r\nModern application: car battery\r\n\r\nTu Youyou (b. 1930)\r\nExtract compounds from plants.\r\nModern application: pharmaceuticals and cosmetics\r\n\r\n
People have been tinkering with chemistry for thousands of years. Whether out of curiosity or by necessity, Homo sapiens have long loved to play with fire: mixing and boiling concoctions to see what interesting, beautiful, and useful amalgamations they could create. 
Early humans ground pigments to create durable paint for cave walls, and over the next 70 thousand years or so as civilizations took hold around the globe, people learned to make better medicines and discovered how to extract, mix, and smelt metals for cooking vessels, weapons, and jewelry. 
Early chemists distilled perfume, made soap, and perfected natural inks and dyes.\r\n\r\nModern chemistry was born around 250 years ago, when measurement, mathematics, and the scientific method were officially applied to experimentation. 
In 1896, after the first draft of the periodic table was published, scientists rushed to fill in the blanks. The elemental discoveries that followed gave scientists the tools to visualize the building blocks of matter for the first time in history, and they proceeded to deconstruct the atom. 
Since then, discovery has accelerated at an unprecedented rate. At times, modern chemistry and its creations have caused heartbreaking, unthinkable harm, but more often than not, it makes our lives better.\r\n\r\n
With this fascinating, hands-on exploration of the history of chemistry, inspire the next generation of great scientists.\r\n\r\nDig into even more incredible science history from The Kitchen Pantry Scientist series with: Biology for Kids (May 2021), Physics for Kids (January 2022), and Math for Kids (August 2022).', 
'product_images/ChemistryForKids.jpg', 
'25.00', 
'100');

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(7, 3);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(7, 1);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('Super Simple Math Flash Cards', 
'125 comprehensive, easy-to-use cards for exam preparation\r\n\r\nA fantastic aid for test preparation, these flash cards make math crystal clear and will have you exam-ready in no time.\r\n\r\nMake math super simple! 
These handy flash cards condense everything you need to know about math into bitesize key facts and crystal clear diagrams. Studying for exams has never been so easy.  
\r\n\r\nMath is explained in simple, user-friendly language, with colorful illustrations to help you grasp difficult concepts at a glance. Whether youâ€™re catching up on lessons, doing homework, or revising for exams, these super simple cards will make you a math expert in no time.', 
'product_images/SuperSimpleMathFlashCards.jpg', 
'18.99', 
'100');

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(8, 4);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(8, 2);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('Super Simple Physics Flash Cards', 
'A fantastic aid for coursework, homework, and test revision, these revision cards make Physics crystal clear and will have you exam-ready in no time.\r\n \r\n\r\n
Making super simple sciences even simpler! With images, graphics, equations and definitions, learning has never been easier. 
Super Simple Revision Cards condense the sciences into a manageable, visually appealing format that is easy to digest and revise from. 
With each of the 250 cards containing definitions and key facts on one side, and a detailed graphic on the other, memorizing science facts is made easy and enjoyable. \r\n \r\n
Difficult concepts are presented clearly and the full-color illustrations and photographs make the process of absorbing the information fun and simple. Youâ€™ll learn everything you need to know to ace that test! ', 
'product_images/SuperSimplePhysicsFlashCards.jpg', 
'18.99', 
'100');

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(9, 5);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(9, 2);


INSERT INTO Products 
(name, description, picture, price, stock)
VALUES 
('Crayola Colour Chemistry Lab Set', 
'This kidsâ€™ chemistry set includes 50 science experiments\r\n16 out-of-the-box experiments & 34 additional science activities\r\nScience projects designed by real Crayola Scientists\r\n
Easy instructions for kids to follow, adult supervision recommended\r\nA great kids educational toy for ages 7 & up', 
'product_images/CrayolaChemistrySet.jpg', 
'24.00', 
'100');

INSERT INTO ProductCategories
(product_id, category_id)
VALUES
(10, 3);

INSERT INTO ProductTypes
(product_id, type_id)
VALUES
(10, 2);

SELECT * FROM Products;























    