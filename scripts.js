function validateHistoryEntry(){
    if(document.getElementById('asunto').value.length > 0 && document.getElementById('asunto').value.length < 33 && 
    document.getElementById('descripcion').value.length > 11 && document.getElementById('descripcion').value.length < 5001){
        document.getElementById('formulario').submit();
        return true;
    }else{
        document.getElementById('error').innerHTML = 'El campo asunto debe tener entre 1 y 32 carácteres y el campo descripción entre 12 y 5000 carácteres';
        return false;
    }
}

function borrarEspecialista(id, idespecialista) {
    var xhttp;
    if (id == '') {
        let fila =document.querySelector('#fila'+id);
        fila.innerHTML = '';
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let fila =document.querySelector('#fila'+id);
            fila.parentNode.removeChild();
        }
    };
    xhttp.open("get", "Paciente/DeleteEspecialist.php?key="+id+"&especialista="+idespecialista, true);
    xhttp.send();
}

function filter(){
    var text = document.getElementById("filtro").value;
    var cuenta_user = document.getElementById("cuenta_user").value;
    var ajax = new XMLHttpRequest();
    if(text.length > 1){
        ajax.onreadystatechange = function(){
            if(ajax.readyState === 4 && ajax.status === 200){
                document.getElementById('table').innerHTML = ajax.responseText;
            }
        };
        ajax.open('GET', "searchFilter.php?text="+text+"&cuenta_user="+cuenta_user, true);
        ajax.send();
    }else{
        loadTable();      
    }
}

function loadTable(){
    var cuenta_user = document.getElementById("cuenta_user").value;
    var ajax = new XMLHttpRequest();    
        ajax.onreadystatechange = function(){
            if(ajax.readyState === 4 && ajax.status === 200){
                document.getElementById('table').innerHTML = ajax.responseText;
            }
        };
        ajax.open('GET', "searchFilter.php?cuenta_user="+cuenta_user, true);
        ajax.send();      
}