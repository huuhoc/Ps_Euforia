<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-xs-center" id="myModalLabel"><i class="fa fa-check"></i>{l s='Product successfully added to your shopping cart' d='Shop.Theme.Checkout'}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons close">close</i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 divide-right">
            <div class="row no-gutters">
              <div class="col-md-5">
                <img class="product-image img-fluid" src="{$product.cover.bySize.cart_default.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" itemprop="image">
              </div>
              <div class="col-md-7">
                <div class="h5 product-name">{$product.name}</div>
                <div class="product-price">{$product.price}</div>
                {hook h='displayProductPriceBlock' product=$product type="unit_price"}
                {foreach from=$product.attributes item="property_value" key="property"}
                  <span>{$property}: {$property_value}</span><br>
                {/foreach}
                <p>{l s='Quantity:' d='Shop.Theme.Checkout'}&nbsp;{$product.cart_quantity}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="cart-content">
              {if $cart.products_count > 1}
                <p class="cart-products-count">{l s='There are %products_count% items in your cart.' sprintf=['%products_count%' => $cart.products_count] d='Shop.Theme.Checkout'}</p>
              {else}
                <p class="cart-products-count">{l s='There is %product_count% item in your cart.' sprintf=['%product_count%' =>$cart.products_count] d='Shop.Theme.Checkout'}</p>
              {/if}
              <p>{l s='Total products:' d='Shop.Theme.Checkout'}&nbsp;{$cart.subtotals.products.value}</p>
              <p>{l s='Total shipping:' d='Shop.Theme.Checkout'}&nbsp;{$cart.subtotals.shipping.value} {hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</p>
              {if $cart.subtotals.tax}
              	<p>{$cart.subtotals.tax.label}&nbsp;{$cart.subtotals.tax.value}</p>
              {/if}
              <p>{l s='Total:' d='Shop.Theme.Checkout'}&nbsp;{$cart.totals.total.value} {$cart.labels.tax_short}</p>
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{l s='Continue shopping' d='Shop.Theme.Actions'}</button>
        <a href="{$cart_url}" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i>{l s='Proceed to checkout' d='Shop.Theme.Actions'}</a>
      </div>
    </div>
  </div>
</div>
