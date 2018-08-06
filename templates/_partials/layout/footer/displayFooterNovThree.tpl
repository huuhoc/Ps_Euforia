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
<footer id="footer" class="footer footer-three">
    <div class="footer-inner">

      <div class="nov-footer-top">
        {hook h='displayFooterNovThree'}
      </div>

      <div id="nov-copyright" class="text-center">
          {if isset($novconfig.novthemeconfig_copyright) && $novconfig.novthemeconfig_copyright }
            <div class="content-copyright">
              {$novconfig.novthemeconfig_copyright}
            </div>
            {else}
            <div class="content-copyright">
              {l s='Copyright %copyright% %year% - Vinovathemes. All rights reserved.' sprintf=['%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Copyright'}
            </div>
          {/if}
      </div>

    </div>
</footer>