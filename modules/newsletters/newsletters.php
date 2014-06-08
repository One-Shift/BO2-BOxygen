<?php
    $object_newsletters = new newsletters();
    $newsletters_list = $object_newsletters->returnAllregistries();
?>
<div class="category-list">
    <div class="button-area">
        <button onclick="goTo('./backoffice.php?pg=category-add');" class="green"><?php print $language["template"]["enable"] ?></button>
        <button onclick="buttonAction ('Confirma?','category-edit');" class="red"><?php print $language["template"]["disable"] ?></button>
    </div>

    <table class="db-list">
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Code</th>
            <th>Stat.</th>
            <th>Sel.</th>
        </tr>
        <?php
            foreach($newsletters_list as $newsletter_entry){
                if ($newsletter_entry['active']) {
                    $active = '<img src="./site-assets/images/icon_on.png" alt="on" />';
                } else {
                    $active = '<img src="./site-assets/images/icon_off.png" alt="off" />'; 
                }

                print
                '<tr title="'.$newsletter_entry['date'].'">'.
                '<td>'.$newsletter_entry['id'].'</td>'.
                '<td>'.$newsletter_entry['email'].'</td>'.
                '<td>'.$newsletter_entry['code'].'</td>'.
                '<td>'.$active.'</td>'.
                '<td><input type="radio" name="category" value="'.$newsletter_entry['id'].'"/></td>'.
                '</tr>';

            }
        ?>
    </table>

    <div class="button-area">
        <button onclick="goTo('./backoffice.php?pg=category-add');" class="green"><?php print $language["template"]["enable"] ?></button>
        <button onclick="buttonAction ('Confirma?','category-edit');" class="red"><?php print $language["template"]["disable"] ?></button>
    </div>

</div>