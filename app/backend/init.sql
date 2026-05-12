CREATE TABLE IF NOT EXISTS deliveries (
    id SERIAL PRIMARY KEY,
    customer_name VARCHAR(255),
    order_id VARCHAR(255),
    address TEXT,
    status VARCHAR(50)
);
