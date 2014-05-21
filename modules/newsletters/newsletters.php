<?php
    $object_newsletters = new newsletters();
    $newsletters = $object_newsletters->returnAllregistries();
?>
<div class="category-list">
    <div class="button-area">
        <button onclick="goTo('./backoffice.php?pg=category-add');" class="green"><?php print $language["template"]["add"] ?></button>
        <button onclick="buttonAction ('Confirma?','category-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
        <button onclick="buttonAction ('Confirma?','category-del');" class="red"><?php print $language["template"]["del"] ?></button>
    </div>

    <table class="db-list">
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Code</th>
            <th>Date</th>
        </tr>
        <?php
            foreach($category_list as $category){
                if ($category['published']) {$published = '<img src="./site-assets/images/icon_on.png" alt="on" />';}
                    else {$published = '<img src="./site-assets/images/icon_off.png" alt="off" />';}
                print
                '<tr>'.
                '<td>'.$newsletters['id'].'</td>'.
                '<td>'.$newsletters['email'].'</td>'.
                '<td>'.$newsletters['code'].'</td>'.
                '<td>'.$newsletters['date'].'</td>'.
                '<td><input type="radio" name="category" value="'.$category['id'].'"/></td>'.
                '</tr>';

            }
        ?>
    </table>

    <div class="button-area">
        <button onclick="goTo('./backoffice.php?pg=category-add');" class="green"><?php print $language["template"]["add"] ?></button>
        <button onclick="buttonAction ('Confirma?','category-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
        <button onclick="buttonAction ('Confirma?','category-del');" class="red"><?php print $language["template"]["del"] ?></button>
    </div>

</div>
