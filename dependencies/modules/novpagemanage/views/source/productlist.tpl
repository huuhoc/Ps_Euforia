{*/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package    novpagemanage
 * @version    1.0
 * @author    http://vinovathemes.com/
 * @copyright  Copyright (C) May 2017 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/
*}
{if isset($products)}
<div class="nov-productlist productlist-slider{if $list_style == 'item_list'} productlist-liststyle list-noborder{/if} col-md-{$columns nofilter} col-xs-12 {if isset($class) && $class}{$class nofilter}{/if}">
	<div class="block block-product clearfix">
		{if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
			<h2 class="title_block">
				{$title nofilter}
				{if isset($sub_title) && !empty($sub_title)}
					<span class="sub_title">{$sub_title}</span>
				{/if}
			</h2>
		{/if}
		<div class="block_content">
			{if isset($show_banner) && $show_banner == 1}
				<div class="d-flex">
					<div class="banner banner-1"><a href="{$link_banner1}"><img src="{$novpagemanage_img nofilter}{$image1 nofilter}" alt="banner 1"></a></div>
					<div class="banner banner-2"><a href="{$link_banner2}"><img src="{$novpagemanage_img nofilter}{$image2 nofilter}" alt="banner 2"></a></div>
				</div>
			{/if}
			{if !empty($products)}
				<div id="{$name_tab nofilter}" class="product_list{if $list_style == 'item_list'} list{else} grid{/if} owl-carousel owl-theme{if $number_row != 1} multi-row{/if}" data-autoplay="false" data-autoplayTimeout="6000" data-loop="false" data-margin="{$spacing_item}" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_tablet="{$column_tablet nofilter}" data-items_mobile="{$column_mobile nofilter}"{if isset($class) && $class=='special'} data-start="{$colspage/2 nofilter}"{/if}>
				{if $list_style == 'item_one'}
					{include file='_partials/layout/items/item_one.tpl' class_item='' number_row=$number_row show_countdown=$show_countdown}
				{elseif $list_style == 'item_two'}
					{include file='_partials/layout/items/item_two.tpl' class_item='' number_row=$number_row show_countdown=$show_countdown}
				{elseif $list_style == 'item_three'}
					{include file='_partials/layout/items/item_three.tpl' class_item='' number_row=$number_row show_countdown=$show_countdown}
				{else}
					{$novproducts=array_chunk($products,$number_row)}
					{foreach from=$novproducts item=products name=mypLoop}
					<div class="item item-list">
						{foreach from=$products item=product name=products}
							<div class="d-flex justify-content-start product-miniature js-product-miniature{if $smarty.foreach.products.first} first_item{elseif $smarty.foreach.products.last} last_item{/if}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
							    <div class="mr-5">
								    <div class="thumbnail-container">
								      {block name='product_thumbnail'}
								      {if isset($is_category) && !empty($is_category)}
								        {if isset($novconfig.novthemeconfig_second_img) && $novconfig.novthemeconfig_second_img == 1 && (count($product.images) > 1)}
								          <a href="{$product.url}" class="thumbnail product-thumbnail two-image">
								            <img 
								              class="img-fluid image-cover"
								              src = "{$product.cover.bySize.home_default.url}"
								              alt = "{$product.cover.legend}"
								              data-full-size-image-url = "{$product.cover.large.url}"
								              width="{$product.cover.bySize.home_default.width}"
								              height="{$product.cover.bySize.home_default.height}"
								            >
								            {foreach from=$product.images item=image}
								              {if $image.cover != '1'}
								                <img 
								                  class="img-fluid image-secondary"
								                  src = "{$image.bySize.home_default.url}"
								                  alt = "{$product.cover.legend}"
								                  data-full-size-image-url = "{$image.large.url}"
								                  width="{$product.cover.bySize.home_default.width}"
								              	  height="{$product.cover.bySize.home_default.height}"
								                >
								                {break}
								              {/if}
								            {/foreach}
								          </a>
								          {else}
								          <a href="{$product.url}" class="thumbnail product-thumbnail">
								            <img 
								              class="img-fluid image-cover"
								              src = "{$product.cover.bySize.home_default.url}"
								              alt = "{$product.cover.legend}"
								              data-full-size-image-url = "{$product.cover.large.url}"
								              width="{$product.cover.bySize.home_default.width}"
								              height="{$product.cover.bySize.home_default.height}"
								            >
								          </a>
								        {/if}
								       {else}
								       		<a href="{$product.url}" class="thumbnail product-thumbnail">
								            <img 
								              class="img-fluid image-cover"
								              src = "{$product.cover.bySize.home_default.url}"
								              alt = "{$product.cover.legend}"
								              data-full-size-image-url = "{$product.cover.large.url}"
								              width="{$product.cover.bySize.home_default.width}"
								              height="{$product.cover.bySize.home_default.height}"
								            >
									        </a>
								       {/if}
								      {/block}	
								    </div>
							    </div>

							    <div class="product-description">
							      {block name='product_name'}
							        <div class="product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></div>
							      {/block}
							      {hook h='displayProductListReviews' product=$product}
							      <div class="product-groups" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							        <div class="product-group-price">
							          {block name='product_price_and_shipping'}
							            {if $product.show_price}
							              <div class="product-price-and-shipping">
							                
							                {hook h='displayProductPriceBlock' product=$product type="before_price"}

							                <span itemprop="price" class="price">{$product.price}</span>

							                {if $product.has_discount}
							                  {hook h='displayProductPriceBlock' product=$product type="old_price"}

							                  <span class="regular-price">{$product.regular_price}</span>
							                  {*{if $product.discount_type === 'percentage'}
							                    <span class="discount-percentage">{$product.discount_percentage}</span>
							                  {/if}*}
							                {/if}

							                {hook h='displayProductPriceBlock' product=$product type='unit_price'}

							                {hook h='displayProductPriceBlock' product=$product type='weight'}
							              </div>
							            {/if}
							          {/block}
							        </div>
							        {*
									{assign var="link" value = Context::getContext()->link }
									{assign var="static_token" value = Tools::getToken(false)}
									<div class="product-buttons">
										<form action="{$link->getPageLink('cart')|escape:'html'}" method="post">
											<input type="hidden" name="token" value="{$static_token}">
											<input type="hidden" name="id_product" value="{$product.id}">
											<a class="add-to-cart" href="#" data-button-action="add-to-cart"><i class="novicon-cart"></i><span>{l s='Add to cart'}</span></a>
										</form>
									</div>
									*}
							      </div>
							    </div>
							</div>
						{/foreach}
					</div>
					{/foreach}
				{/if}
				</div>
			{else}
				<p class="alert alert-info">{l s='No products at this time.'}</p>
			{/if}
		</div>
	</div>
</div>
{/if}