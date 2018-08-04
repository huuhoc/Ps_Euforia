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
 *}
<div id="js-checkout-summary" class="cart-summary js-cart" data-refresh-url="{$urls.pages.cart}?ajax=1&action=refresh">
    {block name='hook_checkout_summary_top'}
  {hook h='displayCheckoutSummaryTop'}
    {/block}
  {block name='cart_summary_products'}
    <div class="cart-summary-products">
      <div class="summary-label">{l s='There are %cart_item% in your cart' sprintf=['%cart_item%' => $cart.summary_string] d='Shop.Theme.Checkout'}</div>
      <div class="show-details">
        <a href="#" data-toggle="collapse" data-target="#cart-summary-product-list">
          {l s='show details' d='Shop.Theme.Actions'}
        </a>
      </div>
      {block name='cart_summary_product_list'}
        <div class="collapse" id="cart-summary-product-list">
          <ul class="media-list">
            {foreach from=$cart.products item=product}
              <li class="media">{include file='checkout/_partials/cart-summary-product-line.tpl' product=$product}</li>
            {/foreach}
          </ul>
        </div>
      {/block}
    </div>
  {/block}

  {block name='cart_summary_subtotals'}
    {foreach from=$cart.subtotals item="subtotal"}
      {if $subtotal.value && $subtotal.type !== 'tax'}
        <div class="cart-summary-line" id="cart-subtotal-{$subtotal.type}">
          <span class="label{if 'products' === $subtotal.type} js-subtotal{/if}">
            {if 'products' == $subtotal.type}
              {l s="Total products" d='Shop.Theme.Checkout'}:
            {else}
              {l s='Total %label_subtotal%' sprintf=['%label_subtotal%' => $subtotal.label] d='Shop.Theme.Checkout'}:
            {/if}
          </span>
          <span class="value">{$subtotal.value}</span>
          {if $subtotal.type === 'shipping'}
              <div><small class="value">{hook h='displayCheckoutSubtotalDetails' subtotal=$subtotal}</small></div>
          {/if}
        </div>
      {/if}
    {/foreach}
  {/block}

  {block name='cart_summary_voucher'}
    {include file='checkout/_partials/cart-voucher.tpl'}
  {/block}

  {block name='cart_summary_totals'}
    {include file='checkout/_partials/cart-summary-totals.tpl' cart=$cart}
  {/block}

</div>
