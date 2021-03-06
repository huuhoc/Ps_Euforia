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
{$novproducts=array_chunk($products,$number_row)}
{foreach from=$novproducts item=products name=mypLoop}
<div class="item {$class_item}">
	{foreach from=$products item=product name=products}
		<div class="row d-flex no-gutters product-miniature js-product-miniature item-three{if $smarty.foreach.products.first} first_item{elseif $smarty.foreach.products.last} last_item{/if}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
			<div class="col-6">
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
			          {*
			          <div class="highlighted-informations{if !$product.main_variants} no-variants{/if} hidden-sm-down">
			            {block name='product_variants'}
			              {if $product.main_variants}
			                {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
			              {/if}
			            {/block}
			          </div>
			          *}
			        </div>
			        {*
		        	<div class="info-stock">
		              {if $product.availability_message}
		                {if $product.availability == 'available'}
		                  <i class="fa fa-check-square-o" aria-hidden="true"></i>
		                {elseif $product.availability == 'last_remaining_items'}
		                  <i class="fa fa-exclamation-triangle product-last-items" aria-hidden="true"></i>
		                {else}
		                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		                {/if}
		                {$product.availability_message}
		              {/if}
		     	 	</div>
		     	 	*}

				 	<div class="product-desc" itemprop="desciption">
				 		{$product.description_short nofilter} {*This is html content*}
				 	</div>
				 	{*{if isset($special_promotion) && $special_promotion}
				 		<div class="notify special_promotion d-flex align-items-center"><i class="fa fa-gift"></i><span>{l s='Special promotion' d='Shop.Theme.Productinfo'}</span></div>
				 	{/if}
				 	{if isset($installment) && $installment}
				 		<div class="notify installment d-flex align-items-center"><i class="fa fa-money"></i><span>{l s='Installment' d='Shop.Theme.Productinfo'}</span></div>
				 	{/if}*}
			        {if !$configuration.is_catalog}
						{assign var="link" value = Context::getContext()->link }
						{assign var="static_token" value = Tools::getToken(false)}
						<div class="product-buttons">
							<form action="{$link->getPageLink('cart')|escape:'html'}" class="d-flex flex-row" method="post">
								<input type="hidden" name="token" value="{$static_token}">
								<input type="hidden" name="id_product" value="{$product.id}">
								<a class="add-to-cart" href="#" data-button-action="add-to-cart"><i class="zmdi zmdi-mall"></i><span>{l s='Add to cart' d='Shop.Theme.Actions'}</span></a>
								{hook h='displayProductListFunctionalButtons' product=$product}
								{if isset($novconfig.novthemeconfig_cat_product_quickview) && $novconfig.novthemeconfig_cat_product_quickview == 1 }
							      <a href="#" class="quick-view" data-link-action="quickview">
							        <i class="zmdi zmdi-search"></i>{* {l s='Quick view' d='Shop.Theme.Actions'} *}
							      </a>
						      {/if}
						      
							</form>
							
						</div>
					{/if}
			        
			      	</div>
			     </div>
		    </div>

			<div class="col-6">
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
			     
			      {* Label *}
			      {block name='product_flags'}
			          {foreach from=$product.flags item=flag}
			            {if $flag.type == 'discount'}
			              {if ($product.has_discount && $product.discount_type === 'percentage') }
			                  <div class="product-flags {$flag.type}">{$product.discount_percentage}</div>
			              {else}
			                  <div class="product-flags {$flag.type}">{$flag.label}</div>
			              {/if}
			            {elseif $flag.type == 'new'}
			            	
			            {else}
			            <div class="product-flags {$flag.type}">{$flag.label}</div>
			            {/if}
			          {/foreach}
			        
			      {/block}
			    </div>
		    </div>  
		</div>
	{/foreach}
</div>
{/foreach}