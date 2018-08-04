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
<section class="featured-products clearfix">
  <h1 class="h1 title_block text-uppercase ">
    {l s='Popular Products' d='Shop.Theme.Catalog'}
  </h1>
  <div class="products product_list grid owl-carousel owl-theme" data-autoplay="true" data-autoplaytimeout="6000" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="4" data-items_mobile="2">
    {foreach from=$products item="product"}
      <div class="item ajax_block_product product_block">
      {include file='catalog/_partials/miniatures/product-relate.tpl' product=$product}
      </div>
    {/foreach}
  </div>
  <a class="all-product-link pull-xs-left pull-md-right h4" href="{$allProductsLink}">
    {l s='All products' d='Shop.Theme.Catalog'}<i class="material-icons">&#xE315;</i>
  </a>
</section>