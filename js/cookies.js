function setcookie(name, value, expires, path,domain,secure){
	document.cookie=name+"="+((value)?value:"")+((expires)?";expires="+expires.toGMTString():"")+
	((path)?";path="+path:"")+((domain)?";domain="+domain:"")+((secure)?";secure":"");
}

function getcookie(name){
	var nombre=name+"=";
	var dc=document.cookie;
	if(dc.length>0){
		begin=dc.indexOf(name);
		if(begin!=-1){
			begin+=nombre.length;
			end=dc.indexOf(";",begin);
			if(end==-1)end=dc.length;
			return unescape(dc.substring(begin,end));
		}
	}
	return null;
}

function deletecookie(name, path, domain){
	if(getcookie(name)){
		document.cookie=name+"="+((domain)?";domain="+domain:"")+";expires=Thu,01 Jan 1970 00:00:01 GMT"+((path)?";path="+path:"");
	}
}