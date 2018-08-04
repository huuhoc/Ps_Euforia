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

<div id="_desktop_cart">
    <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
        <div class="header-cart">
            {if $cart.products_count > 0}
                <a rel="nofollow" href="{$cart_url}"> 
            {/if}
                <i class="zmdi zmdi-shopping-cart"></i>
                <span class="title-cart">{l s='My Cart' d='Shop.Theme.Checkout'}</span>
                <span class="cart-products-count"><span class="count-style--one">( {$cart.products_count} )</span><span class="count-style--two">{$cart.products_count}</span></span>
            {if $cart.products_count > 0}
                </a>
            {/if}
        </div>
        <div class="cart_block {if $cart.products_count > 3}has-scroll{/if}">
            <div class="cart-block-content">
                {if $cart.products_count > 0}
                    <ul>
                        {foreach from=$cart.products item=product}
                            <li>{include 'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' product=$product}</li>
                        {/foreach}
                    </ul>
                    <div class="cart-subtotals">
                        {foreach from=$cart.subtotals item="subtotal"}
                            {if $subtotal.type != "" }
                                <div class="{$subtotal.type}">
                                    <span class="label">{$subtotal.label}:</span>
                                    <span class="value">{$subtotal.value}</span>
                                </div>
                            {/if}
                        {/foreach}
                    </div>
                    <div class="cart-total">
                        <span class="label">{$cart.totals.total.label}:</span>
                        <span class="value">{$cart.totals.total.value}</span>
                    </div>
                    <div class="cart-buttons d-flex">
                        {assign var="link" value = Context::getContext()->link }
                        <a href="{$cart_url}" class="btn btn-primary">{l s='View cart' d='Shop.Theme.Actions'}</a>
                        <a href="{$link->getPageLink('order')|escape:'html'}" class="btn btn-primary">{l s='Checkout' d='Shop.Theme.Actions'}</a>
                    </div>
                {else}
                    <div class="no-items">
                        {l s='No products in the cart' d='Shop.Theme.Checkout'}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>