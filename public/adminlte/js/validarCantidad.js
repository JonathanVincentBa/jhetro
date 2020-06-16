function validarCantidad(numero){

	var numero1 = numero % 1;
	console.log(numero);
    if ( numero >= 0)
    {
    	if(numero1 != 0)
    	{
	      	$("#pcantidad").val("");
	  	  	$("#pcantidad").focus();
	      	sweetAlert("Error","El valor ingresado no es un número entero","error");
	    }
    }
    else
    {
    	$("#pcantidad").val("");
	  	$("#pcantidad").focus();
	    sweetAlert("Error","El valor ingresado no es un número positivo","error");
    }

}
