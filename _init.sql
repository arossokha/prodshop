CREATE DATABASE prodshop COLLATE utf8_general_ci;
use prodshop;
CREATE USER 'prodshop'@'localhost' IDENTIFIED BY  'prodshop';
GRANT ALL PRIVILEGES ON  `prodshop` . * TO  'prodshop'@'localhost';