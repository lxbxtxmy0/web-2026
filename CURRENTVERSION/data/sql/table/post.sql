CREATE TABLE post
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    published_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    description TEXT NOT NULL,
    count_likes INT NOT NULL DEFAULT 0,
    CONSTRAINT users_id_fk
    FOREIGN KEY (author_id)
    REFERENCES users (id)
);

