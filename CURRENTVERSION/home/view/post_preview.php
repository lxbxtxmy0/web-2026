<div class="post">
    <div class="header_of_post">
        <div class="author">
            <img src="../src/<?= $post['avatar_image'] ?>" alt="Аватар" height="32" width="32" class="photo_avatar">
            <a href="<?php if ($post['can_edit']) echo '../profile' ?>"><?= htmlspecialchars($post['author']) ?></a>
        </div>
        <?php if ($post['can_edit']): ?>
            <a href="../createpost/?id=<?= $post['id']?>">
                <img src="../src/img/edit_icon.svg" alt="Редактирование публикации" height="24" width="24">
            </a>
        <?php endif; ?>
    </div>
    <div class="photo">
        <div class="photos">
            <?php foreach ($post['images'] as $image): ?>
                <img src="<?= $image['image_source'] ?>" alt="<?= $post['img_alt'] ?>" height="474" width="474">
            <?php endforeach; ?>
        </div>
        <?php if (count($post['images']) > 1): ?>
            <span class="count_photos"></span>
            <button type="button" class="slider_left">
                <img src="../src/img/left_button.svg" alt="Предыдущее фото" height="10" width="10">
            </button>
            <button type="button" class="slider_right">
                <img src="../src/img/right_button.svg" alt="Следуещее фото" height="10" width="10">
            </button>
        <?php endif; ?>
    </div>
    <button type="button" class="like">
        <img src="../src/img/heart_icon.png" alt="like" height="15" width="15" class="like_icon">
        <span><?= $post['count_likes'] ?></span>
    </button>
    <div class="info">
        <div>
            <p class="description">
                <?= htmlspecialchars($post['description']) ?>
            </p>
            <button type="button" class="more">еще</button>
        </div>

        <span class="time">
            <?= date('d.m.Y H:i', $post['post_time']) ?>
        </span>
    </div>
</div>