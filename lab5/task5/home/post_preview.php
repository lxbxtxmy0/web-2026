<div class="post">
    <div class="head-of-post">
        <img src="<?= $post['avatar_image'] ?>" alt="Аватар" height="32" width="32" class="avatar">
        <p class="name-text"><?= $post['author'] ?></p>
        <?php if ($post['can_edit']): ?>
            <button>
                <img src="img/edit_icon.png" alt="Редактирование публикации" height="24" width="24">
            </button>
        <?php endif; ?>
    </div>
    <div>
        <img src="<?= $post['images'][0] ?>" alt="<?= $post['img_alt'] ?>" height="474"
             width="474">
        <?php if ($post['has_count']): ?>
            <span>1 / 3</span>
            <button>
                <img src="img/left_button.png" alt="Предыдущее фото" height="20" width="20">
            </button>
            <button>
                <img src="img/right_button.png" alt="Следуещее фото" height="20" width="20">
            </button>
        <?php endif; ?>
    </div>
    <?php if ($post['count_likes'] > 0): ?>
        <button class="likes">
            <img src="img/heart_icon.png" alt="like" height="16" width="16">
            <span><?= $post['count_likes'] ?></span>
        </button>
    <?php endif; ?>
    <?php if ($post['description'] != ''): ?>
        <p class="description">
            <?= $post['description'] ?>
        </p>
    <?php endif; ?>
    <?php if (isset($post['post_time'])): ?>
        <span class="post-time">
        <?= date('d.m.Y H:i', $post['post_time']) ?>
            </span>
    <?php endif; ?>
</div>