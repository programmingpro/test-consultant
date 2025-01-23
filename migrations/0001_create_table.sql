CREATE TABLE chess_positions
(
    id         SERIAL PRIMARY KEY,
    fen        VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
