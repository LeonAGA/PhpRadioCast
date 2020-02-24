<?php 
    require "includes/layout/header.php";
    require "controllers/edit.inc.php";

    $broadcast_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$broadcast_id){
        die('Error interno, volver al inicio.');
    }

    $broadcast = search_broadcast($broadcast_id);
    if(!is_array($broadcast)){
    die('Hubo un error, no se encontró la transmisión');
    }
    $theme = $broadcast[0];
    $date = $broadcast[1];
    $time = $broadcast[2];
    $link = $broadcast[3];
    $broadcastid = $broadcast[4];
   
?>


<div class="bgWhite container shadow">
    <form id ="editForm" action ="">
        <legend class="greenText">Vamos a editar tu evento <span></span></legend>
        
        <?php include 'includes/layout/formEdit.php'; ?>
        <input type="hidden" id="broadcastid" value="<?php echo $broadcastid;?>">
        <input type="hidden"  id="user" value="<?php echo $_SESSION['user_id'];?>">
    </form>
</div>

<?php include 'includes/layout/footer.php'; ?>