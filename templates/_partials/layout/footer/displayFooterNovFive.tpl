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
<footer id="footer" class="footer footer-five">

  <div id="nov-copyright">
    <div class="copyright-inner">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-3 mb-xs-15">
          {if isset($novconfig.novthemeconfig_payment_image) && $novconfig.novthemeconfig_payment_image }
            <img class="img-fluid" src="{$img_dir_themeconfig}{$novconfig.novthemeconfig_payment_image nofilter}" alt="payment" title="Payment" />
          {else}
            <img class="img-fluid" src="{$img_dir}/payment.png" alt="payment" title="Payment" />
          {/if}
        </div>
        <div class="col-lg-9 col-md-9 text-md-right text-sm-center">
          {assign var='displayFooterNovFive' value={hook h='displayFooterNovFive'}}
          {if $displayFooterNovFive}
            {hook h='displayFooterNovFive'}
          {/if}
        </div>
      </div>
    </div>
  </div>

</footer>