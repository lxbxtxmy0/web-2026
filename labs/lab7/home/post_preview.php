<div class="post">
    <div class="header_of_post">
        <div class="author">
            <img src="<?= $post['avatar_image'] ?>" alt="Аватар" height="32" width="32" class="photo_avatar">
            <p><?= $post['author'] ?></p>
        </div>
        <?php if ($post['can_edit']): ?>
            <button>
                <img src="img/edit_icon.svg" alt="Редактирование публикации" height="24" width="24">
            </button>
        <?php endif; ?>
    </div>
    <div class="photo">
        <a href="post?postId=<?= $post['id'] ?>">
            <?php foreach ($post['images'] as $image): ?>
                <img src="<?= $image ?>" alt="<?= $post['img_alt'] ?>" height="474" width="474">
            <?php endforeach; ?>
        </a>
        <?php if ($post['has_count']): ?>
            <span class="count_photos">1/3</span>
            <button class="slider_left">
                <img src="img/left_button.svg" alt="Предыдущее фото" height="20" width="20">
            </button>
            <button class="slider_right">
                <img src="img/right_button.svg" alt="Следуещее фото" height="20" width="20">
            </button>
        <?php endif; ?>
    </div>
    <?php if ($post['count_likes'] > 0): ?>
        <button class="like">
            <img src="img/heart_icon.png" alt="like" height="15" width="15" class="like_icon">
            <span><?= $post['count_likes'] ?></span>
        </button>
    <?php endif; ?>
    <div class="info">
        <?php if ($post['description'] != ''): ?>
            <p class="description">
                <?= $post['description'] ?>
            </p>
        <?php endif; ?>
        <?php if (isset($post['post_time'])): ?>
            <span class="time">
            <?= date('d.m.Y H:i', $post['post_time']) ?>
        </span>
        <?php endif; ?>
    </div>
</div>