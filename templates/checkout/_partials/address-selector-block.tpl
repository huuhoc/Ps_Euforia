{**
 * 2007-2017 PrestaShop
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
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{block name='address_selector_blocks'}
{foreach $addresses as $address}
  <article
    class="col address-item{if $address.id == $selected} selected{/if}"
    id="{$name|classname}-address-{$address.id}"
  >
    <header class="h4">
      <label class="radio-block">
        <span class="custom-radio">
          <input
            type="radio"
            name="{$name}"
            value="{$address.id}"
            {if $address.id == $selected}checked{/if}
          >
          <span></span>
        </span>
        <span class="address-alias">{$address.alias}</span>
      </label>
      <div class="address">
        {if isset($address.firstname) && $address.firstname }
          <div class="address-line">{l s='First name' d='Shop.Theme.Actions'}: {$address.firstname}</div>
        {/if}
        {if isset($address.lastname) && $address.lastname }
          <div class="address-line">{l s='Last name' d='Shop.Theme.Actions'}: {$address.lastname}</div>
        {/if}
        {if isset($address.company) && $address.company }
          <div class="address-line">{l s='Company' d='Shop.Theme.Actions'}: {$address.company}</div>
        {/if}
        {if isset($address.address1) && $address.address1 }
          <div class="address-line">{l s='Address' d='Shop.Theme.Actions'}: {$address.address1}</div>
        {/if}
        {if isset($address.address2) && $address.address2 }
          <div class="address-line">{l s='Address Complement' d='Shop.Theme.Actions'}: {$address.address2}</div>
        {/if}
        {if isset($address.city) && $address.city }
          <div class="address-line">{l s='City' d='Shop.Theme.Actions'}: {$address.city}</div>
        {/if}
        {if isset($address.state) && $address.state }
          <div class="address-line">{l s='State' d='Shop.Theme.Actions'}: {$address.state}</div>
        {/if}
        {if isset($address.postcode) && $address.postcode }
          <div class="address-line">{l s='Zip/Postal Code' d='Shop.Theme.Actions'}: {$address.postcode}</div>
        {/if}
        {if isset($address.country) && $address.country }
          <div class="address-line">{l s='Country' d='Shop.Theme.Actions'}: {$address.country}</div>
        {/if}
        {if isset($address.phone) && $address.phone }
          <div class="address-line">{l s='Phone' d='Shop.Theme.Actions'}: {$address.phone}</div>
        {/if}
        </div>
    </header>
    <footer class="address-footer">
      {if $interactive}
        <a
          class="edit-address text-muted"
          data-link-action="edit-address"
          href="{url entity='order' params=['id_address' => $address.id, 'editAddress' => $type, 'token' => $token]}"
        >
          <i class="material-icons edit">&#xE254;</i><span>{l s='Edit' d='Shop.Theme.Actions'}</span>
        </a>
        <a
          class="delete-address text-muted"
          data-link-action="delete-address"
          href="{url entity='order' params=['id_address' => $address.id, 'deleteAddress' => true, 'token' => $token]}"
        >
          <i class="material-icons delete">&#xE872;</i><span>{l s='Delete' d='Shop.Theme.Actions'}</span>
        </a>
      {/if}
    </footer>
  </article>
{/foreach}
{if $interactive}
  <p>
    <button class="ps-hidden-by-js form-control-submit center-block" type="submit">{l s='Save' d='Shop.Theme.Actions'}</button>
  </p>
{/if}
{/block}
