<!DOCTYPE html>
<html>
    <head>
        <title>Not&iacute;cias / Estat&iacute;sticas</title>
        <meta charset="iso-8859-1">
        <link rel="stylesheet" href="style.css" media="all" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     </head>
    <body>
        <H2 align="center">Estat&iacute;sticas de not&iacute;cias</H2><HR><br>
        <form method="post" id="form_news" onsubmit="validaForm(); return false;" class="form">
            <p>
                Procurar por: <br>
                <input type="text" size="26" name="news1" id="news1"><br><br>
                <input type="text" size="26" name="news2" id="news2"><br><br>

                <select class="basic simple" name="area" id="area">
                    <option value="" >Escolha um estado:</option>
                    <option value="1" value2="AC" value1="Acre">Acre (AC)</option>
                    <option value="2" value2="AL" value1="Alagoas">Alagoas (AL)</option>
                    <option value="3" value2="AP" value1="Amapa">Amap&aacute; (AP)</option>
                    <option value="4" value2="AM" value1="Amazonas">Amazonas (AM)</option>
                    <option value="5" value2="BA" value1="Bahia">Bahia (BA)</option>
                    <option value="6" value="CE" value1="Ceara">Cear&aacute; (CE)</option>
                    <option value="7" value2="DF" value1="Distrito Federal">Distrito Federal (DF)</option>
                    <option value="8" value2="ES" value1="Espirito Santo">Esp&iacute;rito Santo (ES)</option>
                    <option value="9" value2="GO" value1="Goias">Goi&aacute;s (GO)</option>
                    <option value="10" value2="MA" value1="Maranhao">Maranh&atilde;o (MA)</option>
                    <option value="11" value2="MT" value1="Mato Grosso">Mato Grosso (MT) </option>
                    <option value="12" value2="MS" value1="Mato Grosso do Sul">Mato Grosso do Sul (MS)</option>
                    <option value="13, 14, 15, 16, 17, 18, 19" value2="MG" value1="Minas Gerais">Minas Gerais (MG)</option>
                     <option value="20" value2="PA" value1="Para">Par&aacute; (PA)</option>
                    <option value="21" value2="PB" value1="Paraiba">Para&iacute;ba (PB)</option>
                    <option value="22, 23, 24, 25" value2="PR" value1="Parana">Paran&aacute; (PR)</option>
                    <option value="26, 27, 28" value2="PE" value1="Pernambuco">Pernambuco (PE)</option>
                    <option value="0" value2="PI" value1="Piaui">Piau&iacute; (PI)</option>
                    <option value="29, 30, 31, 32, 33" value2="RJ" value1="Rio de Janeiro">Rio de Janeiro (RJ)</option>
                    <option value="34" value2="RN" value1="Rio Grande do Norte">Rio Grande do Norte (RN)</option>
                    <option value="35" value2="RS" value1="Rio Grande do Sul">Rio Grande do Sul (RS)</option>
                    <option value="36" value2="RO" value1="Rondonia">Rond&ocirc;nia (RO)</option>
                    <option value="37" value2="RR" value1="Roraima">Roraima (RR)</option>
                    <option value="38" value2="SC" value1="Santa Catarina">Santa Catarina (SC)</option>
                    <option value="39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51" value2="SP" value1="Sao Paulo">S&atilde;o Paulo (SP)</option>
                    <option value="52" value2="SE" value1="Sergipe">Sergipe (SE)</option>
                    <option value="53" value2="TO" value1="Tocantins">Tocantins (TO)</option>
                </select><br><br>

                <select class="basic simple" id="year" name="year">
                    <option value="" >Escolha um ano:</option>
                    <option value="2018" >2018</option>
                    <option value="2017" >2017</option>
                    <option value="2016" >2016</option>
                    <option value="2015" >2015</option>
                    <option value="2014" >2014</option>
                </select><br><br>

                <input type="submit" value="Pesquisar">
            </p>
        </form>
        <h1>Estat&iacute;stica:</h1>
        <script type="text/javascript">
            function validaForm()
            {
                erro = false;
                if($('#news1').val() == '')
                {
                    alert('Você precisa preencher o campo de pesquisa');erro = true;
                }
                if($('#area').val() == '' && !erro)
                {
                    alert('Você precisa preencher o campo area');erro = true;
                }
                if($('#year').val() == '' && !erro)
                {
                    alert('Você precisa preencher o campo Ano');erro = true;
                }

                //se nao tiver erros
                if(!erro)
                {
                    $('#form_news').submit();
                }
            }
        </script>
        <?php
            include 'funcao.php';
            
            if(!$_POST['news1']){
            $_POST['news1']= '';
            $_POST['news2']= '';
            $_POST['area']= '';
            $_POST['year']= '';        
        }
        $array = seachies($_POST['news1'], $_POST['news2'], $_POST['area'], $_POST['year']);        
        if ($array[0]!==0 or $array[2] !==0){
            $grafico = geraGrafico(500, 200, array($array[0] , $array[2]), array($_POST['news1'] . "(" . $array[0] . ")", $_POST['news2'] . "(" . $array[2] . ")"));
            echo '<img src="' . $grafico . '"/>';                    
        }
        echo "<br><br><br>";
        //echo $array[0];
        echo $array[1];
        // echo $array[2];
        echo $array[3];
    ?>        
    </body>
</html>