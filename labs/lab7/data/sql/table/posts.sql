CREATE TABLE posts
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    author_id INT NOT NULL,
    published_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    count_likes INT NOT NULL DEFAULT 0,
    CONSTRAINT users_id_fk
    FOREIGN KEY (author_id)
    REFERENCES users (id)
);