jQuery(document).ready(function(){
	$("#name_module").change(function(){
		var name_module = $( "#name_module option:selected" ).val();
		$.ajax({
				url:action,
				data: 'name_module='+name_module+'&changemodule=1',
				type:'POST',
		}).done(function(msg) {
			slecthook = $('select[name="sp_hook"]');
			$(slecthook).empty();
			none = '<option value="none">------None-----</option>';
			$(slecthook).append(msg);
			$(slecthook).append(none);
		});	
	});
	ShowBanner();
	ShowOptionSlider();
});

function ShowOptionSlider() {
	if($('#list_style_blog').length > 0){
		if ($( "#list_style_blog option:selected" ).val() == 'type_slider') {
			$("#show_nav_on").parent().parent().parent().show();
			$("#show_dots_on").parent().parent().parent().show();
			$("#spacing_item").parent().parent().show();
			$("#number_row").parent().parent().show();
			
		} else {
			$("#show_nav_on").parent().parent().parent().hide();
			$("#show_dots_on").parent().parent().parent().hide();
			$("#spacing_item").parent().parent().hide();
			$("#number_row").parent().parent().hide();
		}
		$('#list_style_blog').change(function() {
			disableOptionSlider();
		});
	}
}

function disableOptionSlider() {
	if ($( "#list_style_blog option:selected" ).val() == 'type_slider') {
		$("#show_nav_on").parent().parent().parent().show();
		$("#show_dots_on").parent().parent().parent().show();
		$("#spacing_item").parent().parent().show();
		$("#number_row").parent().parent().show();
		
	} else {
		$("#show_nav_on").parent().parent().parent().hide();
		$("#show_dots_on").parent().parent().parent().hide();
		$("#spacing_item").parent().parent().hide();
		$("#number_row").parent().parent().hide();
	}
}

function ShowBanner() {
	if ($('#show_banner_on').prop('checked') == true) {
		$("#image").parent().parent().parent().parent().show();
		$("#url_banner").parent().parent().show();
	} else {
		$("#image").parent().parent().parent().parent().hide();
		$("#url_banner").parent().parent().hide();
	}
	$('#show_banner_on, #show_banner_off').change(function() {
		disableBannerFormat();
	});
}

function disableBannerFormat() {
	if ($('#show_banner_on').prop('checked') == true) {
		$("#image").parent().parent().parent().parent().show();
		$("#url_banner").parent().parent().show();
	}
	else {
		$("#image").parent().parent().parent().parent().hide();
		$("#url_banner").parent().parent().hide();
	}
}

(function($) {
	$.fn.Mghomepage = function(obj) {
		var config = $.extend({}, {
			action:null, 
		}, obj);
	
		$(".check").click( function(){  
			if($(this).hasClass('disabled'))
				$(this).removeClass('disabled');
			else
				$(this).addClass('disabled');
				
			id_novpagemanage = $(this).data("idnovpagemanage");	
			$.ajax({
				url:config.action,
				data: 'id_novpagemanage='+id_novpagemanage+'&changestatus=1',
				type:'POST',
				}).done(function(msg) {
					return false;	
				});
			return false;	
		});
	
		$(".remove",this).click( function(){  	
			var check =  confirm('are you sure you want to delete this?');
			var hook = $(this).closest(".panel").attr('id');
			if(check == true){
				$(this).closest('li').remove();
				id_novpagemanage = $(this).data("idnovpagemanage");
				$.ajax({
					url:config.action,
					data: 'id_novpagemanage='+id_novpagemanage+'&deletedata=1',
					type:'POST',
					}).done(function() {
					});	
			}
			return false;
		} );
		
		page = new Object();
		$(".novpagemanage-list").sortable({
		opacity: 0.6,
		cursor: "move",
		connectWith: ".novpagemanage-list",
		update: function() {
			$(".nov-content .panel").each(
				function(){
					var id_hook = $(this).attr("id");
					page[id_hook] = [];
					$('ol.lever-1 > .novpagemanage-item',this).each(
						function(){
							row_idmanage = $(this).attr("id");
							idmanage = row_idmanage.replace("items_",""); 
							page[id_hook].push(idmanage);
							if($(".form-wrapper",this).length > 0){
								var string = "row"+idmanage;
								$('ol.lever-2 > .novpagemanage-item',this).each(
									function(){
										row_idmanage1 = $(this).attr("id");
										idmanage1 = row_idmanage1.replace("items_",""); 
										string = string + "-" + idmanage1;
									}								
								);
								page[id_hook].push(string);
							}
						}
					);
				}
			);
			var pages = JSON.stringify( page ); 
			var order = 'pages='+pages+ '&action=updatePosition';
			$.ajax({
				url:config.action,
				data: order,
				type:'POST',
			}).done(function() {
				
			});			
		}
	});
	
	$( ".novpagemanage-item" ).each(function() {
		var width = $(this).closest('.novpagemanage-list').width();		
		$( this ).resizable({
				maxHeight: 42,
				minHeight: 42,
				maxWidth : width,
				stop: function( event, ui ) {
					var size = ui.size.width;
					var col = Math.round( (size*12) / width );
					row_idmanage = $(this).attr("id");
					id_novpagemanage = row_idmanage.replace("items_",""); 						
					if(col >=12)
						col = 12;
					var this_class = $(this).attr("class");
					this_class = this_class.replace("novpagemanage-item", "").replace("novpagemanage-item-row", "").replace("ui-sortable-handle", "").trim();					
					$(this).removeClass(this_class).addClass("col-md-"+col+" col-sm-"+col);
					$(this).removeAttr( 'style' );
					var data = 'col='+col+ '&id_novpagemanage='+id_novpagemanage+'&action=updateCol';
					$.ajax({
						url:config.action,
						data: data,
						type:'POST',
					}).done(function() {
					});						
				}
			});
		});
	
	return this;
	};
})(jQuery);
