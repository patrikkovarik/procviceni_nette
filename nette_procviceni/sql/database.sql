-- Vytvoření tabulky pro uživatele
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(255) NOT NULL,
  active TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
);

-- Vytvoření tabulky pro články
CREATE TABLE articles (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  image VARCHAR(255),
  video VARCHAR(255),
  created DATETIME NOT NULL,
  published DATETIME DEFAULT NULL,
  author_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (author_id) REFERENCES users(id)
);

-- Vytvoření tabulky pro komentáře
CREATE TABLE comments (
  id INT(11) NOT NULL AUTO_INCREMENT,
  content TEXT NOT NULL,
  created DATETIME NOT NULL,
  article_id INT(11) NOT NULL,
  author_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (article_id) REFERENCES articles(id),
  FOREIGN KEY (author_id) REFERENCES users(id)
);


-- Vložení uživatelů
INSERT INTO users (email, password, role) VALUES
('john@example.com', 'password', 'admin'),
('jane@example.com', 'password', 'editor'),
('bob@example.com', 'password', 'editor'),
('alice@example.com', 'password', 'editor');

-- Vložení článků
INSERT INTO articles (title, content, image, video, created, published, author_id) VALUES
('První článek', 'Lorem ipsum dolor sit amet.', 'image1.jpg', 'video1.mp4', NOW(), NOW(), 1),
('Druhý článek', 'Suspendisse potenti. Sed imperdiet mi a urna rutrum vehicula.', 'image2.jpg', 'video2.mp4', NOW(), NOW(), 2),
('Třetí článek', 'Phasellus eget sapien id felis placerat bibendum nec quis neque.', 'image3.jpg', NULL, NOW(), NOW(), 3),
('Čtvrtý článek', 'Fusce dignissim est ac mi tristique, a iaculis urna vestibulum.', 'image4.jpg', 'video4.mp4', NOW(), NULL, 4);

-- Vložení komentářů
INSERT INTO comments (content, created, article_id, author_id) VALUES
('Pěkný článek!', NOW(), 1, 2),
('Co na to říct, dobrý job!', NOW(), 1, 3),
('Taky se mi líbí.', NOW(), 1, 4),
('Moc se mi to nelíbí.', NOW(), NOW(), 2),
('S tím souhlasím.', NOW(), 2, 4),
('Nemyslím si, že to takhle funguje.', NOW(), 4, 1);