function deleteselect(idAsiento, idUsuario) {
	ref=getcookie("asientos"+idUsuario);
	ref=ref.split(",");
	result=""+ref[0];
	for (var i = ref.length - 1; i >= 1; i--) {
		if(ref[i]!=idAsiento) result+=","+ref[i];
	}
	return result;
}


function setSelect(idUsuario, idPeli){
	if(getcookie("asientos"+idUsuario)){
		cookie=getcookie("asientos"+idUsuario);
		seleccionados=cookie.split(",");

		if(seleccionados[0]!=idPeli){
			setcookie("asientos"+idUsuario, idPeli, "", "","",false);
			return getcookie("asientos");

		}else{
			$(document).ready(function(){
				for (var i = seleccionados.length - 1; i >= 1; i--) {
					$("#"+seleccionados[i]).css("color","#FF0");
					$("#"+seleccionados[i]).data("status",1);
				}
			})
			return seleccionados;

		}
	}else{

		$(document).ready(function(){
			setcookie("asientos"+idUsuario, idPeli, "", "","",false);
		});
		return peli;
	}
}

function changeSelect(select, asiento, idUsuario){
	if($(asiento).data("status")){
		if($(asiento).data("status")==0){
			$(asiento).css("color","#FF0");
			$(asiento).data("status",1);
			select+=","+$(asiento).attr("id");
			setcookie("asientos"+idUsuario, select, "", "","",false);
			return select;
		}else{
			$(asiento).css("color","black");
			$(asiento).data("status",0);
			select=deleteselect($(asiento).attr("id"),idUsuario);
			setcookie("asientos"+idUsuario, select, "", "","",false);
			return select;
		}
	}else{
		$(asiento).css("color","#FF0");
		$(asiento).data("status",1);
		select+=","+$(asiento).attr("id");
		setcookie("asientos"+idUsuario, select, "", "","",false);
		return select
	}
}