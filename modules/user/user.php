<div class="user">
    <?php
    if ($a != null) {
        switch ($a) {
            case "add": include "modules/user/add.php";
				break;
            case "delete": include "modules/user/delete.php";
				break;
            case "edit": include "modules/user/edit.php";
                break;
            default: include "modules/user/list.php";
        }
    } else {
        include "modules/user/list.php";
    }
    ?>
</div>
