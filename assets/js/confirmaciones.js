
console.log('confirmaciones cargado');

document.addEventListener('DOMContentLoaded', function () {

    const botones = document.querySelectorAll('.btn-confirmar');

    botones.forEach(function(boton){

        boton.onclick = function(e){

            if(!confirm('¿Seguro que deseas continuar?')){

                e.preventDefault();
                return false;

            }

        };

    });

});

