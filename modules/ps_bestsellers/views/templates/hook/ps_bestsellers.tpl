{*
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="block-bestsellers">
  <div class="products">
    {foreach from=$products item="product"}
	    <div class="item">
			<div class="product-miniature js-product-miniature item-one{if $smarty.foreach.products.first} first_item{elseif $smarty.foreach.products.last} last_item{/if}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
			    <div class="thumbnail-container">
			      {block name='product_thumbnail'}
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
			      {/block}
			    </div>

			    <div class="product-description">
			      {block name='product_name'}
        	      <div class="product-title" itemprop="name"><a href="{$product.url}">{$product.name}</a></div>
			      {/block}
			      <div class="product-groups" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			      	
			      	{hook h='displayProductListReviews' product=$product}

			      	{if !$configuration.is_catalog}
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
			        {/if}
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
			      </div>

			    </div>
			</div>
		</div>
    {/foreach}
  </div>
  {*
  <a href="{$allBestSellers}" class="btn btn-default">{l s='All best sellers' d='Modules.Bestsellers'}</a>
  *}
</div>
