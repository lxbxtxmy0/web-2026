INSERT INTO
    users (
           first_name,
           last_name,
           avatar_source,
           bio
    )
VALUES (
    'Ваня',
    'Денисов',
    'img/avatar_vanya.svg',
    'Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!'
),
(
    'Лиза',
    'Дёмина',
    'img/avatar_lisa.svg',
    NULL
);

INSERT INTO
  posts (
        user_id,
        published_at,
        description,
        count_likes
    )
VALUES (
    (SELECT user_id FROM user WHERE first_name ='Ваня' AND last_name),
    '2025-03-01 13:00:00',
    'Так красиво сегодня на улице! Настоящая зима))
    Вспоминается Бродский: «Поздно ночью, в уснувшей долине,
    на самом дне, в городке, занесенном снегом по ручку двери...»',
    203
),
(
    2,
    '2025-04-01 13:00:00',
    NULL,
    0
);

INSERT INTO
    images (
         image_source,
         sort_order,
         post_id
    )
VALUES (
    'img/snowy_street.jpg',
    0,
    1
),
(
    'img/fish.jpg',
    0,
    2
);

insert into image (image_source, sort_order, post_id) values ('img/hpi.jpg', 3, 1);

update post set description = 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...»' where id = 1;

