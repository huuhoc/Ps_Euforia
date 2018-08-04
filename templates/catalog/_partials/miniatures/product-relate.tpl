{**
 * 2007-2016 PrestaShop
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
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
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
        <div class="product-buttons">
          <button class="add-to-cart" href="#" data-button-action="add-to-cart"{if !$product.add_to_cart_url || $product.minimal_quantity > $product.quantity} disabled{/if}>
            <i class="zmdi zmdi-mall"></i>
            <span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
          </button>
        </div>
        
      </div>

    </div>
    
</article>