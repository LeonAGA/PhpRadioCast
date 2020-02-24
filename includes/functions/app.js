const  createForm  = document.querySelector("#createForm"),
       editForm = document.querySelector("#editForm"),
       broadcastList = document.querySelector('#broadcastList tbody'),
       inputSeeker = document.querySelector('#search'),
       indexBtn = document.querySelector('#indexBtn'),
       createBtn = document.querySelector('#createBtn'),
       mainContainer = document.querySelector('#mainContainer');
       let themeFlag = false;
       let dateFlag = false;
       let timeFlag = false;
       let linkFlag = false;

(function eventListeners(){
    //Listener to submit or update.
    if(createForm !== null){
        createForm.addEventListener('submit', readForm);
    }

    if(editForm !== null){

        const themeOriginal = document.querySelector('#theme').value,
        dateOriginal = document.querySelector('#date').value,
        timeOriginal = document.querySelector('#time').value,
        linkOriginal = document.querySelector('#link').value,
    
        themeInput = document.querySelector('#theme');
        dateInput = document.querySelector('#date');
        timeInput = document.querySelector('#time');
        linkInput = document.querySelector('#link');
       

        themeInput.addEventListener('input', function(e){
            if(e.target.value === themeOriginal){
                themeFlag = false;
            }else{
                themeFlag = true;
            }
        });

        dateInput.addEventListener('input', function(e){
            if(e.target.value === dateOriginal){
                dateFlag = false;
            }else{
                dateFlag = true;
            }
        });

        timeInput.addEventListener('input', function(e){
            if(e.target.value === timeOriginal){
                timeFlag = false;
            }else{
                timeFlag = true;
            }
        });

        linkInput.addEventListener('input', function(e){
            if(e.target.value === linkOriginal){
                linkFlag = false;
            }else{
                linkFlag = true;
            }
        });
        //running listener for editing.
        enableEdit();
        editForm.addEventListener('submit', readForm);
    }
    
    //Listener to delete, search for broadcasts and call the broadcastNumber function.
     if(broadcastList!== null){
        broadcastList.addEventListener('click', deleteBroadcast);
        inputSeeker.addEventListener('input', lookForBroadcast);
         broadNumber();
     }

    //Listener to click.
    document.addEventListener('click', navigation );

    
})();

function enableEdit(){
    if(editForm !== null){
        if(themeFlag || dateFlag || timeFlag || linkFlag){
            document.querySelector('#update').classList.remove("disabled");
            document.querySelector('#update').disabled = false;
        }else{
            document.querySelector('#update').classList.add("disabled");
            document.querySelector('#update').disabled = true;
        }
        setTimeout(enableEdit,0);

    }
}

function readForm(e){
    e.preventDefault();

    const theme = document.querySelector('#theme').value,
          date = document.querySelector('#date').value,
          time = document.querySelector('#time').value,
          link = document.querySelector('#link').value,
          user = document.querySelector('#user').value
          action = document.querySelector('#action').value;
         
    if(theme === '' || date === '' || time === '' || link == ''){
        showNotification('Favor de llenar todos los campos', 'error');
    }else{
       
        //Create FormData for AJAX after the successful validation.
        const parameter = new FormData();
        parameter.append('theme', theme);
        parameter.append('date', date);
        parameter.append('time', time);
        parameter.append('link', link);
        parameter.append('user', user);
        parameter.append('action', action);
        
        if(action === "create"){
            //Create new element.
            insertDB(parameter);
        }else if(action === "update"){
            //Edit broadcast.
            //Read id.
            const broadcastid = document.querySelector('#broadcastid').value;
            parameter.append('broadcastid', broadcastid);
            //Update an element.
            updateDB(parameter);
        }

    }

}

function insertDB(parameter){
    // call Ajax:
    //Create the object.
    const xhr = new XMLHttpRequest();
    //Open the conection.
    xhr.open('POST','controllers/create.inc.php', true);
    //Pass the data.
    
    xhr.onload = function(){
        if(this.status === 200){
            //Reading response.
            let data;
            let response = xhr.responseText.replace(/<\/?[^>]+(>|$)/g, "");
            data = JSON.parse(response)
            if( data.correct){
                showNotification('Se a creado tu evento de transmisión', 'successful', data.data.theme);
                
            }else{
                showNotification('Algo salió mal :/... notificar al asministrador', 'error');
            }
            
        }else{
            showNotification('Hay un error en la comunicación, notificar al asministrador', 'error');
        }
        createForm.reset();
    }
    //Send the data.
    xhr.send(parameter);
}

function deleteBroadcast(e){

    if(e.target.parentElement.classList.contains('btn-delete')){

        const broadcast_id = e.target.parentElement.getAttribute('broadcast-id');
        // const user_id = e.target.parentElement.getAttribute('account-id');
        const response = confirm('Seguro que quieres eliminar tu transmisión?');

        if(response){
            //Ajax call:
            //Create the object.
            const xhr = new XMLHttpRequest();
            //Open.
            xhr.open('GET', `controllers/index.inc.php?id=${broadcast_id}&action=delete`, true);
            //Read.
            xhr.onload = function(){
                if(this.status === 200){
                 let data;
                 let response = xhr.responseText.replace(/<\/?[^>]+(>|$)/g, "");
                 data = JSON.parse(response);
                   if(data.correct){

                       //Delete the registry of DOM
                       e.target.parentElement.parentElement.parentElement.remove();
                       showNotification('La transmisión a sido eliminada!','successful');

                       //Update the contact counter.
                       broadNumber();

                   }else{
                    showNotification('Algo salió mal :/... notificar al asministrador', 'error');
                   }
                }else{

                 showNotification('Hay un error en la comunicación, notificar al asministrador', 'error'); 
                }
            }
            //Send.
            xhr.send();
        }
        
    }
}

function updateDB(parameter){

    //Ajax call:
    //Create the object.
    const xhr = new XMLHttpRequest();
    //Open.
    xhr.open('POST','controllers/edit.inc.php',true);
    //Read.
    xhr.onload = function(){
        if(this.status === 200){
            //Reading response.
            let data;
            let response = xhr.responseText.replace(/<\/?[^>]+(>|$)/g, "");
            data = JSON.parse(response);
            console.log(data);
            if( data.correct){
                showNotification('Se a editado tu evento de transmisión', 'successful', data.data.theme);

            }else{
                showNotification('Algo salió mal :/... notificar al asministrador', 'error');
            }   
             //After trhee seconds send the user to the index
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 4000);
        }else{
            showNotification('Hay un error en la comunicación, notificar al asministrador', 'error'); 
        }
    }
    //Send.
    xhr.send(parameter);
}

    
function showNotification(message, state, event=''){
    const notification = document.createElement('div');
    notification.classList.add('notification', state, 'shadow');
    notification.textContent = message;
    const eventElement = document.createElement('span');
    eventElement.innerHTML = `<br> ${event}`;
    notification.appendChild(eventElement);
    
    //form
    if(createForm !== null){
        createForm.insertBefore(notification,document.querySelector('form legend'));
    }else if (mainContainer !== null){
        mainContainer.insertBefore(notification,document.querySelector('.broadcastsContainer'));
    }else{
        editForm.insertBefore(notification,document.querySelector('form legend'));
    }
    
    setTimeout(() => {
        notification.classList.add('visible');
        setTimeout(() => {
            notification.classList.remove('visible');
            setTimeout(() => {
                 notification.remove(); 
            }, 500); 
        }, 8000);
    }, 100);
}


function lookForBroadcast(e){
    e.preventDefault();

    const expression  = new RegExp(e.target.value, "i"),
          records  = document.querySelectorAll('tbody tr'); 

          records.forEach(registry =>{
            
            registry.style.display = 'none';

            if(registry.childNodes[1].textContent.replace(/\s/g,' ').search(expression)!= -1){
             
              registry.style.display = 'table-row';
           }

           broadNumber();

          });
}

function broadNumber(){
    const totalBroadcasts = document.querySelectorAll('tbody tr'),
          numberContainer = document.querySelector('.totalBroadcast span');

    let total = 0;

    totalBroadcasts.forEach(contact =>{
        if(contact.style.display === '' || contact.style.display === 'table-row'){
            total++;
        }
    });

    numberContainer.textContent = total;
    
}

function navigation(e){
    if(e.target.id == 'indexBtn'){
        window.location.href = 'index.php';
    }else if(e.target.id == 'createBtn'){
        window.location.href = 'create.php';    
    }
}