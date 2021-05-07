
function crearInputs(){
    var div = document.createElement('div');
    var id = Date.now();
    div.setAttribute('id', id);
        div.innerHTML =`<input name="valor[]" type="text"><button onclick="borrarInputs(${id})">Borrar</button>`;
        document.getElementById('inputs').appendChild(div);
}

function borrarInputs(id){
    document.getElementById(id).remove();
}
