<?php
    include("../inc/function.php");
    include("../inc/connection.php");
    $connex = connect();

    if(isset($_GET['a'])) {
        $a = $_GET['a'];
    
        if($a == 0) {
            resetScore($connex);
        } else if($a == 1) {
            $group = selectGroup($connex);
            for ($i = 0; $i < count($group); $i++) {
                generateMatch($group[$i], $connex);
            }
        }
    }
    header("location:../match.php");
?>