<?
    if(isset($_GET['allPages'])){
        $allPage =$_GET['allPages'];
    }
    if(isset($_GET['pageNum'])){
        $pageNum =$_GET['pageNum'];
    }
?>

<ul class="pagination justify-content-center">

    <?php if($pageNum > 1) { ?>
        <li class="page-item">
            <a class="page-link" href="/index.php?page=<?=$pageNum-1;?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php } ?>

    <?php for($i = 1; $i<=$allPage; $i++) { ?>
        <li class="page-item">
            <a class="page-link" href="/index.php?page=<?=$i;?>"><?=$i;?></a>
        </li>
    <?php } ?>

    <?php if($pageNum < $allPage) { ?>
        <li class="page-item">
            <a class="page-link" href="/index.php?page=<?=$pageNum+1;?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>

    <?php } ?>

</ul>
