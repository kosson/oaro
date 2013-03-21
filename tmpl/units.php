<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/general.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="../js/global.js"></script>
    </head>
    <body>

    <div class="middle">
<?php
require_once('../libs/homeRes.php');
require_once ('../db/connect.php');

$sql1 = '
    SELECT atom2.structura, atom2.name, domain_unit.domain_name AS specializarea, atom2.type, atom2.site
    FROM
	(SELECT unit.name, compilate.type, unit.site, compilate.name AS structura, unit.id_unit, unit.id_domainunit
	 FROM unit 
	 LEFT JOIN 
		(SELECT type_unit.type, atom1.name, atom1.id_str_unit, atom1.id_unit, atom1.id_structure 
		 FROM 
		 	(SELECT structure.id_structure, structure.name, struct_unit.id_str_unit, struct_unit.id_unit, struct_unit.id_typeunit
			 FROM structure, struct_unit
	         WHERE structure.id_structure = struct_unit.id_structure) 
			 AS atom1
			LEFT JOIN type_unit 
			ON atom1.id_typeunit = type_unit.id_typeunit) 
		AS compilate
	ON unit.id_unit = compilate.id_unit)
	AS atom2
    LEFT JOIN domain_unit
    ON domain_unit.id_domainunit = atom2.id_domainunit
    ';

$obj1 = new returnData($pdo, $sql1);
$datele =  $obj1->getMyData();
//echo '<pre>';
//print_r($datele);
//echo '</pre>';

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
$k .= '<tr><th>Structura</th><th>nume</th><th>specializare</th><th>tip</th><th>site</th></tr>';

    

foreach($datele as $date){   
    $k .= '<tr>';
    $k .= '<td>' . $date[structura] . '</td>';
    $k .= '<td>' . $date[name] . '</td>';
    $k .= '<td>' . $date[specializarea] . '</td>';
    $k .= '<td>' . $date[type] . '</td>';
    $k .= '<td><a href="' . $date[site] . '"><img src="../img/glob.png"></a></td>';
    $k .= '</tr>';
}

$k .= '</table>';

echo $k;

//Adugarea unei noi institutii
echo '<div class="country">Pentru adăugare selectează țara: 
    <form method="POST" action="unitsDataForm.php" class="country">
    <select name="country">';
      foreach($datele2 as $k => $v){
          echo '<option value="' . $v['id_country'] . '">' . $v['name'] . '</option>';
      }
echo '</select>și
    <input type="submit" value="adaugă" name="dataUnits"/>
    </div>
        ';

?>
        

        </div>
    </body>
</html>
        