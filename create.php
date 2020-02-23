<?php 
    require "includes/layout/header.php";

    if(!isset($_SESSION['user_id'])){
    header("Location: views/login.php");
    exit();
    }
?>


<div class="bgWhite container shadow">
    <form id ="createForm" action ="">
        <legend class="greenText">Crearemos tu evento! <span>*Todos los campos son necesarios*</span></legend>
        
        <?php include 'includes/layout/formCreate.php'; ?>

        <input type="hidden"  id="user" value="<?php echo $_SESSION['user_id'];?>">
    </form>
</div>

<?php include 'includes/layout/footer.php'; ?>