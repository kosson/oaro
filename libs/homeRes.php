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
    private $pdo;				//primeste un obiect PDO care face conexiunea cu baza de date
    private $qry = '';			//primeste interogarea pentru baza de date
    private $intrebare = '';
    private $resource = '';
    
    function __construct($conexiune, $interogare) {	//primeste de la scripturile care apeleaza un obiect PDO care face conexiunea si interogarea
        $this->pdo = $conexiune;
        $this->qry = $interogare;
    }
    
    public function getMyData(){
        $this->intrebare = $this->pdo->query($this->qry);				//seteaza membrul intrebare cu un handle de interogare propriu unui obiect PDO
        $this->resource = $this->intrebare->fetchAll(PDO::FETCH_ASSOC);	//se incarca membrul resource cu ce aduce obiectul PDO care a facut interogarea
        return $this->resource;
    } 
}



?>
