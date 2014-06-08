<?php
    ini_set('display_errors',true);
    $object_user = new user();
    $user_list = $object_user->returnAllUsers();
?>
<div class="user-list">
    <div class="button-area">
        <button onclick="goTo('./backoffice.php?pg=user-add');" class="green"><?php print $language["template"]["add"] ?></button>  
		<button onclick="buttonAction ('Confirma?','user-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('Confirma?','user-del');" class="red"><?php print $language["template"]["del"] ?></button>
	</div>
    
    <table class="db-list">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Rank</th>
            <th>Sel.</th>
        </tr>
        <?php
            foreach($user_list as $user){
                print 
                '<tr>'.
                '<td>'.$user['id'].'</td>'.
                '<td>'.$user['name'].'</td>'.
                '<td>'.$user['rank'].'</td>'.
                '<td><input type="radio" name="user" value="'.$user['id'].'"/></td>'.
                '</tr>';
            }
        ?>
    </table>
    
    <div class="button-area">
    	<button onclick="goTo('./backoffice.php?pg=user-add');" class="green"><?php print $language["template"]["add"] ?></button>  
		<button onclick="buttonAction ('Confirma?','user-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('Confirma?','user-del');" class="red"><?php print $language["template"]["del"] ?></button>
	</div>

</div>