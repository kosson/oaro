<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Adauga unitati</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css"/>
        <link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui-1.8.24.custom.css"/>
        <link rel="stylesheet" type="text/css" href="../js/chosen/  .css"/>
        <script src="../js/jquery-1.8.2.min.js"></script>
        <script src="../js/jquery-ui-1.8.24.custom.min.js"></script>
        <script src="../js/global.js" type="text/javascript"></script>
        <script src="../js/chosen/chosen.jquery.js"></script>
        
    </head>
    <body>

<?php
require_once('../libs/homeRes.php');
require_once ('../db/connect.php');
require_once ('../libs/showMeData.php');

$city = $_GET['city'];  //adu id-ul orasului pentru care se cer structurile
$tara = $_POST['country']; 


$sql1 = '
    SELECT 
    lau.id_lau,
    lau.name_orig
    FROM lau
    WHERE lau.id_country = "'.$tara.'"
    AND lau.activ = "1"    
    ';
$obj1 = new returnData($pdo, $sql1);
$datele =  $obj1->getMyData();

//var_dump($datele);

/* ADU-MI STRUCTURILE IN FUNCTIE DE ORASUL ALES
 */
$sql_struct = '
SELECT DISTINCT 
    structure.id_structure,
    structure.name
FROM 
    structure, 
    struct_unit,(
	SELECT 
            unit.id_unit,
            unit.name
        FROM 
            unit,  (
            SELECT
                localisation.id_unit,
                localisation.id_lau
             FROM
                localisation, 
                lau
            WHERE 
                localisation.id_lau = lau.id_lau
            AND
                localisation.id_lau = "'. $city .'"
            )AS atom1
        WHERE atom1.id_unit = unit.id_unit
        )AS atom2
WHERE struct_unit.id_unit = atom2.id_unit
AND struct_unit.id_structure = structure.id_structure
';

$obi = new returnData($pdo, $sql_struct);
$datenoi = $obi->getMyData();

/*ADU-MI TOATE TIPURILE DE UNIT
 */
$sql_type_unit = '
    SELECT *
    FROM type_unit
';

$types = new returnData($pdo, $sql_type_unit);
$date_types = $types->getMyData();

/*ADU-MI TOATE DOMENIILE PENTRU UN UNIT
 */
$sql_domain_unit = '
    SELECT *
    FROM domain_unit
';

$domains = new returnData($pdo, $sql_domain_unit);
$date_domains = $domains->getMyData();


##
# CERERI PRIN AJAX
##

/* Cazul de cerere prin ajax de la depozitDataForm.php atunci cand se cere structura
 * in functie de orasul selectat
 */
if($_GET['under_query'] == '1'){
    //daca e cerere ajax
    
    $k = '';
    
    /* ADU-MI STRUCTURA
     
    $k = '<li class="supl_unit"><label for="structuri">Alege structura: </label><select name="structuri" id="structuri">';
    foreach($datenoi as $v){
        $k .= '<option value="'. $v['id_structure'] .'">'. $v['name'] .'</option>';
    };
    $k .= '</select></li>';
    
    */
    
    /* ADU-MI TIPUL DE UNIT
     */
    $k .= '<li class="supl_unit"><label for="types">Alege tipul: </label><select name="types" id="types">';
    foreach ($date_types as $v){
        $k .= '<option value="'. $v['id_typeunit'] .'">'. $v['type'] .'</option>';
    }
    $k .= '</select></li>';
    
    /* ADU-MI DOMENIU PENTRU UNIT
     */
    $k .= '<li class="supl_unit"><label for="domains">Alege domeniu: </label><select name="types" id="domains">';
    foreach ($date_domains as $v){
        $k .= '<option value="'. $v['id_domainunit'] .'">'. $v['domain_name'] .'</option>';
    }
    $k .= '</select></li>';
    
    /*CAMPURILE DIN UNIT
     */
    $k .= '<li class="supl_unit"><label for="name_unit">Numele unit: </label><input type="text" name="name_unit" id="name_unit" /><li>
            <li class="supl_unit"><label for="site_unit">Site: </label><input type="text" name="site_unit" id="site_unit" /><li>
            <li class="supl_unit"><label for="email_unit">Email: </label><input type="text" name="email_unit" id="email_unit" /><li>
            <li class="supl_unit"><label for="date_in_unit">Data înființării: </label><input type="text" name="date_in_unit" id="date_in_unit" /><li>
            <li class="supl_unit"><label for="date_out_unit">Data desființării: </label><input type="text" name="date_out_unit" id="date_out_unit" /><li>

    ';
    
    echo $k;
}

##
# GESTIUNEA DATELOR DIN FORMUL DE ADAUGARE A INSTITUTIILOR
##

if($_POST['country']){
  echo  '<div class="middle">
        <form method = "POST" action = "../libs/processInstitutiiDataForm.php">
        <ul id="formadd" class="formlist">
            <li class="supl_unit">
                <label for="structuri">Alege localitatea: </label>
                <select name = "structuri" id = "structuri">';
                foreach($datele as $k => $v){
                    echo '<option value="' . $v['id_lau'] . '">' . $v['name_orig'] . '</option>';
                }
        
  echo '        </select>
            </li>
            <li class="supl_unit">
                <label for="types">Alege tipul: </label><select name="types" id="types">';
                foreach ($date_types as $v){
                    echo '<option value="'. $v['id_typeunit'] .'">'. $v['type'] .'</option>';
                }
  echo '        </select>
            </li>
            <li class="supl_unit">
                <label for="structuri">Alege domeniul: </label>
                <select name = "structuri" id = "structuri">';
                foreach ($date_domains as $v){
                    echo '<option value="'. $v['id_domainunit'] .'">'. $v['domain_name'] .'</option>';
                }                
 echo '         </select>
            </li>
        </ul>
      </form>
    </div>';

    };




include 'footer.html';
?>

    </body>
</html>