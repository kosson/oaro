<?php session_start() //porneste sesiunea?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Da-mi date bre!</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css"/>
        <link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui-1.8.24.custom.css"/>
        <link rel="stylesheet" type="text/css" href="../js/chosen/  .css"/>
        <script src="../js/jquery-1.8.2.min.js"></script>
        <script src="../js/jquery-ui-1.8.24.custom.min.js"></script>
        <script src="../js/global.js" type="text/javascript"></script>
        <script src="../js/chosen/chosen.jquery.js"></script>
        
    </head>
    <body>
        <div class="middle">
<?php
    require_once('../libs/homeRes.php');
    require_once ('../db/connect.php');
    require_once ('../libs/showMeData.php');
    
    //preluare date din POST
    //var_dump($_POST);
    $tara = $_REQUEST['country'];
    
    $sql1 = '
        SELECT 
        lau.id_lau,
        lau.name_orig
        FROM lau
        WHERE lau.id_country = "'.$tara.'"
        AND lau.activ = "1"    
        ';
    
    $sql2 = '
        SELECT
            id_depo_index,
            name
        FROM
            deposit_indexer
    ';
        
    $obj1 = new returnData($pdo, $sql1);
    $datele =  $obj1->getMyData();
    
    $obj2 = new returnData($pdo, $sql2);
    $datele2 = $obj2->getMyData();
    
//    var_dump($datele);

?>
        <form method = "POST" action = "../libs/processDepositDataForm.php">
            <ul id="formadd" class="formlist">
                
                <!-- ADAUGA COMBO ORASE -->
                <li class="combos" id="city">
                    <label for="cities">Orase: </label>
                    <select name="cities" class="chzn-select selects" id="cities">
                        <!-- valoare 0 necesara pentru discriminare la INSERT -->
                        <option value="0">Alege</option>
                        <?php
                            foreach($datele as $k => $v){
                                echo '<option value="' . $v['id_lau'] . '">' . $v['name_orig'] . '</option>';
                            }
                        ?>
                    </select>
                    <button type="button" name="show_city">Nu exista?</button>
                </li>
                
                <!-- ADU-MI STRUCTURILE DIN ACEL ORAS -->
                <li class="combos" id="structure">
                    <label for="structura">Structura: </label>
                    <select name="structura" class="selects" id="structura">
                        <option value="0">Alege</option>
                    </select>
                    <button type="button" name="show_city">Nu exista?</button>
                </li>
                
                <script>
                    
                    $('document').ready(function(){
                       $('select#cities').bind('change', function(){
                           var id = $('select#cities').val();
                         $.ajax({
                             url: '../libs/ajax.php',
                             data: 'id='+id+'&step=2',
                             success: function(data){
                                 $('#structura').append(data);
                             }
                         });
                       });
    
                       /*
                       $('select#structura').bind('change', function(){
                           $('#city, #unit').hide();
                       });*/
                    });
                </script>                
                
                
                <!-- ADAUGA COMBO UNITS -->
                <li class="combos" id="unit">
                    <label for="units">Unitati: </label>
                    <select name="units" class="selects" id="units">
                        <option value="0">Alege</option>
                    </select>
                    
                    <script type="text/javascript">
                        $('document').ready(function(){
                            $('select#structura').bind('change', function(){
                                var id = $('#structura').val();
                                $.ajax({
                                    url: '../libs/ajax.php',
                                    data: 'id='+id+'&step=3',
                                    success: function(data){
                                        $('select#units').append(data);
                                    }
                                });
                            });
                        });
                    </script>
                    
                    <button type="button" name="add_unit" id="add_unit">Adaugă</button></br>
                    <hr/>
                    
                    <!-- ZONA CARE APARE ATUNCI CAND SE CERE INTRODUCEREA RAPIDA A UNEI UNITATI CARE NU EXISTA -->
                    <div id="insert_new_unit">
                        <ul id="new_unit">
                            <script type="text/javascript">
                                /*
                                 * Elimina cu totul divul pentru unituri suplimentar adaugate in prima faza
                                 

                                $('#new_unit').remove();*/
                                
                                $(document).ready(function(){
                                    /*inserarea unui combo din care sa poata fi aleasa structura
                                     *1. daca este apasat butonul "Adauga"
                                     *2. solicita date de la institutiiDataForm.php prin trimiterea id de city ales si identificator de query
                                     *3. inserteaza datele in divul #inset_new_unit
                                     **/
                                    $('#add_unit').bind('click', function(){
                                        /* în cazul în care userul apasa din nou butonul de adăugare
                                         * remove() pe li-urile de clasă .subpl_unit
                                         */
                                        $('.supl_unit').remove();

                                        var id = $('select#cities').val();
                                        $.ajax({
                                            url: 'unitsDataForm.php',
                                            data: 'city='+id+'&under_query=1' ,
                                            success: function(data){
                                                $('#insert_new_unit').append(data);
                                            }
                                        });
                                    });
                                    $('#date_in_unit').bind('click', function(){
                                        $('#date_in_unit').datepicker('widgets');
                                    });
                                });
                                
                                
                            </script>
                        </ul>
                    </div>
                </li>
                
                <!--
                <script type="text/javascript">
                        $(document).ready(function(){
                            $('#cities').bind('change', function(){
                                $('#structure').hide();
                                //ascunde comboul care tine structurile pentru ca optiunea este clara pentru units
                                chargeUnits(); //Functie din js/global.js
                            });
                            $('#add_unit').get()
                        });
                </script>
                -->
                

                
                <li class="input_data">
                    Nume depozit: <input type="text" name="name" size="60"/>
                </li>
                <li class="input_data">
                    Acronim: <input type="text" name="acronim" size="10"/><br/>
                </li>
                <li class="input_data">
                    Descriere: <textarea name="descr" cols="100" rows="10"></textarea>
                </li>
                <li class="input_data">
                    Link: <input type="text" name="link" size="80"/>
                </li>
                <li class="input_data">
                    Email contact: <input type="text" name="email" size="50"/>
                </li>
                <li class="input_data">
                    Punct de access 1: <input type="text" name="access_point1" size="50"/>
                </li>
                <li class="input_data">
                    Punct de access 2: <input type="text" name="access_point2" size="50"/>
                </li>
                <li class="details_data">
                    Clasificare 1: <input type="text" name="clasif1" size="10"/>
                    Clasificare 2: <input type="text" name="clasif2" size="10"/>
                    ISSN: <input type="text" name="issn" size="13"/><br/>
                    OA: <input type="checkbox" name="oa" value="1"/>
                    FA: <input type="checkbox" name="fa" value="1"/>
                    CR: <input type="checkbox" name="cr" value="1"/>
                    DOAJ: <input type="checkbox" name="doaj" value="1"/>
                    ROAR: <input type="checkbox" name="roar" value="1"/>
                    <br/>
                </li>
                <li>
                    <label for="idxs">Indexat de: </label>
                    <select name="idxs[]" class="selects" id="idxs" multiple="multiple">
                        <?php
                            foreach($datele2 as $k => $v){
                                echo '<option value="' . $v['id_depo_index'] . '">' . $v['name'] . '</option>';
                            }
                        ?>
                    </select>
                </li>
                <li>
                    <input type="submit" name="send" value="Trimite" />
                </li>
            </ul>       
        </form>
        
        </div>
    </body>
</html>