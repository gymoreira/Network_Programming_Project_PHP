<!DOCTYPE html>
<html>
    <head>
        <title>Not&iacute;cias / Estat&iacute;sticas</title>
        <meta charset="iso-8859-1">
        <link rel="stylesheet" href="style.css" media="all" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                    <option value="0" value2="BR" value1="Brasil">Brasil (BR)</option>
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
                    <!--<option value="0" value2="PI" value1="Piaui">Piau&iacute; (PI)</option>-->
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
                    alert('VocÃª precisa preencher o campo de pesquisa');erro = true;
                }
                if($('#area').val() == '' && !erro)
                {
                    alert('VocÃª precisa preencher o campo area');erro = true;
                }
                if($('#year').val() == '' && !erro)
                {
                    alert('VocÃª precisa preencher o campo Ano');erro = true;
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
            if(!isset($_POST['news1'])){
                $_POST['news1']= '';
                $_POST['news2']= '';
                $_POST['area']= '';
                $_POST['year']= '';        
            }
            //$array = seachies($_POST['news1'], $_POST['news2'], $_POST['area'], $_POST['year']);
            $array1 = seach1($_POST['news1'], $_POST['area'], $_POST['year']);
            $array2 = seach2($_POST['news2'], $_POST['area'], $_POST['year']);
            if ($array1[0]!==0 or $array2[0] !==0){
                //$grafico = geraGrafico(512, 200, array($array1[0] , $array2[0]), array($_POST['news1'] . "(" . $array1[0] . ")", $_POST['news2'] . "(" . $array2[0] . ")"));
                //echo '<img src="' . $grafico . '"/>';                    
            }
            echo "<br><br><br>";
            //echo $array[0];
            //echo $array[1];
            // echo $array[2];
            //echo $array[3];
        ?> 
        <script type="text/javascript">
            //carregando modulo visualization
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            //função de monta e desenha o gráfico
            function drawChart() {
                //variavel com armazenamos os dados, um array de array's 
                //no qual a primeira posição são os nomes das colunas
                var data = google.visualization.arrayToDataTable([
                ['Noticia', 'Quantidade'],
                ['<?php echo $_POST['news1'];?>',     <?php echo $array1[0];?>],
                ['<?php echo $_POST['news2'];?>',     <?php echo $array2[0];?>]
                ]);
                //opções para exibição do gráfico
                var options = {
                title: '',//titulo do gráfico
                pieHole: 0.4, // false para 2d e true para 3d o padrão é false
                };
                //cria novo objeto PeiChart que recebe 
                //como parâmetro uma div onde o gráfico será desenhado
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                //desenha passando os dados e as opções
                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Mes', '<?php echo $_POST['news1'];?>', '<?php echo $_POST['news2'];?>'],
                ['JAN', <?php echo $array1[1];?>, <?php echo $array2[1];?>],
                ['FEV', <?php echo $array1[2];?>, <?php echo $array2[2];?>],
                ['MAR', <?php echo $array1[3];?>, <?php echo $array2[3];?>],
                ['ABR', <?php echo $array1[4];?>, <?php echo $array2[4];?>],
                ['MAI', <?php echo $array1[5];?>, <?php echo $array2[5];?>],
                ['JUN', <?php echo $array1[6];?>, <?php echo $array2[6];?>],
                ['JUL', <?php echo $array1[7];?>, <?php echo $array2[7];?>],
                ['AGO', <?php echo $array1[8];?>, <?php echo $array2[8];?>],
                ['SET', <?php echo $array1[9];?>, <?php echo $array2[9];?>],
                ['OUT', <?php echo $array1[10];?>, <?php echo $array2[10];?>],
                ['NOV', <?php echo $array1[11];?>, <?php echo $array2[11];?>],
                ['DEZ', <?php echo $array1[12];?>, <?php echo $array2[12];?>]
                ]);
                var options = {
                chart: {
                title: 'Quantidades de Noticias Sobre:',
                subtitle: '<?php echo $_POST['news1'];?>, <?php echo $_POST['news2'];?> em <?php echo $_POST['year'];?>',
                },
                vAxis: {format: 'decimal'}
                };
                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>    
        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
        <br><br><br>
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </body>
</html>