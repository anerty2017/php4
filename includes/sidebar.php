<div class="col-md-3">
    <h3 class="my-4">Категории</h3>
    <div class="list-group">
        <? foreach ($sidebarMenu as $row):?>
            <a href="/index.php?category_id=<?=$row['id'];?>" class="list-group-item list-group-item-action" title="<?=$row['description'];?>">
                <?= $row['name'] ?>
            </a>
        <? endforeach; ?>
    </div>
</div>