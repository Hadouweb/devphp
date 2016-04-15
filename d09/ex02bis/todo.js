var send_new = document.getElementById('new');
var todo = document.getElementById('ft_list');
var data = "";
send_new.onclick = function() {
	var ret = prompt('Saisir la nouvelle tache :');

	if (ret.length > 0)
	{
		var div = document.createElement('div');
		var text = document.createTextNode(ret);
		var bdiv = todo.children[0];
		div.appendChild(text);
		todo.insertBefore(div, bdiv);
		update(ret);
	}
}

function update(text) {
	var child_div = todo.getElementsByTagName('div');
	for (key in child_div) {
		child_div[key].onclick = function(event) {
			var ret = confirm('Voulez vous supprimer : ' + event.target.innerText);
			if (ret === true)
			{
			    todo.removeChild(event.target);
			    data = data.replace(event.target.innerText, '');
			    setCookie();
			}
		}
	}
	if (text != undefined)
	{
		if (data != "")
			data += '|';
		data += text;
		setCookie();
	}
}

function setCookie() {
	if (data.replace('|', '').length > 0)
		document.cookie="todo_list="+data+"; expires=Fri, 1 Jan 2020 23:59:59 GMT; path=/";
	else
		document.cookie="todo_list=; expires=Fri, 1 Jan 2000 23:59:59 GMT; path=/";
}

function getCookie(name) {
  	var parts = document.cookie.split(';');
  	for (key in parts) {
  		if (parts[key].indexOf(name) > -1)
  			return (parts[key].replace('todo_list=', ''));
  	}
}

var cook = getCookie('todo_list');
if (cook != undefined && cook.length > 0)
{
	var tab = cook.split('|');
	for (key in tab) {
		if (tab[key].length > 0)
		{
			var div = document.createElement('div');
			var text = document.createTextNode(tab[key]);
			var bdiv = todo.children[0];
			div.appendChild(text);
			todo.insertBefore(div, bdiv);
			update(tab[key]);
		}
	}
}