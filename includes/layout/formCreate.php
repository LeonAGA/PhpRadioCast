<div class="inputs">
    <div class="input greyText">
        <label class = "greenText" for="theme">Tema:</label>
        <input 
        type="text" 
        placeholder="Tema de la transmisión" 
        id="theme"
        value=""
        >
    </div>
    <div class="input greyText">
        <label class = "greenText" for="company">Fecha:</label>
        <input 
        type="date" 
        placeholder="Fecha de la transmisión" 
        id="date"
        value=""
        >
    </div>
    <div class="input greyText">
        <label class = "greenText" for="phone">Hora:</label>
        <input 
        type="time" 
        placeholder="Hora" 
        id="time"
        value=""
        >
    </div>
</div>
<div class="input greyText link">
        <label class = "greenText" for="link">Enlace:</label>
        <input 
        type="text" 
        placeholder="Url de la radio" 
        id="link"
        value=""
        >
</div>
<div class="input send btnContainerLogIn">
    <input type="hidden" id="action" value="create"> 
    <input class="btn btnPublish" type="submit" value="Publicar!">
</div>