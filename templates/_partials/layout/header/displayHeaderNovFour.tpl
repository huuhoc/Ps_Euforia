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
<header id="header" class="headerFour">

  {block name="header-mobile"}
      <div class="header-mobile hidden-md-up">
        <div class="hidden-md-up text-xs-center mobile d-flex align-items-center justify-content-end">
          {*
          <div id="_mobile_mainmenu" class="item-mobile-top"><i class="material-icons d-inline">menu</i></div>
          *}
          {if isset($novconfig.novthemeconfig_logo_mobile) && $novconfig.novthemeconfig_logo_mobile}
          <div class="mobile_logo ml-auto mr-auto">
            <a href="{$urls.base_url}">
              <img class="logo-mobile img-fluid" src="{$img_dir_themeconfig}{$novconfig.novthemeconfig_logo_mobile nofilter}" alt="{$shop.name}">
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
      <div class="header-top hidden-sm-down">
          <div class="container">
              <div class="row align-items-center">
                  <div class="header-top--left col-6">
                      <div class="social">
                        <ul class="list-inline mb-0">
                            {if isset($novconfig.social_facebook) && $novconfig.social_facebook}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_facebook}"><i class="zmdi zmdi-facebook"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_twitter) && $novconfig.social_twitter}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_twitter}"><i class="zmdi zmdi-twitter"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_google) && $novconfig.social_google}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_google}"><i class="zmdi zmdi-google-old"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_instagram) && $novconfig.social_instagram}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_instagram}"><i class="zmdi zmdi-instagram"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_dribbble) && $novconfig.social_dribbble}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_dribbble}"><i class="zmdi zmdi-dribbble"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_flickr) && $novconfig.social_flickr}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_flickr}"><i class="zmdi zmdi-flickr"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_pinterest) && $novconfig.social_pinterest}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_pinterest}"><i class="zmdi zmdi-pinterest"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_linkedIn) && $novconfig.social_linkedIn}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_linkedIn}"><i class="zmdi zmdi-linkedin"></i></a></li>
                            {/if}
                            {if isset($novconfig.social_skype) && $novconfig.social_skype}
                            <li class="list-inline-item mb-0"><a href="{$novconfig.social_skype}"><i class="zmdi zmdi-skype"></i></a></li>
                            {/if}
                          </ul>
                      </div>
                  </div>
                  <div class="header-top--right col-6 d-flex justify-content-end">
                      <div class="novheader-account novheader-account--one">
                          {hook h='displayNovMyAccount'}
                      </div>
                      <div class="novheader-currency novheader-currency--one">
                          {hook h='displayNovCurrency'}
                      </div>
                      <div class="novheader-language novheader-language--one">
                          {hook h='displayNovLanguage'}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  {/block}

  <div class="header-center hidden-sm-down">
    <div class="container">
       <div class="row align-items-center">
        <div class="search col-lg-4 col-md-4 d-flex justify-content-start">
          {hook h='displaySearch'}
        </div>
        <div id="_desktop_logo" class="col-lg-4 col-md-4 d-flex justify-content-center">
          {if isset($novconfig.novthemeconfig_customlogo) && $novconfig.novthemeconfig_customlogo && isset($novconfig.novthemeconfig_customlogo_enable) && $novconfig.novthemeconfig_customlogo_enable == 1}
            <a href="{$urls.base_url}">
              <img class="logo img-fluid" src="{$img_dir_themeconfig}logos/{$novconfig.novthemeconfig_customlogo}.png" alt="{$shop.name}">
            </a>
          {else}
            <a href="{$urls.base_url}">
              <img class="logo img-fluid" src="{$shop.logo}" alt="{$shop.name}">
            </a>
          {/if}
        </div>
        
        <div class="col-lg-4 col-md-4 d-flex justify-content-end">
            <div class="novheader-cart novheader-cart--two">
                {hook h='displayNovCart'}
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom hidden-sm-down">
    <div class="container">
    {block name='header_menu'}
      <div id="_desktop_top_menu" class="d-flex justify-content-center">
          {hook h="displayMegamenu" menu_type="horizontal"}
      </div>
    {/block}
    </div>
  </div>
  
</header>