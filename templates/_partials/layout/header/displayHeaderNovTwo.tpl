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
**}
<header id="header" class="headerSecond">

    {block name="header-mobile"}
      <div class="header-mobile hidden-md-up">
        <div class="hidden-md-up text-xs-center mobile d-flex align-items-center justify-content-end">
          {*
          <div id="_mobile_mainmenu" class="item-mobile-top"><i class="material-icons d-inline">menu</i></div>
          *}
          {if isset($novconfig.novthemeconfig_logo_mobile) && $novconfig.novthemeconfig_logo_mobile}
          <div class="mobile_logo ml-auto mr-auto">
            <a href="{$urls.base_url}">
              <img class="logo-mobile img-fluid" src="{$img_dir_themeconfig}{$novconfig.novthemeconfig_logo_mobile}" alt="{$shop.name}">
            </a>
          </div>
          {else}
          <div id="_mobile_logo" class="mobile_logo item-mobile-top ml-auto mr-auto"></div>
          {/if}
          {*
          <div class="item-mobile-top nov-toggle-page d-flex align-items-center" data-target="#mobile-blockcart"><a href="#"><i class="material-icons shopping-cart">shopping_cart</i></a></div>
          *}
          <div id="_mobile_menutop" class="item-mobile-top nov-toggle-page d-flex align-items-center justify-content-center" data-target="#mobile-pagemenu"><i class="material-icons">more_horiz</i></div>
        </div>
        
        <div id="_mobile_search">
          <div id="_mobile_search_content"></div>
        </div>
      </div>
    {/block}

    {block name='header_top'}

    {/block}
    {block name='header_center'}
        <div class="header-center hidden-sm-down">
            <div class="row align-items-center no-gutters">
                {assign var='displayHeaderNovTwo' value={hook h='displayHeaderNovTwo'}}
                {if $displayHeaderNovTwo}
                <div class="header-center--left col-7">
                    {hook h='displayHeaderNovTwo'}
                </div>
                {/if}
                <div class="header-center--right d-flex justify-content-end align-items-center col-5">
                    <div class="novheader-search novheader-search--two">
                        {hook h='displayNovSearch'}
                    </div>
                    <div class="novheader-account novheader-account--two ml-4">
                        {hook h='displayNovMyAccount'}
                    </div>
                    <div class="novheader-cart novheader-cart--two pl-2 ml-2">
                        {hook h='displayNovCart'}
                    </div>
                </div>
            </div>
        </div>
    {/block}
</header>