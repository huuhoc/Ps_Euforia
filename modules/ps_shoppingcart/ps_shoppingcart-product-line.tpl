<div class="media">
  <img class="d-flex product-image" src="{$product.cover.bySize.cart_default.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}">
  <div class="media-body">
    <div class="product-name">{$product.name}</div>
    <span class="quantity">{$product.quantity} x </span>
    <span class="product-price">{$product.price}</span>
    <a  class="remove-from-cart" rel="nofollow" href="{$product.remove_from_cart_url}" data-link-action="remove-from-cart" title="{l s='remove from cart' d='Shop.Theme.Actions'}">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
        {*
        {l s='Remove' d='Shop.Theme.Actions'}
        *}
    </a>
  </div>
</div>
{if $product.customizations|count}
    <div class="customizations">
        <ul>
            {foreach from=$product.customizations item='customization'}
                <li>
                    <span class="product-quantity">{$customization.quantity}</span>
                    <a href="{$customization.remove_from_cart_url}" title="{l s='remove from cart' d='Shop.Theme.Actions'}" class="remove-from-cart" rel="nofollow">{l s='Remove' d='Shop.Theme.Actions'}</a>
                    <ul>
                        {foreach from=$customization.fields item='field'}
                            <li>
                                <span>{$field.label}</span>
                                {if $field.type == 'text'}
                                    <span>{$field.text nofilter}</span>
                                {else if $field.type == 'image'}
                                    <img src="{$field.image.small.url}">
                                {/if}
                            </li>
                        {/foreach}
                    </ul>
                </li>
            {/foreach}
        </ul>
    </div>
{/if}
