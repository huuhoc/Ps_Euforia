{if !empty($products)}
<div id="{$name_tab nofilter}" class="product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplayTimeout="6000" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_mobile="2">
	{foreach from=$products item=product name=products}
		<div class="product-miniature js-product-miniature item {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product" >
		    <div class="thumbnail-container">
		      {block name='product_thumbnail'}
		        <a href="{$product.url}" class="thumbnail product-thumbnail">
		          <img
		            class="img-fluid"
		            src = "{$product.cover.bySize.home_default.url}"
		            alt = "{$product.cover.legend}"
		            data-full-size-image-url = "{$product.cover.large.url}"
		          >
		        </a>
		      {/block}
		      <a href="#" class="quick-view hidden-sm-down" data-link-action="quickview">
		        <i class="fa fa-search"></i>{* {l s='Quick view' d='Shop.Theme.Actions'} *}
		      </a>
		      {* Label *}
		      {block name='product_flags'}
		          {foreach from=$product.flags item=flag}
		            {if $flag.type == 'discount'}
		              {if ($product.has_discount && $product.discount_type === 'percentage') }
		                  <div class="product-flags {$flag.type}">{$product.discount_percentage}</div>
		              {else}
		                  <div class="product-flags {$flag.type}">{$flag.label}</div>
		              {/if}
		            {else}
		            <div class="product-flags {$flag.type}">{$flag.label}</div>
		            {/if}
		          {/foreach}
		        
		      {/block}

		    </div>

		    <div class="product-description">
		      {block name='product_name'}
		        <div class="product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></div>
		      {/block}
		      <div class="product-groups">
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

		        {if !$configuration.is_catalog}
		        <div class="product-buttons">
		        	<form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
			            <input type="hidden" name="token" value="{$static_token}">
			            <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
			            <button class="add-to-cart" href="#" data-button-action="add-to-cart" type="submit" {if !$product.add_to_cart_url || $product.minimal_quantity > $product.quantity} disabled{/if}><i class="fa fa-shopping-cart"></i>{l s='Add to cart'}</button>
			        </form>
		          	{hook h='displayProductListFunctionalButtons' product=$product}
		        </div>
			    {/if}
		        
		      </div>

		    </div>		    
		</div>
	{/foreach}
</div>
{/if}