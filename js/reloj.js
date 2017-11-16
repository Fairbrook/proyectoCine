function printReloj(){
	var fecha = new Date();
    var reloj = fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
    $("#reloj").html(reloj);
}
function compReloj(usrHora){
	sep=usrHora.split(":");
    var fecha = new Date();
    if(parseInt(sep[0])<fecha.getHours())return false;
    else return true;
    if(parseInt(sep[1])<fecha.getMinutes())return false;
    else return true;
    if(parseInt(sep[2])<fecha.getSeconds())return false;
    return true;
}