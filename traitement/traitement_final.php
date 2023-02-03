<?php
    include("../inc/function.php");
    include("../inc/connection.php");
    $connex = connect();

    if(isset($_GET['a'])) {
        resetWinner($connex);
    }
    if(count(selectNFinal(8, $connex)) == 1) {
        generateMatchHuitFinal($connex);
    }

    header("location:../tournoi.php");
?>