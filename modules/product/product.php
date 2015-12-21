<div class="product">
    <?php
    if ($a != null) {
        switch ($a) {
            case "add": include "modules/product/add.php";
				break;
            case "delete": include "modules/product/delete.php";
				break;
            case "edit": include "modules/product/edit.php";
                break;
            default: include "modules/product/list.php";
        }
    } else {
        include "modules/product/list.php";
    }
    ?>
</div>
