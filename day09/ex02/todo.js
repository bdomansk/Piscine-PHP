function setCookie(name,value,days)
{
	var date = new Date();

	date.setTime(date.getTime()+(days*86400000));
	document.cookie = name + "=" + value + "; expires="+ date.toGMTString() + "; path=/";
}

var i = 0;

function addDiv(str)
{
	var div, id, name;
	div = document.createElement('div');
	id = document.getElementById('ft_list');
	name = 'todo' + i++;
	div.addEventListener(
		"click",
		function()
		{
			if (confirm('Remove this todo ?'))
			{
				id.removeChild(div);
				setCookie(name, 'deleted', -1);
			}
		}, false);
	div.textContent = str.replace(/(%3D)/g, '=').replace(/(%3B)/g, ';');
    setCookie(name, str.replace(/=/g, '%3D').replace(/;/g, '%3B'));
	id.insertBefore(div, id.firstChild);
}

function addNew()
{
	var str = prompt("Enter the new todo");
	if (str.length > 0)
		addDiv(str);
}

function getCookies()
{
	var cookiesArray = document.cookie.split(';');
	var array = {};

	for (var x in cookiesArray)
	{
		var toto = cookiesArray[x].split("=");

		if (toto.length > 1 && /todo\d+/.test(toto[0]))
			array[toto[0].trim()] = toto[1].trim();
	}
	return (array);
}

var cookies = getCookies();
var sortedKeys = Object.keys(cookies).sort();

for (var x in sortedKeys)
{
	setCookie(sortedKeys[x], 'deleted', -1);
	addDiv(cookies[sortedKeys[x]]);
}
