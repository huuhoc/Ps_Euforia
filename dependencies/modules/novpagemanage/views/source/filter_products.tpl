{if !empty($products)}
	{foreach from=$products item=product name=products}
		{if ($number_load < 12) && (12/$number_load == 2.4) }
			{assign var='class_col' value='cus-5'}
		{else}
			{assign var='class_col' value=12/$number_load }
		{/if}
		<div class="item item-animate col-lg-{$class_col} col-md-{$class_col} col-xs-6 text-center">
			<div class="product-miniature js-product-miniature item-one{if $smarty.foreach.products.first} first_item{elseif $smarty.foreach.products.last} last_item{/if}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
			    <div class="thumbnail-container">
			      {block name='product_thumbnail'}
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
			      {/block}
			      <div class="group-action">
				      {if isset($novconfig.novthemeconfig_cat_product_quickview) && $novconfig.novthemeconfig_cat_product_quickview == 1 }
					      <a href="#" class="quick-view hidden-sm-down" data-link-action="quickview">
					        <i class="zmdi zmdi-search"></i>{* {l s='Quick view' d='Shop.Theme.Actions'} *}
					      </a>
				      {/if}
				      {*
				      {hook h='displayProductListFunctionalButtons' product=$product}
				      *}
				  </div>
			      {* Label *}
			      {block name='product_flags'}
			          {foreach from=$product.flags item=flag}
			            {if $flag.type == 'discount'}
			              {if ($product.has_discount && $product.discount_type === 'percentage') }
			              		
			                  <div class="product-flags {$flag.type}">{$product.discount_percentage}</div>
			              {else}
			              	{*
			                  <div class="product-flags {$flag.type}">{$flag.label}</div>
			                *}
			              {/if}
			            {/if}
			            
			          {/foreach}
			        
			      {/block}
			    		
			    </div>

			    <div class="product-description">
			      {if isset($show_countdown) && $show_countdown == 1}
			      {hook h='countdownProduct' product=$product}
			      {/if}
			      {block name='product_name'}
			        <div class="product-title" itemprop="name"><a href="{$product.url}">{$product.name}</a></div>
			      {/block}
			      {hook h='displayProductListReviews' product=$product}
			      <div class="product-groups d-flex justify-content-center" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
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

				 	<div class="product-desc" itemprop="desciption">{$product.description_short|strip_tags:'UTF-8'|truncate:140:'...'}</div>

						{assign var="link" value = Context::getContext()->link }
						{assign var="static_token" value = Tools::getToken(false)}
						<div class="product-buttons">
							<form action="{$link->getPageLink('cart')|escape:'html'}" method="post">
								<input type="hidden" name="token" value="{$static_token}">
								<input type="hidden" name="id_product" value="{$product.id}">
								<a class="add-to-cart" href="#" data-button-action="add-to-cart"><i class="zmdi zmdi-mall"></i><span>{l s='Add to cart'}</span></a>
							</form>
						</div>
			        
			      </div>

			    </div>		    
			</div>
		</div>
	{/foreach}
{/if}