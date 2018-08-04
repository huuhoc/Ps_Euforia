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
<footer id="footer" class="footer footer-two">

  <div id="nov-copyright">
    <div class="copyright-inner">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-3">
          {if isset($novconfig.novthemeconfig_payment_image) && $novconfig.novthemeconfig_payment_image }
            <img class="img-fluid" src="{$img_dir_themeconfig}{$novconfig.novthemeconfig_payment_image nofilter}" alt="payment" title="Payment" />
          {else}
            <img class="img-fluid" src="{$img_dir}/payment.png" alt="payment" title="Payment" />
          {/if}
        </div>
        <div class="col-lg-6 col-md-6 text-center mt-xs-15">
          {assign var='displayFooterNovTwo' value={hook h='displayFooterNovTwo'}}
          {if $displayFooterNovTwo}
            {hook h='displayFooterNovTwo'}
          {/if}
        </div>
        <div class="col-lg-3 col-md-3 d-flex justify-content-center justify-content-md-end mt-xs-15">
          {assign var='displayNovLanguage' value={hook h='displayNovLanguage'}}
          {if $displayNovLanguage}
          <div class="novfooter-language novfooter-language--one dropdown js-dropdown dropup mr-4 pr-5">
              {hook h='displayNovLanguage'}
          </div>
          {/if}
          {assign var='displayNovCurrency' value={hook h='displayNovCurrency'}}
          {if $displayNovCurrency}
          <div class="novfooter-currency novfooter-currency--one dropdown js-dropdown dropup pr-5">
              {hook h="displayNovCurrency"}
          </div>
          {/if}
        </div>
      </div>
    </div>
  </div>

</footer>