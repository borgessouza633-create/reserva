<?php

use App\Item;
require("../vendor/autoload.php");
$action = $_GET['action'] ?? '';
$item = new Item();
switch ($action) {
    case 'cadastrar':
        $item->nome = $_POST['nome'] ;
        $item->descricao = $_POST['descricao'] ;
        $item->patrimonio = $_POST['patrimonio'] ;  
        $item->cadastrar();
        header('location: /reserva/view/item/listar.php');
        print('<pre>');
        //print_r($item);
        print('</pre>');    
        break; 
        case 'excluir':
        $item->id = $_GET['id'] ; 
        $item->excluir();
        header('location:/reserva/view/item/listar.php');
}
?>