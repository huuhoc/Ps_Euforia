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
<div class="buttons_bottom_block no-print">
	<div id="wishlist_button">
		<select id="idWishlist">
			{foreach $wishlists as $wishlist}
				<option value="{$wishlist.id_wishlist}">{$wishlist.name}</option>
			{/foreach}
		</select>
		<button class="" onclick="WishlistCart('wishlist_block_list', 'add', '{$id_product|intval}', $('#idCombination').val(), document.getElementById('quantity_wanted').value, $('#idWishlist').val()); return false;"  title="{l s='Add to wishlist' mod='novblockwishlist'}">
			{l s='Add' mod='novblockwishlist'}
		</button>
	</div>
</div>
{else}
<p class="buttons_bottom_block no-print">
	<a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '{$id_product|intval}', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;"   title="{l s='Add to my wishlist' mod='novblockwishlist'}">
		{l s='Add to wishlist' mod='novblockwishlist'}
	</a>
</p>
{/if}
