<?php

    function connect() {
        $user = "rjtoky";
        $pass = "toky141204";
        $dbname = "rjtoky_cdm";
        $dsn = 'pgsql:host=postgresql-rjtoky.alwaysdata.net;port=5432;dbname='.$dbname;

        $connex = new PDO($dsn, $user, $pass);
        return $connex;
    }
    
?>