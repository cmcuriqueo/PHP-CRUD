function goBack() {
	window.history.go(-1);
}
function guardado(){
	alert("Guardado...");
}
function modificado() {
	alert("Modificado...");
}
function confirmar()
{
    if (confirm("Se perderan todos los nuevos datos\n¿desea continuar?")) {
        goBack();
    }
}
function eliminado(){
	alert("Eliminado...");
}
function eliminar(){
	if (confirm("Se eliminara el elemento")) {
		eliminado();
	}
}