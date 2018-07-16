<?php
function seachies($news1, $news2, $area, $year)
{
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
    $midle1 = "from noticia where not_texto LIKE '%"
            . $news1 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $end1 = "group by not_texto";
    $SQL = $start1 . $midle1 . $end1;        
    $qtd1 = 0;
    $midle11 = "from noticia where not_texto LIKE '%"
            . $news2 . "%' and regiao_id in ('"
            . $area . "') and YEAR(not_data) = '"
            . $year . "' ";
    $SQL2 = $start1 . $midle11 . $end1;        
    $qtd2 = 0;

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

    $result2 = $mysqli->query($SQL2);
    while ($RF = $result2->fetch_assoc()) {
        $qtd2 = $qtd2+$RF['QTD'];
    }

    $start2 = "select not_texto, not_resumo ";
    $end2 = "ORDER BY not_data DESC LIMIT 10";
    $SQL = $start2 . $midle1 . $end2;
    $SQL2 = $start2 . $midle11 . $end2;
    $result = $mysqli->query($SQL);
    $result2 = $mysqli->query($SQL2);
    $results1 ='';
    while ($RF = $result->fetch_assoc()) {
        $results1 = $results1 . '<li>' . $RF['not_resumo'] . '</li><br>';
    }
    $results2 ='';
    while ($RF = $result2->fetch_assoc()) {
        $results2 = $results2 . '<li>' . $RF['not_resumo'] . '</li><br>';
    }
    $array = array($qtd1, $results1, $qtd2, $results2);

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

    function geraGrafico($largura, $altura, $valores, $referencias, $tipo = "p3"){
        $valores = implode(',', $valores);
        $referencias = implode('|', $referencias);
        return "http://chart.apis.google.com/chart?chs=". $largura ."x". $altura . "&amp;chd=t:" . $valores . "&amp;cht=p3&amp;chl=" . $referencias;
    }
?>