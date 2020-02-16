<?php
    require "includes/layout/header.php";
    // include 'controllers/index.inc.php';
?>

<main>
<?php

    if(isset($_SESSION['user_id'])){
        
    }else{
        header("Location: views/login.php");
        exit();
    }
    ?>  

    <div class="bgGreen whiteText broadcastings shadow broadcasts" >
    <div class="broadcastsContainer">
        <h2>Transmisiones</h2>

        <input type="text" id ="search" class="seeker shadow" placeholder="Buscar">

        <p class="totalContacts"><span></span> Transmisiones</p>

        <div class="tableContainer">
            <table id="contactList" class="contactList">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tema</th>
                        <th>Fecha</th>
                        <th>Enlace</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contacts = obtainContacts();
                        if($contacts->num_rows){ 
                            foreach($contacts as $contact){ ?>
                            <tr> 
                                <td><?php echo $contact['name']; ?></td>
                                <td><?php echo $contact['company'];?></td>
                                <td><?php echo $contact['phone'];?></td>
                                <td><a class="btn-edit btn" href="edit.php?id=<?php echo $contact['id'];?>"><i class="fas fa-edit"></i></a><button class="btn-delete btn"data-id="<?php echo $contact['id'];?>"type ="button"><i class="fas fa-trash-alt"></i></button></td>
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