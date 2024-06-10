<li class="most-recent__item">
    <a class="most-recent__link" href="/post?id=<?= $post['id'] ?>">
        <img class="most-recent__image" src="/static/img/<?= $post['card_image_url'] ?>" alt="<?= $post['title'] ?>">
        <div class="most-recent__about">
            <div class="most-recent__title"><?= $post['title'] ?></div>
            <div class="most-recent__undertitle"><?= $post['subtitle'] ?></div>
        </div>
        <div class="most-recent__dividing-strip"></div>
        <div class="most-recent__publication-info">
            <img class="most-recent__image-author" src="static/img/<?=$post['author_url'] ?>" alt="<?= $post['author'] ?>">
            <div class="most-recent__name-author"><?= $post['author'] ?></div>
            <div class="most-recent__publication-date"><?= date("m/d/Y", strtotime($post['publish_date'])) ?></div>
        </div>
    </a>
</li>          