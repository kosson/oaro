<?php

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

$q = $pdo->query($sql1);
$res = $q->fetchAll(PDO::FETCH_ASSOC);


$r = '<table>';

foreach ($res as $value) {
    $r .= '<tr>';
    foreach ($value as $v){
        $r .= '<td>' . $v . '</td>';
    }
    $r .= '</tr>';
}

$r .= '</table>';

echo $r;

?>
