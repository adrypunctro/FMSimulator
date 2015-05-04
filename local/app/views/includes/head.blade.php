<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Scotch">

<title>{{ $title }}</title>
{{ HTML::script('assets/js/jquery-1.11.2.min.js'); }}
{{ HTML::style('assets/css/app.css'); }}
<script>
var base_url = '<?php echo URL::to('/');?>';


function tactic_dropdown_update()
{
	//console.log(data);
	var request = $.ajax({
		url: base_url+"/tactic_dropdown_update",
		type: "POST",
		data: '',
		dataType: "html"
	});
	
	// receptioneaza de la controler
	request.done(function( msg ) {
		var response = JSON.parse(msg);
		
		$('.team_tactics_players ul.table > li').each(function(index, element) {
            $(this).find('.drop_down_list').children('ul').html(response.msg);
        });
	});
	
	request.fail(function( jqXHR, textStatus ) {
		//$('.grass_zone').html("nothing");
	});
}

function tactic_update()
{
	//console.log(data);
	var request = $.ajax({
		url: base_url+"/team",
		type: "POST",
		data: '',
		dataType: "html"
	});
	
	// receptioneaza de la controler
	request.done(function( msg ) {
		var response = JSON.parse(msg);
		$('.team_tactics_tactic .grass_zone > .field > .lines').html(response.msg);
	});
	
	request.fail(function( jqXHR, textStatus ) {
		//$('.grass_zone').html("nothing");
	});
}

function tactic_assign_player(val_pos_no, val_player_id, val_pos_no_name)
{
	var data = {pos_no:val_pos_no,player_id:val_player_id};
	
	var request = $.ajax({
		url: base_url+"/tactic_assign_player",
		type: "POST",
		data: data,
		dataType: "html"
	});
	
	request.done(function( msg ) {
		//var response = JSON.parse(msg);
		//alert('DA '+response.msg);
		tactic_update();
		tactic_dropdown_update();
		
		// actualizeaza pozitia curenta a jucatorului
		var old_pos = $('.team_tactics_players .table').find('#player_id-'+val_player_id+'-pos_no').html();
		
		// actualizarea clasei pozitiei curente
		if(val_pos_no_name == '-')
			$('.team_tactics_players .table').find('#player_id-'+val_player_id+'-pos_no').addClass('null');
		else
		{
			// Cauta asignarea pentru interschimbare
			$('.team_tactics_players .table > li').each(function(index, element) {
				
                if(val_pos_no_name == $(this).find('.current').html())
				{
					$(this).find('.current').html(old_pos);
					return;
				}
            });
			$('.team_tactics_players .table').find('#player_id-'+val_player_id+'-pos_no').removeClass('null');
		}
		
		// Schimbarea valorii pentru pozitia curenta
		$('.team_tactics_players .table').find('#player_id-'+val_player_id+'-pos_no').html(val_pos_no_name);
	});
	
	request.fail(function( jqXHR, textStatus ) {
		//alert('NU');
	});
	
	
	
}



jQuery(document).ready(function($) {
	tactic_update();
	tactic_dropdown_update();
	
	
	// Afisarea meniului Drop-Down pentru asignarea jucatorilor
	$('.team_tactics_players .drop_down_list').on('click', function(e){
		// Inchide meniul la click in afara lui
		$('html').click(function() {
			$('.team_tactics_players .drop_down_list').children('ul').hide();
		});
		
		// Opreste propagarea click-ului
		// doar daca nu este deja deschis
		if(!$('.team_tactics_players .drop_down_list').children('ul').is(':visible'))
			e.stopPropagation();
		
		// Afiseaza meniul
		$(this).children('ul').show();
	});
	
	// Asignarea jucatorilor
	$('.team_tactics_players .drop_down_list > ul').on('click', 'li', function(e){
		e.preventDefault();
		e.stopPropagation();
		
		tactic_assign_player(parseInt($(this).attr('pos_no')),parseInt($(this).parent().attr('player_id')),$(this).attr('pos_no_name'));
		
		$(this).parent().hide();
	});
});
</script>