CREATE TABLE IF NOT EXISTS product_type (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    tax INT NOT NULL
);

CREATE TABLE IF NOT EXISTS product (
   id SERIAL PRIMARY KEY,
   name VARCHAR(255) NOT NULL,
    description TEXT,
    price_in_cents INT NOT NULL,
    unit VARCHAR(50),
    brand VARCHAR(100),
    observation TEXT,
    product_type_id INT NOT NULL,
    FOREIGN KEY (product_type_id) REFERENCES product_type(id)
);

CREATE TABLE IF NOT EXISTS sale (
    id SERIAL PRIMARY KEY,
    sale_time TIMESTAMP NOT NULL
);

CREATE TABLE IF NOT EXISTS sale_product (
    id SERIAL PRIMARY KEY,
    sale_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price_in_cents INT NOT NULL,

    FOREIGN KEY (sale_id) REFERENCES sale(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);
