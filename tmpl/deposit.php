<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Depozitele</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css" />
        <script src="../js/jquery-1.8.2.min.js"></script>
        <script src="../js/global.js"></script>
    </head>
    <body>

    <div class="middle">
<?php
session_start();
require_once('../libs/homeRes.php');
require_once ('../db/connect.php');
require_once ('../libs/showMeData.php');

$_SESSION = ''; //variabila de stocare a datelor ce trec spre formularul de adaugare a depozitelor

###
# PRIMUL SET DE DATE ADUS
###

//se face o prima interogare care sa aduca date imediat ce se deschide pagina 
$sql1 = '
SELECT atom1.name, atom1.name_orig,
		deposit.name, deposit.descr, deposit.link, 
		deposit.email, deposit.clasif1, deposit.ISSN, 
		deposit.OA, deposit.FA, deposit.CR, deposit.DOAJ, deposit.ROAR
FROM deposit, dep_struc_unit,
	(
		SELECT
                   unit.name, 
                   struct_unit.id_str_unit, 
                   struct_unit.id_unit, 
                   lau.name_orig
		FROM unit, localisation, struct_unit, lau
		WHERE localisation.id_unit = unit.id_unit
		AND lau.id_lau = localisation.id_lau
		AND unit.id_unit = struct_unit.id_unit
		)AS atom1
WHERE deposit.id_deposit = dep_struc_unit.id_deposit
AND atom1.id_str_unit = dep_struc_unit.id_str_unit
GROUP BY deposit.name;

    ';

$obj1 = new returnData($pdo, $sql1);	//initializeaza un obiect nou de tip returnData (clasa in homeRes.php) si trimite obiectul PDO si interogarea
$datele =  $obj1->getMyData();			//odata initializat obiectul returnData, returneza resursa si bag-o in datele
//echo '<pre>';
//print_r($datele);
//echo '</pre>';


###
# AL DOILEA SET DE DATE ADUS
###

$sql2 = '
    SELECT 
    country.id_country,
    country.name,
    country.name_orig
    FROM country;
    ';

$obj2 = new returnData($pdo, $sql2);
$datele2 =  $obj2->getMyData();
    
    

$k = '<table>';
$k .= '<tr>
          <th>nume depozit</th>
          <th>localitate</th>
          <th>descriere</th>
          <th>link</th>
          <th>email</th>
          <th>clasificare</th>
          <th>ISSN</th>
          <th>AD?</th>
          <th>acces la resurse</th>
          <th>copyright</th>
          <th>DOAJ</th>
          <th>ROAR</th>
      </tr>';

    

foreach($datele as $date){   
    $k .= '<tr>';
    $k .= '<td>' . $date['name'] . '</td>';
    $k .= '<td>' . $date['name_orig'] . '</td>';
    $k .= '<td>' . $date['descr'] . '</td>';
    $k .= '<td><a href="' . $date['link'] . '"><img src="../img/glob.png"></a></td>';
    $k .= '<td><a href="mailto:' . $date['email'] . '"><img src="../img/email.png"></a></td>';
    $k .= '<td>' . $date['clasif1'] . '</td>';
    $k .= '<td>' . $date['ISSN'] . '</td>';
    $k .= '<td>' . $date['OA'] . '</td>';
    $k .= '<td>' . $date['FA'] . '</td>';
    $k .= '<td>' . $date['CR'] . '</td>';
    $k .= '<td>' . $date['DOAJ'] . '</td>';
    $k .= '<td>' . $date['ROAR'] . '</td>';
    $k .= '</tr>';
}

$k .= '</table></br><div class="country">Pentru adăugare selectează țara: ';
echo $k;

echo '<form method="POST" action="depositDataForm.php" class="country"><select name="country">';

      foreach($datele2 as $k => $v){
          echo '<option value="' . $v['id_country'] . '">' . $v['name'] . '</option>';
      }

echo '</select>și';

$k2 .= '
        <input type="submit" value="Add" name="dataDeposit"/>
        </div>
        ';
echo $k2;
?>

        </div>
    </body>
</html>