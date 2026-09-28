<?php
use App\Item;
include("../../vendor/autoload.php");
include("../includes/cabecalho.php");
include("../includes/Menu.php");
include("../includes/rodape.php");
$itens = Item::listar();
//echo"<pre>";
//print_r($itens);
//echo"</pre>";
?>
<main class="container">
    <h2 class="text-center">Listar de Itens</h2>
    <a href="/reserva/view/item/cadastrar.php">
    <button class="btn btn-success"> Novo Item </button></a>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Patrimônio</th>
                <th>Ações</th>
            </tr>
        </thead>
          <?php foreach ($itens as $item) { 
     echo"<tr>";
     echo '<td>' . $item->id . '</td>'; 
     echo '<td>' . $item->nome . '</td>'; 
     echo '<td>' . $item->descricao . '</td>'; 
     echo '<td>' . $item->patrimonio . '</td>';
     echo '<td><a href="/reserva/view/item/editar.php?id=' . $item->id . '"> 
     <button class= "btn btn-primary"> Editar </button></a>
     <a href="/reserva/action/action_item.php?action=excluir&id=' . $item->id . '">
     <button class="btn btn-danger" onclick="return confirm(\'Deseja realmente excluir este item?\');"> Excluir </button></a></td>'; 
     echo"</tr>";
 } ?>
        
    </table>
</main>