USE reviewsdb;

CREATE TABLE reviews (
    email VARCHAR(255) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    review TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);