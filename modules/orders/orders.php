<div class="orders">
    <?php
    if (isset($_GET["a"]) && !empty($_GET["a"])) {
        switch ($_GET["a"]) {
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