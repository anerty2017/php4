<div class="col-md-3">
    <h3 class="my-4">Поиск</h3>
    <div>
        <form class="form-inline" action="search.php">
            <input name="query" class="form-control mr-sm-2" type="search" placeholder="Введите фразу..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Искать</button>
        </form>

    </div>
    <h3 class="my-4">Категории</h3>
    <div class="list-group">
        <? foreach ($categories as $category):?>
            <a href="category.php?cat_id=<?= $category['cat_id'] ?>" class="list-group-item list-group-item-action">
                <?= $category['name'] ?>
            </a>
        <? endforeach; ?>
    </div>
</div>