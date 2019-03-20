function setCookie(name,value,days)
{
	var date = new Date();

	date.setTime(date.getTime()+(days*86400000));
	document.cookie = name + "=" + value + "; expires="+ date.toGMTString() + "; path=/";
}

var i = 0;

function deliteTodo(str){
	if (confirm('Do you really want to delete this todo ?'))
	{
		console.log(str);
		$("#"+str).remove();
		setCookie(str, 'deleted', -1);
	}
}

function addDiv(str){
	i++;
    str = str.replace(/(%3D)/g, '=').replace(/(%3B)/g, ';');
    $("#ft_list").prepend("<div id=todo" + i + " onclick=deliteTodo(\"todo" + i + "\") >" + str + "</div>");
    setCookie("todo" + i, str.replace(/=/g, '%3D').replace(/;/g, '%3B'), 1);
}

function addNew(){
	var str = prompt("Enter the new todo");
	console.log(str);
	if (str.length > 0)
		addDiv(str);
}

function getCookies(){
	var cookiesArray = document.cookie.split(';');
	var array = {};

	for (var x in cookiesArray){
		var toto = cookiesArray[x].split("=");

		if (toto.length > 1 && /todo\d+/.test(toto[0]))
			array[toto[0].trim()] = toto[1].trim();
	}
	return (array);
}

var cookies = getCookies();
var sortedKeys = Object.keys(cookies).sort();

for (var x in sortedKeys){
	setCookie(sortedKeys[x], 'deleted', -1);
	addDiv(cookies[sortedKeys[x]]);
}
