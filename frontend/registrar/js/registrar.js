//Guardamos en una variable todos los elementos que nos pasamos por el html
const formulario = document.getElementById('form');
const inputs = document.querySelectorAll('#form input');
const errorUsuario = document.getElementById('errorUsuario');
const errorPassword = document.getElementById('errorPassword');
const errorPassword2 = document.getElementById('errorPassword2');
const errorNombre = document.getElementById('errorNombre');
const errorApellidos = document.getElementById('errorApellidos');
const errorTelefono = document.getElementById('errorTelefono');
const errorCorreo = document.getElementById('errorCorreo');
const errorDni = document.getElementById('errorDni');
const errorForm = document.getElementById('errorForm');

//Ocultamos los mensajes de errores
$("#errorUsuario").css("visibility", "hidden");
$("#errorApellidos").css("visibility", "hidden");
$("#errorTelefono").css("visibility", "hidden");
$("#errorDni").css("visibility", "hidden");
$("#errorCorreo").css("visibility", "hidden");
$("#errorPassword2").css("visibility", "hidden");
$("#errorPassword").css("visibility", "hidden");
$("#errorForm").css("visibility", "hidden");
$("#errorNombre").css("visibility", "hidden");

//En otra variable guardaremos las expresiones regulares, en este caso el usuario, el dni, la contraseña y el email
const expresiones = {
	usuario: /.{6,}/,
	dni: /^[0-9]{8}[-]?[TRWAGMYFPDXBNJZSQVHLCKET]$/,
    nombre: /^[a-z-A-Z\D]+$/  ,
    apellidos: /^[a-z-A-Z\D]+$/,
    telefono: /^[0-9]{9}/,
	password: /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/,
	correo: /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
}   

//Pondremos los campos en falso para validar el formulario, hasta que no estén en true no se puede enviar el formulario
const campos = {
	usuario: false,
	password: false,
	password2: false,
    nombre: false,
    apellidos: false,
    telefono: false,
	correo: false,
	dni: false
}

//En esta función flecha validaremos los campos para poder validar el formulario, segun el nombre del html entra en un caso del switch
const validarFormulario = (e) => {
	switch (e.target.name) {
		case "usuario":
			validarCampo(expresiones.usuario, e.target, 'usuario', errorUsuario);
		break;
		case "password":
			validarCampo(expresiones.password, e.target, 'password', errorPassword);
		break;
		case "password2":
            validarPassword2();
		break;
        case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre', errorNombre);
		break;
        case "apellidos":
			validarCampo(expresiones.apellidos, e.target, 'apellidos', errorApellidos);
		break;
        case "telefono":
			validarCampo(expresiones.telefono, e.target, 'telefono', errorTelefono);
		break;
		case "correo":
			validarCampo(expresiones.correo, e.target, 'correo', errorCorreo);
		break;
		case "dni":
			validarCampo(expresiones.dni, e.target, 'dni', errorDni);
            validarDni();
		break;
	}
}

const validarPassword2 = () => {
	const input1 = document.getElementById('password');
	const input2 = document.getElementById('password2');

	if(input1.value === input2.value){
		campos['password2'] = true;
		errorPassword2.style.visibility = "hidden";
	} else {
		campos['password2'] = false;
		errorPassword2.style.visibility = "visible";
	}
}

//Si lo que escribimos cumple la expresion regular, el campo se volverá true y el error se volverá invisible, en caso de que esté mal saldrá el error y el campo seguirá false
const validarCampo = (expresion, input, campo, error) => {
	if(expresion.test(input.value)){
        campos[campo] = true;
        error.style.visibility = "hidden";
	} else {
        campos[campo] = false;
        error.style.visibility = "visible";
	}
}

//Función que valida la letra del Dni
function validarDni() {
	DNI = document.getElementById('dni');
	let numero;
	let letr;
	let letra;
	DNI.value = DNI.value.slice(0, 8) + DNI.value.charAt(8).toUpperCase();
	let cadena = DNI.value;

	if(expresiones.dni.test (cadena) == true){
	   numero = cadena.substr(0,cadena.length-1);
	   letr = cadena.substr(cadena.length-1,1);
	   numero = numero % 23;
	   letra='TRWAGMYFPDXBNJZSQVHLCKET';
	   letra=letra.substring(numero,numero+1);
		if (letra!=letr.toUpperCase()) {
			errorDni.style.visibility = "visible";
			campos['dni'] = false;
		}else{
			errorDni.style.visibility = "hidden";
			campos['dni'] = true;
		}
	}else{
	   errorDni.style.visibility = "visible";
	   campos['dni'] = false;
	}
}


//En esta función flecha añadiremos oyentes de eventos que se activarán cuando se escriba algo
inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

//Tendremos que validar el formulario para poder enviarlo en caso de que los campos sean verdaderos, en caso de que alguno sea falso saldrá un error
formulario.addEventListener('submit', (e) => {
    e.preventDefault();
	if(campos.usuario && campos.nombre && campos.apellidos && campos.telefono && campos.correo && campos.cp && campos.dni && campos.password2){
		formulario.submit();
    } 
    else {
        errorForm.style.visibility = "visible";
        setTimeout(() => {errorForm.style.visibility = "hidden";}, 2000);
    }
});
