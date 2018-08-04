/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package   	novpagemanage
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 
 * *****************/
$(document).ready(function() {
	$('.toggle-filter').click(function(){
		var label = $(this).data('label');
		var label_hidden = $(this).data('label-hidden');
		if($('.content_filter').hasClass('active')){
            $('.content_filter').slideUp(300);
            $(this).removeClass('active');
            $(this).html(label);
            $('.content_filter').removeClass('active');
        } else {
        	$('.content_filter').slideDown(300);
            $(this).addClass('active');
            $(this).html(label_hidden);
            $('.content_filter').addClass('active');
        }
	});
	$('.toggle-category').click(function(){
		if($('.category').hasClass('active')){
            $('.category').slideUp(300);
            $('.category').removeClass('active');
        } else {
        	$('.category').slideDown(300);
            $('.category').addClass('active');
        }
	});
    
	//select list for search type
	$('.filter-sortby').on('click','li', function(e){
		e.preventDefault();
		$('.filter-sortby .dropdown-item').removeClass('active');
		$(this).addClass('active');
		$('.filter-sortby .dropdown-toggle').html($(this).html());
		dizznhau();
	});

	$('.nov-filter-title').click(function(){
		if($(this).parent('div').children('.filter_product').hasClass('active')){
            $(this).parent('div').children('.filter_product').slideUp(300).removeClass('active');
            $(this).addClass('active');
        } else {
        	$(this).parent('div').children('.filter_product').slideDown(300).addClass('active');
            $(this).removeClass('active');
        }
	});

	dizznhau();
	function dizznhau(){
		$( ".block_content_filter" ).each(function( ) {
			var $elements = $(this);
			$('ul.filter_product li',$elements).click(function(){
				if($(this).hasClass("active")){
					$(this).removeClass("active");
				}else{
					if($(this).parent().hasClass('list-category')){
						$("li",$(this).parent()).removeClass("active");
					}
					$(this).addClass("active");
				}
				$(".count_showmore",$elements).val(0);
				_evenFilter($elements);
			});
			/*var timer;
			$(window).scroll(function(){
			    if ( timer ) clearTimeout(timer);
			    timer = setTimeout(function(){
			        if($(window).scrollTop() >= $(".novShowMore").offset().top - 500){
		                var count_showmore = $(".count_showmore",$elements).val();
						var count_showmore = parseInt(count_showmore) + 1;
						$(".count_showmore",$elements).val(count_showmore);
						_evenFilter($elements,true);
		            }
			    }, 1000);
			});*/
			
			$('.novShowMore',$elements).click(function(){
				var count_showmore = $(".count_showmore",$elements).val();
				var count_showmore = parseInt(count_showmore) + 1;
				$(".count_showmore",$elements).val(count_showmore);
				_evenFilter($elements,true);
			});
			
			$('.clear_all',$elements).click(function(e){
				var $content_filter = $(".content_filter",$elements);
				var $nov_slider_price = $("#nov_slider_price",$elements);
				$("li",$content_filter).removeClass('active');	
				$("#price-filter-min-text",$elements).val($nov_slider_price.data("min"));
				$("#price-filter-max-text",$elements).val($nov_slider_price.data("max"));
				$("#text-price-filter-min-text",$elements).html($nov_slider_price.data("min"));
				$("#text-price-filter-max-text",$elements).html($nov_slider_price.data("max"));
				$(".ui-slider-range",$nov_slider_price).css({"left": "0px", "width": "100%"});
				$("a",$nov_slider_price).first().css("left","0px");
				$("a",$nov_slider_price).last().css("left","100%");
				_evenFilter($elements);
			});			
			
			min_price = $("#price-filter-min-text",$elements).val();
			max_price =  $("#price-filter-max-text",$elements).val();
			$("#nov_slider_price",$elements).slider({
			range:true,
			min: $("#nov_slider_price",$elements).data('min'),
			max: $("#nov_slider_price",$elements).data('max'),		
			values: [min_price,max_price],
			slide : function( event, ui ) {
					$("#price-filter-min-text",$elements).val(ui.values[0]);		
					$("#price-filter-max-text",$elements).val(ui.values[1]);	
					
					$("#text-price-filter-min-text",$elements).html(ui.values[0]);
					$("#text-price-filter-max-text",$elements).html(ui.values[1]);	
				},
			change: function( event, ui ) {
					$(".count_showmore",$elements).val(0);
					_evenFilter($elements);
					return false;
				}
			});
			
		});	
	}
	function _novSetAnimate(element){
		$_items = $('.item-animate',element);
		$_items.each(function(i){
			$(this).attr("style", "-webkit-animation-delay:" + i * 300 + "ms;"
	                + "-moz-animation-delay:" + i * 300 + "ms;"
	                + "-o-animation-delay:" + i * 300 + "ms;"
	                + "animation-delay:" + i * 300 + "ms;");
		});
	}
	
	function _evenFilter($elements, $showmore){
		var id_category = $(".category li.active",$elements).data("id_category");
			id_category = (id_category !== 0) ? id_category : "";
		var count_showmore = $(".count_showmore",$elements).val();
			count_showmore = (count_showmore !== undefined) ? count_showmore : "";		
		var min_price = $("#price-filter-min-text").val();	
		var max_price = $("#price-filter-max-text").val();
		var loading_text = $('.novShowMore', $elements).data('loading');
		var loadmore_text = $('.novShowMore', $elements).data('loadmore');		
		var id_attribute = [];
		$( "ul.atribute li.active",$elements).each(function(index){
			id_attribute[index] = $(this).data("id_attribute");
		});
		
		var id_manufacture = [];
		$(".manufacture li.active",$elements).each(function(index){
			id_manufacture[index] = $(this).data("id_manufacture");
		});	
			
		var orderby =  $('.dropdown-item.active',$elements ).data("value") ? $('.dropdown-item.active',$elements ).data("value") : "date_add";
		var limit = $elements.data("limit");
		var numberload = $elements.data("numberload");
		
		$('.process-loading',$elements).addClass('active');
		$('.novShowMore', $elements).html(loading_text);
		$('.item-animate',$elements).removeClass('item-animate');
		$.ajax({
			type: 'POST',
			url: $elements.data("action"),
			data : '&action=filter_product&id_category='+id_category+'&id_manufacture='+id_manufacture+'&id_attribute='+id_attribute+'&orderby='+orderby+'&limit='+limit+'&count_showmore='+count_showmore+'&numberload='+numberload+'&min_price='+min_price+'&max_price='+max_price,
			success: function(html) {
				$('.process-loading',$elements).delay(2500).removeClass('active');
				$('.novShowMore', $elements).html(loadmore_text);
				if($showmore){
					if(html) {
						$(".product_list",$elements).append(html);
						_novSetAnimate($elements);
					}
					else {
						$(".content_showmore",$elements).addClass("hidden-sm-up");
					}
				}else {
					$(".product_list",$elements).html(html);
					_novSetAnimate($elements);
				}
				var $content_filter = $(".content_filter",$elements);
				if($("li.active",$content_filter).length > 0 || ($("#price-filter-min-text",$elements).val() != $("#nov_slider_price",$elements).data("min"))  || ($("#price-filter-max-text",$elements).val() != $("#nov_slider_price",$elements).data("max")))
					$(".clear_all",$elements).show();
				else
					$(".clear_all",$elements).hide();
	      	}
		});
		
	}
	
});