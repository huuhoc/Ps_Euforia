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

{if isset($novconfig.novthemeconfig_product_thumbtype) && $novconfig.novthemeconfig_product_thumbtype == 'false' }
  <div class="images-container">
  {block name='product_cover'}
    <div class="product-cover">
      <img 
        class="js-qv-product-cover img-fluid"
        src="{if $novconfig.novthemeconfig_product_layout == 'layout-one-column'}{$product.cover.bySize.large_default.url}{else}{$product.cover.bySize.large_default.url}{/if}"
        alt="{$product.cover.legend}"
        title="{$product.cover.legend}"
        style="width:100%;"
        itemprop="image"
      >
      <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
        <i class="fa fa-expand"></i>
      </div>
    </div>
  {/block}

  {block name='product_images'}
      <div class="js-qv-mask mask">
        <div class="product-images owl-carousel owl-theme" data-autoplay="false" data-autoplayTimeout="6000" data-items="{if isset($novconfig.novthemeconfig_product_thumb) && $novconfig.novthemeconfig_product_thumb }{$novconfig.novthemeconfig_product_thumb}{else}4{/if}" data-margin="10" data-nav="true" data-dots="false" data-loop="false" data-items_mobile="3">
          {foreach from=$product.images item=image}
            <div class="item thumb-container">
              <img
                class="thumb js-thumb img-fluid{if $image.id_image == $product.cover.id_image} selected{/if}"
                data-image-medium-src="{$image.bySize.medium_default.url}"
                data-image-large-src="{$image.bySize.large_default.url}"
                src="{$image.bySize.small_default.url}"
                alt="{$image.legend}"
                title="{$image.legend}"
                itemprop="image"
              >
            </div>
          {/foreach}
        </div>
      </div>
  {/block}
  </div>
{else}
  <div class="images-container thumb-vertical">
  {block name='product_cover'}
    <div class="product-cover">
      <img 
        class="js-qv-product-cover img-fluid"
        src="{if $novconfig.novthemeconfig_product_layout == 'layout-one-column'}{$product.cover.bySize.large_default.url}{else}{$product.cover.bySize.large_default.url}{/if}"
        alt="{$product.cover.legend}"
        title="{$product.cover.legend}"
        style="width:100%;"
        itemprop="image"
      >
      <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
        <i class="fa fa-expand"></i>
      </div>
    </div>
  {/block}

  {block name='product_images'}
      <div class="js-qv-mask mask">
        <div class="product-images slick-images" data-autoplay="false" data-autoplayTimeout="6000" data-items="{if isset($novconfig.novthemeconfig_product_thumb) && $novconfig.novthemeconfig_product_thumb }{$novconfig.novthemeconfig_product_thumb}{else}4{/if}" data-margin="10" data-nav="true" data-dots="false" data-loop="false" data-items_mobile="3">
          {foreach from=$product.images item=image name=productimages}

            <div class="item thumb-container">
              <img
                class="thumb js-thumb img-fluid{if $image.id_image == $product.cover.id_image} selected{/if}"
                data-image-medium-src="{$image.bySize.medium_default.url}"
                data-image-large-src="{$image.bySize.large_default.url}"
                data-position-image="{$smarty.foreach.productimages.index}"
                src="{$image.bySize.small_default.url}"
                alt="{$image.legend}"
                title="{$image.legend}"
                itemprop="image"
              >
            </div>
          {/foreach}
        </div>
      </div>
  {/block}
  </div>
{/if}
