
//Función que al darle creará campos input
function crearInputs(){
    var div = document.createElement('div');
    var id = Date.now();
    div.setAttribute('id', id);
    div.setAttribute('class', 'divValores');
    div.innerHTML =`<input name="valorJs[]" type="text"><label class="labelBasura" for="borrarInput"> <i class="fas fa-trash"></i></label><button id="borrarInput" class="botonBorrarInput" onclick="borrarInputs(${id})">Borrar</button>`;
    document.getElementById('inputs').appendChild(div);
}

//Función que al darle nos borrará campos input
function borrarInputs(id){
    document.getElementById(id).remove();
}
