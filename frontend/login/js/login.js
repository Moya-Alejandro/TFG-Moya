
//Guardamos en una variable todos los elementos que nos pasamos por el html
const formulario = document.getElementById('formLogin');
const inputs = document.querySelectorAll('#formLogin input');


//JQuery pone los estilos de los mensajes de error oculto
$("#errorUsuario").css("visibility", "hidden");
$("#errorPassword").css("visibility", "hidden");

//En otra variable guardaremos las expresiones regulares, en este caso la del usuario y la contraseña
const expresiones = {
	usuario: /.{6,}/,
	password: /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/
} 

//Pondremos los campos en falso para validar el formulario, hasta que no estén en true no se puede enviar el formulario
const campos = {
	usuario: false,
	password: false
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
	}
}

//Si lo que escribimos cumple la expresion regular, el campo se volverá true y el error se volverá invisible, en caso de que esté mal saldrá el error y el campo seguirá false
const validarCampo = (expresion, input, campo, error) => {
	if(expresion.test(input.value)){
        campos[campo] = true;
		//JQuery, pone los estilos de los mensajes de error en oculto en caso de que no se cumpla la condicion
        $(error).css("visibility","hidden");
	} else {
        campos[campo] = false;
		//JQuery, pone los estilos de los mensajes de error en visible en caso de que se cumpla la condicion
        $(error).css("visibility","visible");
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
	if(campos.usuario && campos.password){
		formulario.submit();
    } 
    else {
		swal("Rellene bien el formulario", {
			timer: 3000,
		});
    }
});

//Cuadro de swal que nos pedirá un correo para recuperar la contraseña
function mostrarRecuperarContra(){

	swal("Recuperar Contraseña", {
		content: {
			element: "input",
			attributes: {
			  placeholder: "ejemplo@gmail.com",
			  type: "email",
			},
		},

		button: {
			text: "Recuperar",
			closeModal: false,
		},
	  })
	  .then((value) => {
			window.location='../../backend/usuario/recuperar.php?correo='+value;
	  });
}
