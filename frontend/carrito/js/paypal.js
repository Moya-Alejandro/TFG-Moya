
let total =  $('#paypal-button-container').attr('data-total');

//Renderiza el boton de paypal 
paypal.Buttons({

    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    description:"Articulos comprados en Melilla Shooting",
                    value: total
                }
            }]
        });
    },

    style: {
        layout: 'horizontal',
        color: 'blue',
        tagline: false
    },

    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            window.location="pagoFinalizado.php";

        });
    }

}).render('#paypal-button-container');