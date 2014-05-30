function goTo (link) {
	window.location = link;
}

function goToAfter(link, time) {
    setTimeout(function() {window.location = link;}, time);
}

function goBack () {
	window.history.back();
}

function goToNWin (url) {
	window.open(url);
}

function popUp (link, width, height) {
	popupWindow = window.open(
		link,'popUpWindow','height='+height+',width='+width+',left=10,top=10,resizable=no,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
}

/*
    FUNÇÃO QUE CRIA UM COOKIE COM OS VALORES PRETENDIDOS
*/
function createCookie(name,value,days) {
    if (days) {
    	var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

/*
    FUNÇÃO QUE FAZ A LEITURA DE UM COOKIE DESEJADO
*/
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

/*
    FUNÇÃO QUE APAGA UM COOKIE DESEJADO
*/
function eraseCookie(name) {
	createCookie(name,null,-1);
}

function buttonAction (c,p) {
    if ($('input[type=radio]:checked').val() > 0) {
        if (confirm(c)) {
            goTo('./backoffice.php?pg='+p+'&i='+$('input[type=radio]:checked').val());
        }
    }
}


$(window).ready(function () {
	var code = $("textarea[name=code]");
	var buttonspr = $("button#code_spr");
	var buttonslash = $("button#code_slash");
	
	buttonspr.on("click", function () {
		code.val(code.val() + "[spr]");
	});
	
	buttonslash.on("click", function () {
		code.val(code.val() + "[/]");
	})

});