<div class="article">
    <?php
    if ($a != null) {
        switch ($a) {
            case "add": include "./modules/article/add.php";
				break;
            case "delete": include "./modules/article/delete.php";
				break;
            case "edit": include "./modules/article/edit.php";
                break;
            default: include "./modules/article/list.php";
        }
    } else {
        include "./modules/article/list.php";
    }
    ?>
</div>
