<?php
    function selectGroup($connex) {
        $res = $connex->query('SELECT DISTINCT groupe FROM "public"."Pays" ORDER BY groupe ASC');

        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($line = $res->fetch()) {
            $tab[] = $line->groupe;
        }
        $res->closeCursor();

        return $tab;
    }

    function selectPays($groupe, $connex) {
        $res = $connex->query('SELECT * FROM "public"."Pays" WHERE groupe = \''. $groupe .'\' ORDER BY "public"."Pays"."idPays" ASC');

        $res->setFetchMode(PDO::FETCH_ASSOC);
        $tab = array();

        $col = array("idPays", "nom", "groupe", "points");

        $tabs[] = array();
        while ($line = $res->fetch()) {
            $tab = array();
            for ($i = 0; $i < count($col); $i++) {
                array_push($tab, $line[$col[$i]]);
            }
            array_push($tabs, $tab);
        }
        $res->closeCursor();

        return $tabs;
    }

    function generateMatch($groupe, $connex) {
        $pays = selectPays($groupe, $connex);

        for($i = 1; $i < count($pays); $i++) {
            for ($j = $i+1; $j < count($pays); $j++) {
                insertMatch($pays[$i][0], $pays[$j][0], rand(0, 7), rand(0, 7), $groupe, $connex);
            }
        }

        $match = selectMatch($groupe);
        for ($i = 1; $i < count($match); $i++) {
            if($match[$i][3] > $match[$i][4]) {
                updatePoint($match[$i][1], 3, $connex);
            } elseif ($match[$i][3] < $match[$i][4]) {
                updatePoint($match[$i][2], 3, $connex);
            } else {
                updatePoint($match[$i][1], 1, $connex);
                updatePoint($match[$i][2], 1, $connex);
            }
        }
    }

    function selectMatch($groupe) {
        $connex = connect();
        $res = $connex->query('SELECT * FROM "public"."Match" WHERE groupe = \'' . $groupe . '\'');

        $res->setFetchMode(PDO::FETCH_ASSOC);
        $tab = array();

        $col = array("idMatch", "idP1", "idP2", "points1", "points2", "groupe");

        $tabs[] = array();
        while ($line = $res->fetch()) {
            $tab = array();
            for ($i = 0; $i < count($col); $i++) {
                array_push($tab, $line[$col[$i]]);
            }
            array_push($tabs, $tab);
        }
        $res->closeCursor();

        return $tabs;
    }

    function selectMatchAll() {
        $connex = connect();
        $res = $connex->query('SELECT * FROM "public"."Match"');

        $res->setFetchMode(PDO::FETCH_ASSOC);
        $tab = array();

        $col = array("idMatch", "idP1", "idP2", "points1", "points2");

        $tabs[] = array();
        while ($line = $res->fetch()) {
            $tab = array();
            for ($i = 0; $i < count($col); $i++) {
                array_push($tab, $line[$col[$i]]);
            }
            array_push($tabs, $tab);
        }
        $res->closeCursor();

        return $tabs;
    }

    function insertMatch($idP1, $idP2, $pointP1, $pointP2, $groupe, $connex) {
        $sql = 'INSERT INTO "public"."Match" VALUES (nextVal(\'"public"."seqMatch"\'), %s, %s, %s, %s, \'%s\')';
        $sql = sprintf($sql, $idP1, $idP2, $pointP1, $pointP2, $groupe);

        $connex->exec($sql);
    }

    function updatePoint($idpays, $point, $connex) {
        $sql = 'UPDATE "public"."Pays" SET points = points + %s WHERE "public"."Pays"."idPays" = %s';
        $sql = sprintf($sql, $point, $idpays);

        $connex->exec($sql);
    }

    function getNomPays($idpays, $connex) {
        $res = $connex->query('SELECT * FROM "public"."Pays" WHERE "public"."Pays"."idPays"=' . $idpays);

        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($line = $res->fetch()) {
            $tab[] = $line->nom;
        }
        $res->closeCursor();

        return $tab[0];
    }

    function resetScore($connex) {

        $sql = 'DELETE FROM "public"."Match" WHERE "public"."Match"."idMatch" != 0';
        $connex->exec($sql);

        $sql = 'UPDATE "public"."Pays" SET points = 0 WHERE "public"."Pays"."idPays" != 0';
        $connex->exec($sql);
    }

    function getClassement($groupe, $connex) {
        $res = $connex->query('SELECT * FROM "public"."Pays" WHERE "public"."Pays"."groupe" = \'' . $groupe . '\' ORDER BY "public"."Pays"."points" DESC');

        $res->setFetchMode(PDO::FETCH_ASSOC);
        $tab = array();

        $col = array("idPays", "nom", "groupe", "points");

        $tabs[] = array();
        while ($line = $res->fetch()) {
            $tab = array();
            for ($i = 0; $i < count($col); $i++) {
                array_push($tab, $line[$col[$i]]);
            }
            array_push($tabs, $tab);
        }
        $res->closeCursor();

        return $tabs;
    }

    function getQualifie($groupe, $connex) {
        $res = $connex->query('SELECT * FROM "public"."Pays" WHERE "public"."Pays"."groupe" = \'' . $groupe . '\' ORDER BY "public"."Pays"."points" DESC LIMIT 2');

        $res->setFetchMode(PDO::FETCH_ASSOC);
        $tab = array();

        $col = array("idPays", "nom", "groupe", "points");

        $tabs[] = array();
        while ($line = $res->fetch()) {
            $tab = array();
            for ($i = 0; $i < count($col); $i++) {
                array_push($tab, $line[$col[$i]]);
            }
            array_push($tabs, $tab);
        }
        $res->closeCursor();

        return $tabs;
    }

    function insertMatchFinal($idP1, $idP2, $pointP1, $pointP2, $nFinal, $date, $connex) {

        $sql = 'INSERT INTO "public"."Tournoi" VALUES (nextVal(\'"public"."seqTournoi"\'), \'%s\', %s, %s, %s, %s, %s)';
        $sql = sprintf($sql, $date, $nFinal, $idP1, $idP2, $pointP1, $pointP2);

        $connex->exec($sql);
    }

    function getAllQualifiePool($connex) {
        $groupe = selectGroup($connex);
        for ($i=0; $i < count($groupe); $i++) {
            $allQualifie[] = getQualifie($groupe[$i], $connex);
        }
        return $allQualifie;
    }

    function generateMatchHuitFinal($connex) {
        $allQualifie = getAllQualifiePool($connex);

        insertMatchFinal($allQualifie[0][1][0], $allQualifie[1][2][0], rand(0,7), rand(0,7), 8, "03/12/22", $connex);
        insertMatchFinal($allQualifie[2][1][0], $allQualifie[3][2][0], rand(0,7), rand(0,7), 8, "03/12/22", $connex);
        insertMatchFinal($allQualifie[4][1][0], $allQualifie[5][2][0], rand(0,7), rand(0,7), 8, "05/12/22", $connex);
        insertMatchFinal($allQualifie[6][1][0], $allQualifie[7][2][0], rand(0,7), rand(0,7), 8, "05/12/22", $connex);

        insertMatchFinal($allQualifie[0][2][0], $allQualifie[1][1][0], rand(0,7), rand(0,7), 8, "04/12/22", $connex);
        insertMatchFinal($allQualifie[2][2][0], $allQualifie[3][1][0], rand(0,7), rand(0,7), 8, "04/12/22", $connex);
        insertMatchFinal($allQualifie[4][2][0], $allQualifie[5][1][0], rand(0,7), rand(0,7), 8, "06/12/22", $connex);
        insertMatchFinal($allQualifie[6][2][0], $allQualifie[7][1][0], rand(0,7), rand(0,7), 8, "06/12/22", $connex);
    }

    function selectNFinal($nFinal, $connex) {

        $res = $connex->query('SELECT * FROM "public"."Tournoi" WHERE "public"."Tournoi"."nFinal" = ' . $nFinal);

        $res->setFetchMode(PDO::FETCH_ASSOC);
        $tab = array();

        $col = array("idTournoi", "tdate", "nFinal", "idP1", "idP2", "points1", "points2");

        $tabs[] = array();
        while ($line = $res->fetch()) {
            $tab = array();
            for ($i = 0; $i < count($col); $i++) {
                array_push($tab, $line[$col[$i]]);
            }
            array_push($tabs, $tab);
        }
        $res->closeCursor();

        return $tabs;
    }

    function resetWinner($connex) {

        $sql = 'DELETE FROM "public"."Tournoi"';

        $connex->exec($sql);
    }

?>