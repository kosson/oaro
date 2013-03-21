<?php
        include ('../db/connect.php');
        include ('homeRes.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of select
 *
 * @author nicolaus
 */
class selectList {
    protected $pdo;
    private $country='';
    private $sql = '';

    public function __construct() {
        $this->dbConnect();
    }
    
    protected function dbConnect(){
        include ('../db/connect.php');
    }
    
    public function showCity($country){
        $this->country = $country;
        
        $this->sql = 'SELECT 
                        lau.id_lau,
                        lau.name_orig
                        FROM lau
                        WHERE lau.id_country = "' . $this->country . '";';
        
        $ob = new returnData($pdo, $sql1);
        $datele =  $obj1->getMyData();
        
        var_dump($datele);
    }
}

?>
