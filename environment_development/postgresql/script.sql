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

CREATE VIEW product_type_view AS SELECT * FROM product_type;
CREATE VIEW product_view AS SELECT * FROM product;

CREATE VIEW sale_total_price_view AS
    SELECT
        s.id,
        s.sale_time,
        COALESCE(SUM(sp.price_in_cents), 0) AS price_in_cents
    FROM
        sale s
            LEFT JOIN
        sale_product sp ON s.id = sp.sale_id
    GROUP BY
        s.id;

CREATE INDEX idx_product_type_name ON product_type (name);
CREATE INDEX idx_product_name ON product (name);
CREATE INDEX idx_product_price_in_cents ON product (price_in_cents);
CREATE INDEX idx_product_product_type_id ON product (product_type_id);
CREATE INDEX idx_sale_sale_time ON sale (sale_time);
CREATE INDEX idx_sale_product_sale_id ON sale_product (sale_id);
CREATE INDEX idx_sale_product_product_id ON sale_product (product_id);
CREATE INDEX idx_sale_product_price_in_cents ON sale_product (price_in_cents);
