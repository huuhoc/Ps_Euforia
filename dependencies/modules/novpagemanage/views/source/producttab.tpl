<div class="col-md-{$columns} col-xs-12{if isset($class) && $class} {$class}{/if}">
	<div class="block" id="{$tab}">
		{if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
		<h4 class="title_block">
			{$title nofilter}
		</h4>
		{/if}
		{*
		{if $show_image && $show_image == 1 && $image}	
		<div class="block-image">
			<img src="{$novpagemanage_img}{$image}" alt="" title="">
		</div>
		{/if}
		*}
		<div class="block_content">
			<ul  class="nav nav-tabs justify-content-end" role="tablist">
              {if $show_newproduct && $show_newproduct == 1}	
              <li class="nav-item"><a href="#{$tab}newproducts" class="nav-link active" role="tab" data-toggle="tab"><span></span>{l s='New Arrivals' mod='novpagemanage'}</a></li>
			  {/if}
			  {if $show_special && $show_special == 1}	
              <li class="nav-item"><a href="#{$tab}special" class="nav-link" role="tab" data-toggle="tab">{l s='Special' mod='novpagemanage'}</a></li>
			  {/if}
			  {if $show_bestseller && $show_bestseller == 1}	
              <li class="nav-item"><a href="#{$tab}bestseller" class="nav-link" role="tab" data-toggle="tab"><span></span>{l s='Best Seller' mod='novpagemanage'}</a></li>
			  {/if}
			  {if $show_display && $show_display == 1}	
              <li class="nav-item"><a href="#{$tab}featured" class="nav-link" role="tab" data-toggle="tab"><span></span>{l s='Featured Products' mod='novpagemanage'}</a></li>
			  {/if}
			  {if isset($categories) && $categories }	
				{foreach from=$categories item=category key=k}
					<li class="nav-item"><a href="#{$tab}category{$k}" class="nav-link" role="tab" data-toggle="tab"><span></span>{$category.name}</a></li>
				{/foreach}	
			  {/if}				
            </ul>
			
            <div id="product_tab_content">
				<div class="product_tab_content tab-content">
				  	{if $show_newproduct && $show_newproduct == 1}
					  	<div class="tab-pane fade in active" id="{$tab}newproducts">
							{$products=$newproducts} {$name_tab="{$tab}-newproducts"}
							{if !empty($products)}
							<div id="{$name_tab nofilter}" class="product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplayTimeout="6000" data-loop="true" data-margin="0" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_mobile="2">
								{include file='_partials/layout/items/item_one.tpl' class_item="" number_row=1 show_countdown=0}
							</div>
							{else}
								<p class="alert alert-info">{l s='No products at this time.'}</p>
							{/if}
					  	</div>
					{/if}
				   	{if $show_special && $show_special == 1}	
						<div class="tab-pane fade" id="{$tab}special">
							{$products=$special}{$name_tab="{$tab}-special"}
							{if !empty($products)}
							<div id="{$name_tab nofilter}" class="product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplayTimeout="6000" data-loop="true" data-margin="0" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_mobile="2">
								{include file='_partials/layout/items/item_one.tpl' class_item="" number_row=1 show_countdown=0}
							</div>
							{else}
								<p class="alert alert-info">{l s='No products at this time.'}</p>
							{/if}
					  	</div>
				  	{/if}
				 	{if $show_bestseller && $show_bestseller == 1}
					  	<div class="tab-pane fade" id="{$tab}bestseller">
							{$products=$bestseller} {$name_tab="{$tab}-bestseller"}
							{if !empty($products)}
							<div id="{$name_tab nofilter}" class="product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplayTimeout="6000" data-loop="true" data-margin="0" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_mobile="2">
								{include file='_partials/layout/items/item_one.tpl' class_item="" number_row=1 show_countdown=0}
							</div>
							{else}
								<p class="alert alert-info">{l s='No products at this time.'}</p>
							{/if}
					  	</div>
				 	{/if}	
				 
				 	{if $show_display && $show_display == 1}	
					  	<div class="tab-pane fade" id="{$tab}featured">
							{$products=$featured} {$name_tab="{$tab}-featured"}
							{if !empty($products)}
							<div id="{$name_tab nofilter}" class="product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplayTimeout="6000" data-loop="true" data-margin="0" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_mobile="2">
								{include file='_partials/layout/items/item_one.tpl' class_item="" number_row=1 show_countdown=0}
							</div>
							{else}
								<p class="alert alert-info">{l s='No products at this time.'}</p>
							{/if}
					  	</div>   
					{/if}
					{if isset($categories) && $categories }	
						{foreach from=$categories item=category key=k}
							{$products=$category.products} {$name_tab="{$tab}-category-{$k}"}
							{if !empty($products)}
						  	<div class="tab-pane fade" id="{$tab}category{$k}">
								{include file='_partials/layout/items/item_one.tpl' class_item="" number_row=1 show_countdown=0}
						  	</div>
						  	{else}
								<p class="alert alert-info">{l s='No products at this time.'}</p>
							{/if}
						{/foreach}
					{/if}
				
				</div>
			</div>
		</div>
	</div>
</div>
{*
<script>
$(document).ready(function() {
    $('#{$tab} .carousel').carousel({
            pause: 'hover',
            interval: {$interval}
    });
	$("#{$tab} ul.nov-tab li", this).first().addClass("active");
	$("#{$tab} .tab-content .tab-pane", this).first().addClass("active");
 
});
</script>
*}
