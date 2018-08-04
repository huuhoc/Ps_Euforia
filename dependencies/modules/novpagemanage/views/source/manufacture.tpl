{if isset($manufacturers) && $manufacturers}
<div class="nov-manufacture {if isset($class) && $class}{$class}{/if} col-md-{$columns} col-sm-{$columns} col-xs-12 ">
	<div class="block" >
		{if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
			<div class="title_block">
				{$title nofilter}
			</div>
		{/if}
		<div class="block_content">
			<div id="{$name_tab}" class="owl-carousel owl-theme owl-loaded owl-drag" data-autoplay="true" data-autoplaytimeout="6000" data-loop="true" data-margin="{$spacing_item}" data-dots="false" data-nav="false" data-items="{$colspage nofilter}" data-items_tablet="{$column_tablet nofilter}" data-items_mobile="{$column_mobile nofilter}">
				{foreach from=$manufacturers item=manufacturer name=manufacturers}
					<div class="item logo-manu">
						<a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'htmlall':'UTF-8'}" title="{l s='view products' mod='novpagemanage'}">
						<img class="img-fluid" src="{$manufacturer.image|escape:'htmlall':'UTF-8'}" alt=""/></a>
					</div>
				{/foreach}
					
			</div>
		</div>
	</div>
</div>
{/if}