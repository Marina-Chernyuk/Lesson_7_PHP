
CREATE TABLE IF NOT EXISTS products ( 
  id INT(11) NOT NULL AUTO_INCREMENT, 
  name VARCHAR(100) NOT NULL, 
  description VARCHAR(250) NOT NULL, 
  price DECIMAL(6,2) NOT NULL, 
  PRIMARY KEY (`id`) 
);

INSERT INTO products (id, name, description, price) VALUES 
(1, 'Product 1', 'random description', '15.00'), 
(2, 'Product 2', 'random description', '48.00'), 
(3, 'Product 3', 'random description', '29.00'), 
(4, 'Product 4', 'random description', '55.00'), 
(5, 'Product 5', 'random description', '63.00'), 
(6, 'Product 6', 'random description', '34.00');
