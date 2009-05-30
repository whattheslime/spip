$(function(){
	var delay = 100;

	$("dt").click(function(){
		$(this).siblings('dd').toggle();
	});

	$('dd').addClass('todo');

	var doing = false;
	var i=0;

	var p = setInterval(function() {
		if (doing)
			return;

		i++;
		doing = true;

		var start = new Date;

		var me = $("dd.todo:first");
		if (!me.length) {
			clearInterval(p);
			return;
		}

		me.find('a.joli')
			.click(function() {
				$(this).siblings('div.result').toggle();
				return false;
			})
		.end()
		.prepend('<a href="' + $('a',me).attr('href') + '" target="_result'+i+'">&#10144;</a>&nbsp;')
		.append('<span>...</span>')

		$('<div class="result">...</div>')
		.hide()
		.appendTo(me)
		.load(
			$("a", me).attr('href'),
			function(e){
				$(this).parent().removeClass('todo');
				if (e.match(/^\s*OK/)) {
					$(this).prev().html(e).parent().addClass('ok');
					if ($(this).parent().siblings('dd:not(.ok):not(.na)').size() == 0)
						$(this).parent().parent().addClass('ok');
					$('#succes').html(parseInt($('#succes').text())+1);
				} else if (e.match(/^\s*NA/)) {
					$(this).prev().html(e).parent().addClass('na');
					if ($(this).parent().siblings('dd:not(.ok):not(.na)').size() == 0)
						$(this).parent().parent().addClass('ok');
				} else {
					$(this).prev().html('erreur').parent().addClass('erreur');
					$(this).parent().parent().addClass('erreur');
					$('#echec').html(parseInt($('#echec').text())+1);
				}
				$('#total').html(parseInt($('#total').text())+1);
				$('#timer').html(parseInt($('#timer').text()) + (new Date - start));
				doing = false;
			}
		);
	}, delay);

});
