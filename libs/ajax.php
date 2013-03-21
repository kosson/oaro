<?php
session_start();
require_once('homeRes.php');
require_once ('../db/connect.php');

//scoate valoarea id-ului
$id = $_GET['id'];


/*ADU-MI TOATE UNITATILE IN FUNCTIE DE ORASUL SELECTAT
 */
$sql_lau_unit = '
SELECT 
unit.id_unit,
unit.name
FROM 
unit, 
    (
    SELECT
        localisation.id_unit,
	localisation.id_lau
    FROM
        localisation, 
        lau
    WHERE 
        localisation.id_lau = lau.id_lau
    AND
	localisation.id_lau = "'. $id .'"
    )AS atom1
WHERE atom1.id_unit = unit.id_unit';


/*ADU-MI TOATE STRUCTURILE FARA NICIO CONDITIONARE
 */
$sql_structures = '
    SELECT *
    FROM structure
';

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
                localisation.id_lau = "'. $id .'"
            )AS atom1
        WHERE atom1.id_unit = unit.id_unit
        )AS atom2
WHERE struct_unit.id_unit = atom2.id_unit
AND struct_unit.id_structure = structure.id_structure
';

/* ADU-MI UNITATILE IN FUNCTIE DE STRUCTURA ALEASA
 */
$sql_units= '
SELECT
    unit.id_unit,
    unit.name
FROM
    unit,
    struct_unit
WHERE
    struct_unit.id_structure = "'.$id.'"
AND
    unit.id_unit = struct_unit.id_unit    

';




switch($_REQUEST['step']){
    case $_REQUEST['step'] == '1':
        $obj_lau_unit = new returnData($pdo, $sql_lau_unit);
        $datele = $obj_lau_unit->getMyData();

        //var_dump($datele);
        foreach($datele as $k => $v){
            echo '<option value="' . $v['id_unit'] . '">' . $v['name'] . '</option>';
        };
        break;
        
    case $_REQUEST['step'] == '2':
        $obi = new returnData($pdo, $sql_struct);
        $datenoi = $obi->getMyData();

        //var_dump($datele);
        foreach($datenoi as $k => $v){
            echo '<option value="' . $v['id_structure'] . '">' . $v['name'] . '</option>';
        };
        break;
        
    case $_REQUEST['step'] == '3':
        $obj_unit_struc = new returnData($pdo, $sql_units);
        $date_unit_str = $obj_unit_struc->getMyData();

        //var_dump($datele);
        foreach($date_unit_str as $k => $v){
            echo '<option value="' . $v['id_unit'] . '">' . $v['name'] . '</option>';
        };
        break;  
}


?>
