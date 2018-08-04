{**
 * 2007-2016 PrestaShop
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
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<footer id="footer" class="footer footer-four">
  <div class="nov-footer-center container-1600">
    <div class="container">
      <div class="row">
      {hook h='displayFooterNovFour'}
      </div>
    </div>
  </div>

  <div id="nov-copyright" class="container-1600">
    <div class="container">
      <div class="inner-copyright">
        <div class="row align-items-center">
            {if isset($novconfig.novthemeconfig_copyright) && $novconfig.novthemeconfig_copyright }
              <div class="content-copyright col-lg-6 text-md-left text-sm-center">
                {$novconfig.novthemeconfig_copyright nofilter}
                {hook h='displayCopyright'}
              </div>
              {else}
              <div class="content-copyright col-lg-6 text-md-left text-sm-center">
                {l s='Copyright %copyright% %year% - Vinovathemes. All rights reserved.' sprintf=['%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Copyright'}
                {hook h='displayCopyright'}
              </div>
            {/if}
            <div class="payment text-center col-lg-6 text-md-right text-sm-center mt-xs-15">
              {if isset($novconfig.novthemeconfig_payment_image) && $novconfig.novthemeconfig_payment_image }
              <img class="img-fluid" src="{$img_dir_themeconfig}{$novconfig.novthemeconfig_payment_image nofilter}" alt="payment" title="Payment" />
              {else}
                <img class="img-fluid" src="{$img_dir}/payment.png" alt="payment" title="Payment" />
              {/if}
            </div>
        </div>
      </div>
    </div>
  </div>

</footer>

<div class="canvas-overlay"></div>