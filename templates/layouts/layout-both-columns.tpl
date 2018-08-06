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
<!doctype html>
<html lang="{$language.iso_code}">

  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>

  <body id="{$page.page_name}" class="{$page.body_classes|classnames}
  {if isset($novconfig.novthemeconfig_home_style) } {$novconfig.novthemeconfig_home_style|lower}{/if}{if isset($novconfig.novthemeconfig_mode_layout) && $novconfig.novthemeconfig_mode_layout == 'boxed'} layout-boxed{/if}">

    {block name='hook_after_body_opening_tag'}
      {hook h='displayAfterBodyOpeningTag'}
    {/block}

    <main id="main-site">
    {block name='product_activation'}
      {include file='catalog/_partials/product-activation.tpl'}
    {/block}
    
    {block name='header'}
      {if $novconfig.novthemeconfig_header_style && $novconfig.novthemeconfig_header_style == 'displayHeaderNovOne'}
        {include file="_partials/layout/header/displayHeaderNovOne.tpl"}
      {elseif $novconfig.novthemeconfig_header_style && $novconfig.novthemeconfig_header_style == 'displayHeaderNovTwo'}
        {include file="_partials/layout/header/displayHeaderNovTwo.tpl"}
      {elseif $novconfig.novthemeconfig_header_style && $novconfig.novthemeconfig_header_style == 'displayHeaderNovThree'}
        {include file="_partials/layout/header/displayHeaderNovThree.tpl"}
      {elseif $novconfig.novthemeconfig_header_style && $novconfig.novthemeconfig_header_style == 'displayHeaderNovFour'}
        {include file="_partials/layout/header/displayHeaderNovFour.tpl"}
      {elseif $novconfig.novthemeconfig_header_style && $novconfig.novthemeconfig_header_style == 'displayHeaderNovFive'}
        {include file="_partials/layout/header/displayHeaderNovFive.tpl"}
      {else}
        {include file="_partials/layout/header/displayHeaderNovOne.tpl"}
      {/if}
    {/block}

      {block name='notifications'}
        {include file='_partials/notifications.tpl'}
      {/block}
      {if $page.page_name == 'index' && isset($novconfig.novthemeconfig_home_style)}
          {assign var='hook_top' value=$novconfig.novthemeconfig_home_style|replace:'displayHomeNov':'displayTop'}
          {assign var='hook_slider' value=$novconfig.novthemeconfig_home_style|replace:'displayHomeNov':'displayHomeSlider'}
            {if $novconfig.novthemeconfig_home_style == "displayHomeNovTwo" || $novconfig.novthemeconfig_home_style == "displayHomeNovOne"}
                <div id="slidershow">
                    {hook h=$hook_slider}
                </div>
            {/if}

            {assign var='displayTop' value={hook h=$hook_top}}
            {if $displayTop}
              {if $hook_top == 'displayTopTwo'}
                  <div id="displayTop" class="{$hook_top}">
                      {hook h=$hook_top}
                  </div>
              {elseif $hook_top == 'displayTopThree'}
                  <div id="displayTop" class="{$hook_top|lower}">
                      {hook h=$hook_top}
                  </div>
              {else}
                  <div id="displayTop" class="{$hook_top|lower}">
                      <div class="row">
                          {hook h=$hook_top}
                      </div>
                  </div>
              {/if}
            {/if}
        {/if}
        <div id="wrapper-site">
            {if $page.page_name != 'index'}
                {block name='breadcrumb'}
                    {include file='_partials/breadcrumb.tpl'}
                {/block}
            {/if}
            {block name="left_column"}
            <div class="container">
              <div class="row">
                <div id="left-column" class="sidebar col-xs-12 col-sm-4 col-md-3">
                  {if $page.page_name == 'product'}
                    {hook h='displayLeftProductNov'}
                  {elseif (strpos($page.page_name, 'smartblog') !== false)}
                    {hook h="displaySidebarBlogNov"}
                  {else}
                    {hook h='displayLeftColumnNov'}
                  {/if}
                </div>
            {/block}

              {block name="content_wrapper"}
                <div id="content-wrapper" class="left-column right-column col-sm-4 col-md-6 flex-xs-first">
                  {block name="content"}
                    <p>Hello world! This is HTML5 Boilerplate.</p>
                  {/block}
                </div>
              {/block}

            {block name="right_column"}
                <div id="right-column" class="sidebar col-xs-12 col-sm-4 col-md-3">
                  {if $page.page_name == 'product'}
                    {hook h='displayRightProductNov'}
                  {elseif (strpos($page.page_name, 'smartblog') !== false)}
                    {hook h="displaySidebarBlogNov"}
                  {else}
                    {hook h='displayRightColumnNov'}
                  {/if}
                </div>
              </div>
            </div>
            {/block}  
      </div>
      {if $novconfig.novthemeconfig_footer_style == 'displayFooterNovOne'}
        {include file="_partials/layout/footer/displayFooterNovOne.tpl"}
      {elseif $novconfig.novthemeconfig_footer_style == 'displayFooterNovTwo'}
        {include file="_partials/layout/footer/displayFooterNovTwo.tpl"}
      {elseif $novconfig.novthemeconfig_footer_style == 'displayFooterNovThree'}
        {include file="_partials/layout/footer/displayFooterNovThree.tpl"}
      {elseif $novconfig.novthemeconfig_footer_style == 'displayFooterNovFour'}
        {include file="_partials/layout/footer/displayFooterNovFour.tpl"}
      {elseif $novconfig.novthemeconfig_footer_style == 'displayFooterNovFive'}
        {include file="_partials/layout/footer/displayFooterNovFive.tpl"}
      {else}
        {include file="_partials/layout/footer/displayFooterNovOne.tpl"}
      {/if}
      <div id="back-top">
        <span>
          <i class="fa fa-long-arrow-up"></i>{* {l s='Back to top' d='Shop.Theme.Layout'}*}
        </span>
      </div>
      
    </main>

    {block name="mainmenu_mobile"}
      <div id="mobile_top_menu_wrapper" class="hidden-md-up">
        <div class="content">
          <div id="_mobile_verticalmenu"></div>
        </div>
      </div>
    {/block}

    <div id="mobile-pagemenu" class="mobile-boxpage d-flex hidden-md-up">
        <div class="content-boxpage col">
          <div class="box-header d-flex justify-content-between align-items-center">
              <div class="title-box">{l s="Menu"}</div>
              <div class="close-box">{l s="Close"}{*<i class="zmdi zmdi-close"></i>*}</div>
          </div>
          <div class="box-content">
            <div id="_mobile_top_menu" class="js-top-menu"></div>
            {if $novconfig.novthemeconfig_home_style && $novconfig.novthemeconfig_home_style == 'displayhomenovtwo'}
              {if isset($novconfig.social_in_footer) && $novconfig.social_in_footer == 1}
                  <div class="social text-center mt-30 mb-10">
                    <ul class="list-inline mb-0 justify-content-end">
                        {if isset($novconfig.social_facebook) && $novconfig.social_facebook}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_facebook}"><i class="fa fa-facebook"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_twitter) && $novconfig.social_twitter}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_twitter}"><i class="fa fa-twitter"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_google) && $novconfig.social_google}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_google}"><i class="fa fa-google"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_instagram) && $novconfig.social_instagram}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_instagram}"><i class="fa fa-instagram"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_dribbble) && $novconfig.social_dribbble}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_dribbble}"><i class="fa fa-dribbble"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_flickr) && $novconfig.social_flickr}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_flickr}"><i class="fa fa-flickr"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_pinterest) && $novconfig.social_pinterest}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_pinterest}"><i class="fa fa-pinterest"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_linkedIn) && $novconfig.social_linkedIn}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_linkedIn}"><i class="fa fa-linkedin"></i></a></li>
                        {/if}
                        {if isset($novconfig.social_skype) && $novconfig.social_skype}
                        <li class="list-inline-item mb-0"><a href="{$novconfig.social_skype}"><i class="fa fa-skype"></i></a></li>
                        {/if}
                    </ul>
                  </div>
              {/if}
              <div class="copyright w-100 text-center mb-10">
                {if isset($novconfig.novthemeconfig_copyright) && $novconfig.novthemeconfig_copyright }
                <span>
                  {$novconfig.novthemeconfig_copyright}
                </span>
                {else}
                <span>
                  {l s='Copyright %copyright% %year% Vinovathemes. All rights reserved.' sprintf=['%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Layout'}
                </span>
                {/if}
              </div>
            {/if}
          </div>
        </div>
    </div>
    <div id="mobile-blockcart" class="mobile-boxpage d-flex hidden-md-up">
        <div class="content-boxpage col">
          <div class="box-header d-flex justify-content-between align-items-center">
              <div class="title-box">{l s="Cart"}</div>
              <div class="close-box">{l s="Close"}</div>
          </div>
          <div id="_mobile_cart" class="box-content"></div>
        </div>
    </div>
    <div id="mobile-pageaccount" class="mobile-boxpage d-flex hidden-md-up" data-titlebox-parent="{l s='Account'}">
        <div class="content-boxpage col">
          <div class="box-header d-flex justify-content-between align-items-center">
              <div class="back-box">{l s="Back"}</div>
              <div class="title-box">{l s='Account'}</div>
              <div class="close-box">{l s="Close"}</div>
          </div>
          <div class="box-content d-flex justify-content-center align-items-center text-center">
            <div>
                <div id="_mobile_account_list"></div>
                <div class="links-currency" data-target="#box-currency" data-titlebox="{l s='Currency'}"><span>{l s='Currency'}</span><i class="zmdi zmdi-arrow-right"></i></div>
                <div class="links-language" data-target="#box-language" data-titlebox="{l s='Language'}"><span>{l s='Language'}</span><i class="zmdi zmdi-arrow-right"></i></div>
            </div>
          </div>
          <div id="box-currency" class="box-content d-flex">
            <div class="w-100">
            {foreach from=$nov_currency.currencies item=currency}
              <div class="item-currency{if $currency.current} current{/if}">
                <a title="{$currency.name}" rel="nofollow" href="{$currency.url}">{$currency.name}: {$currency.iso_code}</a>
              </div>
            {/foreach}
            </div>
          </div>

          <div id="box-language" class="box-content d-flex">
            <div class="w-100">
            {foreach from=$nov_languages.languages item=language}
              <div class="item-language{if $language.id_lang == $nov_languages.current_language.id_lang} current{/if}">
                <a href="{url entity='language' id=$language.id_lang}" class="d-flex align-items-center"><img class="img-fluid mr-2" src="{$img_lang}{$language.id_lang}.jpg" alt="{$language.name}" width="16" height="11" /><span>{$language.name_simple}</span></a>
              </div>
            {/foreach}
            </div>
          </div>

        </div>
    </div>

    {block name="stickymenu_bottom_mobile"}
      <div id="stickymenu_bottom_mobile" class="d-flex align-items-center justify-content-center hidden-md-up text-center">
        <div class="stickymenu-item"><a href="{$urls.base_url}"><i class="zmdi zmdi-home"></i><span>{l s='Home' d='Shop.Theme.Mobile'}</span></a></div>
        <div class="stickymenu-item"><a href="#" class="js-btn-search"><i class="zmdi zmdi-search"></i><span>{l s='Search' d='Shop.Theme.Mobile'}</span></a></div>
        <div class="stickymenu-item"><div id="_mobile_cart_bottom" class="nov-toggle-page" data-target="#mobile-blockcart"></div></div>
        <div class="stickymenu-item"><a href="{$link->getModuleLink('novblockwishlist', 'mywishlist', array(), true)|escape:'html':'UTF-8'}"><i class="zmdi zmdi-favorite"></i><span>{l s='Wishlist' d='Shop.Theme.Mobile'}</span></a></div>
        <div class="stickymenu-item"><a href="#" class="nov-toggle-page" data-target="#mobile-pageaccount"><i class="zmdi zmdi-account-o"></i><span>{l s='Account' d='Shop.Theme.Mobile'}</span></a></div>
      </div>
    {/block}

    
    {if $novconfig.novthemeconfig_home_style && $novconfig.novthemeconfig_home_style == 'displayHomeNovTwo'}
      <div class="canvas-menu display-fixed d-flex align-items-end flex-column">
        <div id="_desktop_logo" class="w-100 text-center mt-30">
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
        <div id="_desktop_top_menu" class="mb-auto w-100 mt-55">
            {hook h="displayMegamenu" menu_type="vertical"}
        </div>
        <div class="copyright w-100 text-center">
          {if isset($novconfig.novthemeconfig_copyright) && $novconfig.novthemeconfig_copyright }
          <span>
            {$novconfig.novthemeconfig_copyright}
          </span>
          {else}
          <span>
            {l s='Copyright %copyright% %year% Vinovathemes. All rights reserved.' sprintf=['%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Layout'}
          </span>
          {/if}
        </div>
        {if isset($novconfig.social_in_footer) && $novconfig.social_in_footer == 1}
        <div class="social_block w-100 text-center">
            <div class="social">
              <ul class="list-inline mb-0 justify-content-end">
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
        {/if}
      </div>
    {/if}

    {if isset($novconfig.social_twitter) && $novconfig.social_twitter}
        {literal}
        <script>window.twttr = (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
          if (d.getElementById(id)) return t;
          js = d.createElement(s);
          js.id = id;
          js.src = "https://platform.twitter.com/widgets.js";
          fjs.parentNode.insertBefore(js, fjs);

          t._e = [];
          t.ready = function(f) {
            t._e.push(f);
          };

          return t;
        }(document, "script", "twitter-wjs"));</script>
        
        {/literal}
    {/if}

    {block name='javascript_bottom'}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {block name='hook_before_body_closing_tag'}
      {hook h='displayBeforeBodyClosingTag'}
    {/block}

    {if isset($novconfig.contact_fanpage) && $novconfig.contact_fanpage}
        <div id="fb-root"></div>
        {literal}
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.10";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        {/literal}
    {/if}


  </body>

</html>