const  createForm  = document.querySelector("#createForm"),
       broadcastList = document.querySelector('#broadcastList tbody'),
       inputSeeker = document.querySelector('#search'),
       indexBtn = document.querySelector('#indexBtn'),
       createBtn = document.querySelector('#createBtn');

(function eventListeners(){
    //Listener to submit or update.
    createForm.addEventListener('submit', readForm);

    //Listener to delete, search for broadcasts and call the broadcastNumber function.
    // if(broadcastList!== null){
    //     broadcastList.addEventListener('click', deleteBroadcast);
    //     inputSeeker.addEventListener('input', lookForBroadcast);
    //     broadNumber();
    // }

    //Listeenr to click.
    document.addEventListener('click', navigation );

})();

function readForm(e){
    e.preventDefault();

    const theme = document.querySelector('#theme').value,
          date = document.querySelector('#date').value,
          time = document.querySelector('#time').value,
          link = document.querySelector('link').value,
          action =document.querySelector('#action').value;
          
    if(theme === '' || date === '' || time === '' || link == ''){
        showNotification('Favor de llenar todos los campos', 'error');
    }else{
       
        //Create FormData for AJAX after the successful validation.
        const parameter = new FormData();
        parameter.append('theme', theme);
        parameter.append('date', date);
        parameter.append('time', time);
        parameter.append('link', link);
        parameter.append('action', action);
        
        if(action === "create"){
            //Create new element.
            console.log(parameter);
            // insertDB(parameter);
        }else{
            //Edit broadcast.
            //Read id.
            const registryId = document.querySelector('#id').value;
            parameter.append('id', registryId);
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
    xhr.open('POST','controllers/create.inc.php',true);
    //Pass the data.
    xhr.onload = function(){
        if(this.status === 200){
            //Reading response.
            const response = JSON.parse(xhr.responseText);
            
            // //Inserting new element to the HTML after the DB insertion 
            // const newContact = document.createElement('tr');
            // newContact.innerHTML = `
            //     <td>${response.data.theme}</td>
            //     <td>${response.data.company}</td>
            //     <td>${response.data.phone}</td>
            // `;
            // const actionsContainer = document.createElement('td');

            // //Creade edit botton.
            // const editIcon = document.createElement('i');
            // editIcon.classList.add('fas','fa-edit');
            // const editBotton = document.createElement('a');
            // editBotton.classList.add('btn-edit','btn');
            // editBotton.appendChild(editIcon);
            // editBotton.href = `editar.php?=${response.data.inserted_id}`;
            

            // //Insert in the new td action Container the edit botton.
            // actionsContainer.appendChild(editBotton);

            // //Creating Delete botton.
            // const deleteIcon = document.createElement('i');
            // deleteIcon.classList.add('fas','fa-trash-alt');
            // const deleteBotton = document.createElement('button');
            // deleteBotton.classList.add('btn-delete','btn');
            // deleteBotton.appendChild(deleteIcon);
            // deleteBotton.setAttribute('data-id',response.data.inserted_id);
            // deleteBotton.setAttribute('type','button');
            

            // //Insert in the new td action Container the delete botton.
            // actionsContainer.appendChild(deleteBotton);

            // //Insert in the new tr newContact the new td actionsContainer.
            // newContact.appendChild(actionsContainer);

            // //Inserting in the form.
            // contactsList.appendChild(newContact);

            // //Reset form.
            // document.querySelector('form').reset();

            //Show Notification.
            showNotification('Se a creado tu evento de transmisión!', 'successful');

            // //Update the contact counter.
            // contactsNumber();
        }else{
            showNotification('No se pudo crear tu evento, notificar al dministrador', 'error');
        }
    }
    //Send the data.
    xhr.send(parameter);
}

function deleteContact(e){

    if(e.target.parentElement.classList.contains('btn-delete')){

        const id = e.target.parentElement.getAttribute('data-id');

        const response = confirm('Are you sure?');

        if(response){
            //Ajax call:
            //Create the object.
            const xhr = new XMLHttpRequest();
            //Open.
            xhr.open('GET', `includes/mode/model-contacts.php?id=${id}&action=delete`, true);
            //Read.
            xhr.onload = function(){
                if(this.status === 200){
                  const  result = JSON.parse(xhr.responseText);
                  
                   if(result.response === 'correct'){
                       //Delete the registry of DOM
                       e.target.parentElement.parentElement.parentElement.remove();
                       showNotification('Contact has been deleted','successful');

                       //Update the contact counter.
                       contactsNumber();

                   }else{
                       showNotification('There was an error', 'error')
                   }
                }
            }
            //Send.
            xhr.send();
        }
        
    }
}

function updateDB(contactInfo){

    //Ajax call:
    //Create the object.
    const xhr = new XMLHttpRequest();
    //Open.
    xhr.open('POST','includes/mode/model-contacts.php',true);
    //Read.
    xhr.onload = function(){
        if(this.status === 200){
            const response = JSON.parse(xhr.responseText);
             if(response.response === 'correct'){
                 //Show notification
                 showNotification('The contact\'s information has been updated', 'successful');
             }else{
                showNotification('The contact\'s information couldn\'t been updated ', 'error');
             }
             //After trhee seconds send the user to the index

            setTimeout(() => {
                window.location.href = 'index.php';
            }, 4000);
        }
    }

    //Send.
    xhr.send(contactInfo);

}

    
function showNotification(message, state){
    const notification = document.createElement('div');
    notification.classList.add('notification', state, 'shadow');
    notification.textContent = message;

    //form
    createForm.insertBefore(notification,document.querySelector('form legend'));

    setTimeout(() => {
        notification.classList.add('visible');
        setTimeout(() => {
            notification.classList.remove('visible');
            setTimeout(() => {
                notification.remove(); 
            }, 500); 
        }, 3000);
    }, 100);
}


function lookForContacts(e){
    e.preventDefault();

    const expression  = new RegExp(e.target.value, "i"),
          records  = document.querySelectorAll('tbody tr'); 

          records.forEach(registry =>{
            
            registry.style.display = 'none';

            if(registry.childNodes[1].textContent.replace(/\s/g,' ').search(expression)!= -1){

              registry.style.display = 'table-row';
           }

           contactsNumber();

          });
}

function contactsNumber(){
    const totalContacts = document.querySelectorAll('tbody tr'),
          numberContainer = document.querySelector('.totalContacts span');

    let total = 0;

    totalContacts.forEach(contact =>{
        if(contact.style.display === '' || contact.style.display === 'table-row'){
            total++;
        }
    });

    numberContainer.textContent = total;
    
}

function navigation(e){
    if(e.target.id == 'indexBtn'){
        window.location.href = 'index.php';
        console.log("asda");
    }else if(e.target.id == 'createBtn'){
        window.location.href = 'create.php';    
    }
}