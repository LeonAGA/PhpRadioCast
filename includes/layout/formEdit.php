<div class="inputs">
    <div class="input greyText">
        <label class = "greenText" for="theme">Tema:</label>
        <input 
        type="text" 
        placeholder="Tema de la transmisión" 
        id="theme"
        value="<?php echo(isset($theme))? $theme : '';?>"
        >

    </div>
    <div class="input greyText">
        <label class = "greenText" for="company">Fecha:</label>
        <input 
        type="date" 
        placeholder="Fecha de la transmisión" 
        id="date"
        value="<?php echo(isset($date))? $date : '';?>"
        >
    </div>
    <div class="input greyText">
        <label class = "greenText" for="phone">Hora:</label>
        <input 
        type="time" 
        placeholder="Hora" 
        id="time"
        value="<?php echo(isset($time))? $time : '';?>"
        >
    </div>
</div>
<div class="input greyText link">
        <label class = "greenText" for="link">Enlace:</label>
        <input 
        type="text" 
        placeholder="Url de la radio" 
        id="link"
        value="<?php echo(isset($link))? $link : '';?>"
        >
</div>
<div class="input send btnContainerLogIn">
    <input type="hidden" id="action" value="update"> 
    <input id = "update" class="btn btnPublish disabled" type="submit" value="Actualizar!" disabled>
</div>
