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