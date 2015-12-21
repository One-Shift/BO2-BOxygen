<div class="controller-file">
    <?php
    if ($a != null) {
        switch ($a) {
            case "delete": include "modules/controller-file/del.php";
				break;
            case "edit": include "modules/controller-file/edit.php";
                break;
            default: include "modules/controller-file/list.php";
        }
    } else {
        include "modules/controller-file/list.php";
    }
    ?>
</div>
