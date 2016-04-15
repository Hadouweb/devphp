var send_new = $('#new');
var todo = $('#ft_list');
var data = "";
send_new.click(function() {
	var ret = prompt('Saisir la nouvelle tache :');

	if (ret.length > 0)
	{
		todo.prepend("<div>" + ret + "</div>");
		update(ret);
	}
});

function update(text) {
	$("#ft_list > div").each(function () {
		$(this).off('click').click(function() {
			var ret = confirm('Voulez vous supprimer : ' + $(this).text());
			if (ret === true)
			{
			    $(this).remove();
			    data = data.replace(event.target.innerText, '');
			    setCookie();
			}
		});
	});
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
			todo.prepend("<div>" + tab[key] + "</div>");
			update(tab[key]);
		}
	}
}