<?php
    require "includes/layout/header.php";
    require "controllers/index.inc.php";
?>

<main>

    <div id = "mainContainer"class="bgGreen whiteText container shadow broadcasts" >
    <div class="broadcastsContainer">
        <h2>Transmisiones</h2>

        <input type="text" id ="search" class="seeker shadow" placeholder="Buscar por usuario">

        <p class="totalBroadcast">Próximas Transmisiones: <span></span></p>

        <div class="tableContainer">
        <?php $broadcasts = search_Allbroadcast();
                                   
                        if(!is_array($broadcasts)){ 
                            ?>
                            
                 <p class="noBroadcastMessage">No hay próximas transmisiones : / ... </p>

                         <?php }else{ ?>
            <table id="broadcastList" class="broadcastList bgBlack">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Tema</th>
                        <th>Fecha : Hora</th>
                        <th>Enlace</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($broadcasts as $broadcast){ ?>
                            <tr> 
                                <td><?php echo $broadcast->get_user_account();?></td>
                                <td><?php echo $broadcast->get_theme();?></td>
                                <td><?php echo $broadcast->get_date();?></td>
                                <td><a class="btn-link btn" href="<?php echo $broadcast->get_link();?>"><i class="fas fa-link"></i></a></td>
                                <?php
                                 if($_SESSION['user_id'] == $broadcast->get_user_id()){?>
                                    <td><a class="btn-edit btn" href="edit.php?id=<?php echo $broadcast->get_broadcast_id();?>"><i class="fas fa-edit"></i></a><button class="btn-delete btn"broadcast-id="<?php echo $broadcast->get_broadcast_id();?>"type ="button"><i class="fas fa-trash-alt"></i></button></td>
                                 <?php } ?>
                            </tr>
                            <?php }}?>
                </tbody>
            </table>

        </div>
    </div>
    </div>
        
        
        
        
        







        
   


 
</main>

<?php
    require "includes/layout/footer.php"
?>