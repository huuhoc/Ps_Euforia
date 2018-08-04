{*
/******************

 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package   	novblockwishlist
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 
 * *****************/
*}

{if isset($wishlists) && count($wishlists) > 1}
	<div class="wishlist">
		<a class="wishlist_button_list" tabindex="0" data-toggle="popover" data-trigger="focus" title="{l s='Wishlist' mod='novblockwishlist'}" data-placement="bottom">
			<i class="fa fa-heart"></i>
			<span>{l s='Add to wishlist' d='Shop.Theme.Actions'}</span>	
		</a>
		<div hidden class="popover-content">
			{foreach name=wl from=$wishlists item=wishlist}
				<div class="item-wishlist" title="{$wishlist.name}" value="{$wishlist.id_wishlist}" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1, '{$wishlist.id_wishlist}');">{l s='Add to %s' sprintf=[$wishlist.name] d='Shop.Theme.Actions'}</div>
			{foreachelse}
				<a href="#" id="wishlist_button_nopop" onclick="WishlistCart('wishlist_block_list', 'add', '{$id_product|intval}', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;"   title="{l s='Add to my wishlist' d='Shop.Theme.Actions'}">
					<i class="fa fa-heart-o"></i>
					<span class="hidden">{l s="Add to Wishlist" d='Shop.Theme.Actions'}</span>
				</a>
			{/foreach}
		</div>
	</div>
{else}
	<a class="addToWishlist wishlistProd_{$product.id_product|intval}" href="#" data-rel="{$product.id_product|intval}" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1); return false;">
		<i class="fa fa-heart"></i>
		<span class="hidden">{l s="Add to Wishlist" d='Shop.Theme.Actions'}</span>
	</a>
{/if}