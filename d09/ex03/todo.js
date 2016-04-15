$(document).ready(function() {
	var send_new = $('#new');
	var todo = $('#ft_list');
	var data = "";
	var id = 1;

	function waitData(id) {
		send_new.click(function() {
			var ret = prompt('Saisir la nouvelle tache :');

			if (ret.length > 0)
			{
				var posting = $.post('insert.php',  { id: id, text: ret });
				posting.done(function(data) {
					//console.log(data);
					update();
					id++;
		  		});
				todo.prepend("<div id='" + id + "'>" + ret + "</div>");
			}
		});
		update();
	}


	function getData() {
		$.get('select.php', function (data) {
			data = data.split('\n');
			for (key in data) {
				if (data[key].length > 0) {
					var elem = data[key].split(';');
					todo.prepend("<div id='" + elem[0] + "'>" + elem[1] + "</div>");
				}
			}
			id = todo.children().first().attr('id');
			if (id === undefined)
				id = 1;
			else
				id = parseInt(id, 10) + 1;
		}).done (function() {
			waitData(id);
		});
	}
	getData();


	function update() {
		$("#ft_list > div").each(function () {
			$(this).off('click').click(function() {
				var ret = confirm('Voulez vous supprimer : ' + $(this).text());
				if (ret === true)
				{
					var current_id = $(this).attr('id');
					$(this).remove();
					var request = $.ajax({
						url: 'delete.php',
						method: "DELETE",
						data: { id : current_id },
					});
					request.done(function(data) {
						//console.log(data);
					});
				}
			});
		});
	}
});