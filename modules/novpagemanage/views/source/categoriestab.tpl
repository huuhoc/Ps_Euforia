{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
**}

<div class="products_block product-tabs col-md-{$columns} col-sm-{$columns} col-xs-{$columns} {if isset($class) && $class}{$class}{/if}">
	<div id="{$tab}" class="block-product clearfix">
		{if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
			<h2 class="title_block">
				{if isset($image_icon) && !empty($image_icon)}
					<img src="{$novpagemanage_img}{$image_icon}" alt="icon title">
				{/if}
				{$title}
				{if isset($sub_title) && !empty($sub_title)}
					<span class="sub_title">{$sub_title}</span>
				{/if}
			</h2>
		{/if}
		<div class="block_content">
			<ul class="nav nav-tabs justify-content-center" role="tablist">
			  {if isset($categories) && $categories }
				{foreach from=$categories item=category key=k name=categories}
					<li class="nav-item">
						<a class="nav-link{if $smarty.foreach.categories.first } active{/if}" href="#{$tab}category{$k}" role="tab" data-toggle="tab">{$category.name}</a>
					</li>
				{/foreach}
			  {/if}				
            </ul>
			<!-- Tab panes -->
			<div class="product_tab_content tab-content">
			{if isset($categories) && $categories }
				{foreach from=$categories item=category key=k name=categories}
				  	<div class="tab-pane fade {if $smarty.foreach.categories.first }in active{/if}" id="{$tab}category{$k}" role="tabpanel">
						{$products=$category.products} {$name_tab="{$tab}-category-{$k}"}
					  	{if !empty($products)}
					  		<div id="{$name_tab}" class="product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplayTimeout="6000" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="{$colspage}" data-items_mobile="2">
								{if $list_style == 'item_one'}
									{include file='_partials/layout/items/item_one.tpl' class_item='' number_row=$number_row}
								{elseif $list_style == 'item_two'}
									{include file='_partials/layout/items/item_two.tpl' class_item='' number_row=$number_row}
								{else}
									{include file='_partials/layout/items/item_three.tpl' class_item='' number_row=$number_row}
								{/if}
							</div>
						{else}
							<p class="alert alert-info">{l s='No products at this time.'}</p>	
						{/if}
			  		</div>
				{/foreach}
			{/if}
			</div>
		</div>
	</div>
</div>