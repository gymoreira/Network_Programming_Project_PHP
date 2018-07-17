<?php
function seachies($news1, $news2, $area, $year){
    
    $servidor = 'localhost';
    $banco    = 'exa899';
    $usuario  = 'root';
    $senha    = '';
    $mysqli   = new mysqli($servidor, $usuario, $senha, $banco);    
    $results1 = $results2 ='';
    $qtd1 = $qtd2 = $jan = $fev = $mar = $abr = $mai = $jun = $jul = $ago = $set = $out = $nov = $dez= 0;
    $array = array($qtd1, $jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $set, $out, $nov, $dez, $results1, $results2, $qtd2);    if(!$mysqli){
        echo "erro ao conectar ao banco de dados!\n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
    }
    $start1 = "select not_texto, COUNT(not_texto) as QTD ";
    $midle1 = "from noticia where not_texto LIKE '%"
            . $news1 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $end1 = "group by not_texto";
    $SQL = $start1 . $midle1 . $end1;
    $midle11 = "from noticia where not_texto LIKE '%"
            . $news2 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $SQL2 = $start1 . $midle11 . $end1;

   // echo $SQL;
    if (!$result = $mysqli->query($SQL)) {
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $SQL . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }       
    while ($RF = $result->fetch_assoc()) {
        $qtd1 = $qtd1+$RF['QTD'];
    }
    $array[0]= $qtd1;
    $result2 = $mysqli->query($SQL2);
    while ($RF = $result2->fetch_assoc()) {
        $qtd2 = $qtd2+$RF['QTD'];
    }
    $array[15]= $qtd2;
    $start2 = "select not_texto, not_resumo ";
    $end2 = "ORDER BY not_data DESC LIMIT 10";
    $SQL = $start2 . $midle1 . $end2;
    $SQL2 = $start2 . $midle11 . $end2;
    $result = $mysqli->query($SQL);
    $result2 = $mysqli->query($SQL2);
    while ($RF = $result->fetch_assoc()) {
        $results1 = $results1 . '<li>' . $RF['not_resumo'] . '</li><br>';
    }
    $array[13]= $results1;
    while ($RF = $result2->fetch_assoc()) {
        $results2 = $results2 . '<li>' . $RF['not_resumo'] . '</li><br>';
    }
    $array[14]= $results2;
    /*<!--
    echo "Quantity1: " . $qtd1 . "<br>";
    echo $results1;
    echo "Quantity2: " . $qtd2 . "<br>";
    echo $results2;
    -->*/
    $result->free();
    $result2->free();
    $mysqli->close();
    return $array;
}
    
function seach1($news1, $area, $year){
    
    $servidor = 'localhost';
    $banco    = 'exa899';
    $usuario  = 'root';
    $senha    = '';
    $mysqli   = new mysqli($servidor, $usuario, $senha, $banco);
    $results1 ='';
    $qtd1 = $jan = $fev = $mar = $abr = $mai = $jun = $jul = $ago = $set = $out = $nov = $dez= 0;
    $array1 = array($qtd1, $jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $set, $out, $nov, $dez, $results1);
    if(!$mysqli){
        echo "erro ao conectar ao banco de dados!\n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
    }
    $start1 = "select not_texto, COUNT(not_texto) as QTD ";
    $midle11 = "from noticia where not_texto LIKE '%"
            . $news1 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $end1 = "group by not_texto";    
    //select not_texto, COUNT(not_texto) as QTD from noticia where not_texto LIKE '%deputado%' and regiao_id in ('39,40') and YEAR(not_data) = '2018' group by not_texto
    $SQL1 = $start1 . $midle11 . $end1;
    // echo $SQL;
    if (!$result = $mysqli->query($SQL1)) {
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $SQL1 . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }       
    while ($RF = $result->fetch_assoc()) {
        $qtd1 = $qtd1+$RF['QTD'];
    }
    $array1[0] = $qtd1;
    $SQLANO = "CREATE VIEW ANO AS SELECT not_data FROM noticia where not_texto LIKE '%"
            . $news1 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    //CREATE VIEW ANO AS SELECT not_data FROM noticia where not_texto LIKE '%policia%' and regiao_id in ('39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51') and YEAR(not_data) = '2018'
    $mysqli->query($SQLANO);
    for ($i = 1; $i <= 12; $i++) {
        $SQLmes ="select not_data, COUNT(not_data) as QTD FROM ano "
            . "where month(not_data) = '"
            . $i . "' group by not_data";
        $resultmes = $mysqli->query($SQLmes);
        while ($RF = $resultmes->fetch_assoc()) {
            $array1[$i] = $array1[$i]+$RF['QTD'];
        }
    }
    $mysqli->query("DROP VIEW ANO");
    $start2 = "select not_texto, not_resumo ";
    $end2 = "ORDER BY not_data DESC LIMIT 10";
    $SQL1 = $start2 . $midle11 . $end2;
    $result1 = $mysqli->query($SQL1);    
    while ($RF = $result1->fetch_assoc()) {
        $results1 = $results1 . '<li>' . $RF['not_resumo'] . '</li><br>';
    }
    $array1[13] = $results1;
    /*<!--
    echo "Quantity1: " . $qtd1 . "<br>";
    echo $results1;
    echo "Quantity2: " . $qtd2 . "<br>";
    echo $results2;
    -->*/
    $result->free();
    $result1->free();
    $mysqli->close();
    return $array1;
}
    
function seach2($news2, $area, $year){
    
    $results2 ='';
    $qtd2 = $jan = $fev = $mar = $abr = $mai = $jun = $jul = $ago = $set = $out = $nov = $dez= 0;
    $array2 = array($qtd2, $jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $set, $out, $nov, $dez, $results2);
    if($news2===''){
        return $array2;
    }    
    $servidor = 'localhost';
    $banco    = 'exa899';
    $usuario  = 'root';
    $senha    = '';
    $mysqli   = new mysqli($servidor, $usuario, $senha, $banco);
    if(!$mysqli){
        echo "erro ao conectar ao banco de dados!\n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
    }
    $start1 = "select not_texto, COUNT(not_texto) as QTD ";
    $end1 = "group by not_texto";
    $midle11 = "from noticia where not_texto LIKE '%"
            . $news2 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $SQL2 = $start1 . $midle11 . $end1;
    // echo $SQL;
    if (!$result = $mysqli->query($SQL2)) {
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $SQL2 . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }       
    while ($RF = $result->fetch_assoc()) {
        $qtd2 = $qtd2+$RF['QTD'];
    }
    $array2[0] = $qtd2;
    $SQLANO = "CREATE VIEW ANO AS SELECT not_data FROM noticia where not_texto LIKE '%"
            . $news2 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $mysqli->query($SQLANO);
    for ($i = 1; $i <= 12; $i++) {
        $SQLmes ="select not_data, COUNT(not_data) as QTD FROM ano "
            . "where month(not_data) = '"
            . $i . "' group by not_data";
        $resultmes = $mysqli->query($SQLmes);
        while ($RF = $resultmes->fetch_assoc()) {
            $array2[$i] = $array2[$i]+$RF['QTD'];
        }
    }
    $mysqli->query("DROP VIEW ANO");
    $start2 = "select not_texto, not_resumo ";
    $end2 = "ORDER BY not_data DESC LIMIT 10";
    $SQL2 = $start2 . $midle11 . $end2;
    $result2 = $mysqli->query($SQL2);    
    while ($RF = $result2->fetch_assoc()) {
        $results2 = $results2 . '<li>' . $RF['not_resumo'] . '</li><br>';
    }
    $array1[13] = $results2;
    /*<!--
    echo "Quantity1: " . $qtd1 . "<br>";
    echo $results1;
    echo "Quantity2: " . $qtd2 . "<br>";
    echo $results2;
    -->*/
    $result->free();
    $result2->free();
    $mysqli->close();
    return $array2;
}

    function geraGrafico($largura, $altura, $valores, $referencias, $tipo = "p3"){
        $valores = implode(',', $valores);
        $referencias = implode('|', $referencias);
        return "http://chart.apis.google.com/chart?chs=". $largura ."x". $altura . "&amp;chd=t:" . $valores . "&amp;cht=p3&amp;chl=" . $referencias;
    }
?>