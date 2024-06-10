<li class="features-posts__item">
    <img class="features-posts__image" src="/static/img/<?= $post['card_image_url'] ?>" alt="<?= $post['title'] ?>">
    <a class="features-posts__link" href="/post?id=<?= $post['id'] ?>">
        <div class="features-posts__title"><?= $post['title'] ?></div>
        <div class="features-posts__undertitle"><?= $post['subtitle'] ?></div>
        <div class="features-posts__info">
            <img class="features-posts__image-author" src="/static/img/<?= $post['author_url'] ?>" alt="<?= $post['author'] ?>">
            <div class="features-posts__name-author"><?= $post['author'] ?></div>
            <div class="features-posts__publication-date"><?= date("F d, Y", strtotime($post['publish_date'])) ?></div>
        </div>
    </a>
</li>