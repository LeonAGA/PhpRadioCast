<?php 
    require "includes/layout/header.php";

    if(!isset($_SESSION['user_id'])){
    header("Location: views/login.php");
    exit();
    }

    
    // require "controllers/create.inc.php";

    
?>

<div class="bgWhite container shadow">
    <form id ="createForm" action ="">
        <legend class="greenText">Add a new contact <span>*Todos los camposson necesarios*</span></legend>
        
        <?php include 'includes/layout/formCreate.php'; ?>
        
    </form>
</div>

<?php include 'includes/layout/footer.php'; ?>