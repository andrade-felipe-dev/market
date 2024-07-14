CREATE TABLE IF NOT EXISTS product_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(255),
    tax INT NOT NULL
);

CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    priceInCents INT NOT NULL,
    unit VARCHAR(50),
    brand VARCHAR(100),
    observation TEXT,
    product_type_id INT NOT NULL,
    FOREIGN KEY (product_type_id) REFERENCES product_type(id)
);

CREATE TABLE IF NOT EXISTS sale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    priceInCents INT NOT NULL,
    saleTime DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS sale_product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT NOT NULL,
    product_id INT NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sale(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);
