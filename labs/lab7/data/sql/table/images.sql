CREATE TABLE images
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image_source VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    post_id INT NOT NULL,
    CONSTRAINT posts_id_fk
    FOREIGN KEY (post_id)
    REFERENCES posts (id) ON DELETE CASCADE
);