<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * este o clasa care va agrega si afisa datele care vor intra pe prima pagina
 *
 * @author nicolaus
 */


class returnData {
    private $pdo;
    private $qry = '';
    private $intrebare = '';
    private $resource = '';
    
    function __construct($conexiune, $interogare) {
        $this->pdo = $conexiune;
        $this->qry = $interogare;
    }
    
    public function getMyData(){
        $this->intrebare = $this->pdo->query($this->qry);
        $this->resource = $this->intrebare->fetchAll(PDO::FETCH_ASSOC);
        return $this->resource;
    } 
}



?>
