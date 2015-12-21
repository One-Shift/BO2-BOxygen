<div class="category">
    <?php
    if ($a != null) {
        switch ($a) {
            case "add": include "./modules/category/add.php";
				break;
            case "delete": include "./modules/category/delete.php";
				break;
            case "edit": include "./modules/category/edit.php";
                break;
            default: include "./modules/category/list.php";
        }
    } else {
        include "./modules/category/list.php";
    }
    ?>
</div>
