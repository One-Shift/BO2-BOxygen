<div class="orders">
    <?php
    if ($a != null) {
        switch ($a) {
            case "enable": break;
            case "disable": break;
            case "answer": include "./modules/orders/answer.php";
                break;
            default: include "./modules/orders/list.php";
        }
    } else {
        include "./modules/orders/list.php";
    }
    ?>
</div>