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