{*/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package    novtestimonials
 * @version    1.0
 * @author    http://vinovathemes.com/
 * @copyright  Copyright (C) May 2017 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/
*}
{if isset($novtestimonials) && !empty($novtestimonials)}
	{if isset($config_testimonials.novtestimonials_type) && $config_testimonials.novtestimonials_type == 'type_one'}
	<div id="testimonial_block" class="owl-carousel owl-theme testimonial-type-one vdvdvd" data-autoplay="true" data-autoplaytimeout="7000" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="{$config_testimonials.novtestimonials_item_desktop}" data-items_tablet="{$config_testimonials.novtestimonials_item_tablet}" data-items_mobile="{$config_testimonials.novtestimonials_item_mobile}">
		{foreach from=$novtestimonials item=testimonials name=testimonial}
			<div class="item type-one">
				<div class="media align-items-center">
					{if isset($testimonials.image) && $testimonials.image neq "" }
					<div class="testimonial-avarta d-flex">
						<img class="img-fluid" src="{$config_testimonials.link_image}{$testimonials.image}" alt="">
					</div>
					{/if}
					<div class="media-body">
						{if $testimonials.name }
						<h5 class="mt-0 box-info">{$testimonials.name}</h5>
						{/if}
						{if $testimonials.address }
							<span class="box-dress">{$testimonials.address}</span>
						{/if}
						<div class="text">{$testimonials.content}</div>
					</div>
				</div>
			</div>
		{/foreach}
	</div>
	{elseif isset($config_testimonials.novtestimonials_type) && $config_testimonials.novtestimonials_type == 'type_two'}
	<div id="testimonial_block" class="owl-carousel owl-theme testimonial-type-two" data-autoplay="true" data-autoplaytimeout="7000" data-loop="true" data-margin="30" data-dots="true" data-nav="false" data-items="{$config_testimonials.novtestimonials_item_desktop}" data-items_tablet="{$config_testimonials.novtestimonials_item_tablet}" data-items_mobile="{$config_testimonials.novtestimonials_item_mobile}">
		{foreach from=$novtestimonials item=testimonials name=testimonial}
			<div class="item type-two">
				{*
				{if isset($testimonials.image) && $testimonials.image neq "" }
				<div class="testimonial-avarta">
					<img class="img-fluid" src="{$config_testimonials.link_image}{$testimonials.image}" alt="">
				</div>
				{/if}
				*}
				<h5 class="mt-10 name">{$testimonials.name}</h5>
				{if isset($testimonials.company) && $testimonials.company }
				<div class="company mt-15">{$testimonials.company}</div>
				{/if}
				<div class="text">{$testimonials.content}</div>
				{*
				{if $testimonials.address }
					<span class="box-dress">{$testimonials.address}</span>
				{/if}
				*}
			</div>
		{/foreach}
	</div>
	{else}
	<div id="testimonial_block" class="owl-carousel owl-theme testimonial-type-three" data-autoplay="true" data-autoplaytimeout="700" data-loop="true" data-margin="30" data-dots="true" data-nav="false" data-items="{$config_testimonials.novtestimonials_item_desktop}" data-items_tablet="{$config_testimonials.novtestimonials_item_tablet}" data-items_mobile="{$config_testimonials.novtestimonials_item_mobile}">
		{foreach from=$novtestimonials item=testimonials name=testimonial}
			<div class="item type-three">
				<div class="media">
					{if isset($testimonials.image) && $testimonials.image neq "" }
					<div class="testimonial-avarta d-flex">
						<img class="img-fluid" src="{$config_testimonials.link_image}{$testimonials.image}" alt="">
					</div>
					{/if}
					<div class="media-body">
						<div class="text">{$testimonials.content}</div>
						{if $testimonials.name }
						<h5 class="mt-0 box-name">{$testimonials.name}</h5>
						{/if}
						{if $testimonials.address }
							<span class="box-dress">{$testimonials.address}</span>
						{/if}
					</div>
				</div>
			</div>
		{/foreach}
	</div>

	{/if}

{/if}