<div id="incomingData">
    <p>Datele care vin</p>
<?php

$data = $_REQUEST;

foreach($data as $k => $v){
    echo '<p>Cheie: <b style="color:green;">'. $k .'</b> Valoarea: <b style="color:green;">' . $v. '</b></p>';
}

?>
</div>