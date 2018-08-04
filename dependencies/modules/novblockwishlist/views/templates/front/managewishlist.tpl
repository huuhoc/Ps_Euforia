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

{if $products}
	{if !$refresh}
	<div class="wishlistLinkTop">
		<a href="#" id="hideWishlist" class="button_account" onclick="WishlistVisibility('wishlistLinkTop', 'Wishlist'); return false;" title="{l s='Close this wishlist' mod='novblockwishlist'}" ><i class="material-icons close">close</i></a>
		<ul class="clearfix display_list">
			<li>
				<a href="#" id="hideBoughtProducts" class="button_account"  onclick="WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;" title="{l s='Hide products' mod='novblockwishlist'}">{l s='Hide products' mod='novblockwishlist'}</a>
				<a href="#" id="showBoughtProducts" class="button_account"  onclick="WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;" title="{l s='Show products' mod='novblockwishlist'}">{l s='Show products' mod='novblockwishlist'}</a>
			</li>
			{if count($productsBoughts)}
			<li>
				<a href="#" id="hideBoughtProductsInfos" class="button_account" onclick="WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;" title="{l s="Hide products" mod='novblockwishlist'}">{l s="Hide bought products' info" mod='novblockwishlist'}</a>
				<a href="#" id="showBoughtProductsInfos" class="button_account"  onclick="WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;" title="{l s="Show products" mod='novblockwishlist'}">{l s="Show bought products' info" mod='novblockwishlist'}</a>
			</li>
			{/if}
		</ul>
		<p class="wishlisturl">{l s='Permalink' mod='novblockwishlist'}: <input type="text" value="{$link->getModuleLink('novblockwishlist', 'view', ['token' => $token_wish])|escape:'html':'UTF-8'}" style="width:540px;" readonly="readonly" /></p>
		<p class="submit">
			<div id="showSendWishlist">
				<a href="#" class="button_account exclusive" onclick="WishlistVisibility('wl_send', 'SendWishlist'); return false;" title="{l s='Send this wishlist' mod='novblockwishlist'}">{l s='Send this wishlist' mod='novblockwishlist'}</a>
			</div>
		</p>
	</div>
	{/if}
	<div class="wlp_bought">
		<div class="clearfix row wlp_bought_list">
		{foreach from=$products item=product name=i}
			<div id="wlp_{$product.id_product}_{$product.id_product_attribute}" class="col-md-3 col-sm-4 col-xs-6 address {if $smarty.foreach.i.index % 2}alternate_{/if}item">
				<a href="javascript:;" class="lnkdel" onclick="WishlistProductManage('wlp_bought', 'delete', '{$id_wishlist}', '{$product.id_product}', '{$product.id_product_attribute}', $('#quantity_{$product.id_product}_{$product.id_product_attribute}').val(), $('#priority_{$product.id_product}_{$product.id_product_attribute}').val());" title="{l s='Delete' mod='novblockwishlist'}"><i class="material-icons close">close</i></a>
				<div class="clearfix">
					<div class="product_image">
						<a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html'}" title="{l s='Product detail' mod='novblockwishlist'}">
							<img class="img-fluid" src="{$link->getImageLink($product.link_rewrite, $product.cover, 'medium_default')|escape:'html'}" alt="{$product.name|escape:'html':'UTF-8'}" />
						</a>
					</div>
					<div class="product_infos">
						<div id="s_title" class="product_name"><a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html'}">{$product.name|truncate:30:'...'|escape:'html':'UTF-8'}</a></div>
						<div class="wishlist_product_detail">
							{*
							{if isset($product.attributes_small)}
								<a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html'}" title="{l s='Product detail' mod='novblockwishlist'}">{$product.attributes_small|escape:'html':'UTF-8'}</a>
							{/if}
							*}
							<div class="form-inline">
  								<label class="form-control-label">{l s='Qty' mod='novblockwishlist'}:</label>
								<input type="text" class="form-control quantity" id="quantity_{$product.id_product}_{$product.id_product_attribute}" value="{$product.quantity|intval}"/>
								<label class="form-control-label">{l s='Priority' mod='novblockwishlist'}:</label>
								<select id="priority_{$product.id_product}_{$product.id_product_attribute}" class="priority custom-select">
									<option value="0"{if $product.priority eq 0} selected="selected"{/if}>{l s='High' mod='novblockwishlist'}</option>
									<option value="1"{if $product.priority eq 1} selected="selected"{/if}>{l s='Medium' mod='novblockwishlist'}</option>
									<option value="2"{if $product.priority eq 2} selected="selected"{/if}>{l s='Low' mod='novblockwishlist'}</option>
								</select>
							</div>
							{if $wishlists|count > 1}
								<br>
								{l s='Move'}:
								<br>
                                {foreach name=wl from=$wishlists item=wishlist}
                                    {if $smarty.foreach.wl.first}
                                       <select class="wishlist_change_button custom-select">
                                       <option>---</option>
                                    {/if}
                                    {if $id_wishlist != {$wishlist.id_wishlist}}
	                                        <option title="{$wishlist.name}" value="{$wishlist.id_wishlist}" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" data-quantity="{$product.quantity|intval}" data-priority="{$product.priority}" data-id-old-wishlist="{$id_wishlist}" data-id-new-wishlist="{$wishlist.id_wishlist}">
	                                                {l s='Move to %s'|sprintf:$wishlist.name mod='novblockwishlist'}
	                                        </option>
                                    {/if}
                                    {if $smarty.foreach.wl.last}
                                        </select>
                                        <br>
                                    {/if}
                                {/foreach}
                            {/if}
						</div>
					</div>
				</div>
				<div class="btn_action clearfix text-center">
					<a href="javascript:;" class="btn btn-default exclusive lnksave" onclick="WishlistProductManage('wlp_bought_{$product.id_product_attribute}', 'update', '{$id_wishlist}', '{$product.id_product}', '{$product.id_product_attribute}', $('#quantity_{$product.id_product}_{$product.id_product_attribute}').val(), $('#priority_{$product.id_product}_{$product.id_product_attribute}').val());" title="{l s='Save' mod='novblockwishlist'}">{l s='Save' mod='novblockwishlist'}</a>
				</div>
			</div>
		{/foreach}
		</div>
	</div>
	{if !$refresh}
	<form method="post" class="wl_send std" onsubmit="return (false);" style="display: none;">
		<a id="hideSendWishlist" class="button_account icon"  href="#" onclick="WishlistVisibility('wl_send', 'SendWishlist'); return false;"  title="{l s='Close this wishlist' mod='novblockwishlist'}">
			<i class="material-icons close">close</i>
		</a>
		<fieldset>
			<p class="required">
				<label for="email1">{l s='Email' mod='novblockwishlist'}1 <sup>*</sup></label>
				<input type="text" class="form-control" name="email1" id="email1" />
			</p>
			{section name=i loop=11 start=2}
			<p>
				<label for="email{$smarty.section.i.index}">{l s='Email' mod='novblockwishlist'}{$smarty.section.i.index}</label>
				<input type="text" name="email{$smarty.section.i.index}" class="form-control" id="email{$smarty.section.i.index}" />
			</p>
			{/section}
			<p class="submit">
				<input class="btn btn-default" type="submit" value="{l s='Send' mod='novblockwishlist'}" name="submitWishlist" onclick="WishlistSend('wl_send', '{$id_wishlist}', 'email');" />
			</p>
			<p class="required">
				<sup>*</sup> {l s='Required field' mod='novblockwishlist'}
			</p>
		</fieldset>
	</form>
	{if count($productsBoughts)}
	<table class="wlp_bought_infos hidden std">
		<thead>
			<tr>
				<th class="first_item">{l s='Product' mod='novblockwishlist'}</th>
				<th class="item">{l s='Quantity' mod='novblockwishlist'}</th>
				<th class="item">{l s='Offered by' mod='novblockwishlist'}</th>
				<th class="last_item">{l s='Date' mod='novblockwishlist'}</th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$productsBoughts item=product name=i}
			{foreach from=$product.bought item=bought name=j}
			{if $bought.quantity > 0}
				<tr>
					<td class="first_item">
						<span style="float:left;"><img src="{$link->getImageLink($product.link_rewrite, $product.cover, 'small')|escape:'html'}" alt="{$product.name|escape:'html':'UTF-8'}" /></span>
						<span style="float:left;">
							{$product.name|truncate:40:'...'|escape:'html':'UTF-8'}
						{if isset($product.attributes_small)}
							<br /><i>{$product.attributes_small|escape:'html':'UTF-8'}</i>
						{/if}
						</span>
					</td>
					<td class="item align_center">{$bought.quantity|intval}</td>
					<td class="item align_center">{$bought.firstname} {$bought.lastname}</td>
					<td class="last_item align_center">{$bought.date_add|date_format:"%Y-%m-%d"}</td>
				</tr>
			{/if}
			{/foreach}
		{/foreach}
		</tbody>
	</table>
	{/if}
	{/if}
{else}
	<p class="warning">{l s='No products' mod='novblockwishlist'}</p>
{/if}
