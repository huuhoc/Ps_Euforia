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

{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              {hook h='displayNav'}
            </div>
            
        </div>
    </div>
  </nav>
{/block}
<div class="header-mobile">
  <div class="hidden-md-up text-xs-center mobile d-flex align-items-center justify-content-center">
    <div id="mainmenu-icon"><i class="material-icons d-inline">menu</i></div>
    <div id="_mobile_logo" class="m-auto text-center"></div>
    <div id="_mobile_user_info"></div>
    <div id="_mobile_cart"></div>
  </div>
</div>

{block name='header_top'}
  <div class="header-top hidden-sm-down">
    <div class="container">
       <div class="row d-flex align-items-center">
        <div class="nov-menu col-lg-5 col-md-5 col-sm-3 col-xs-3">
            <div class="d-flex align-items-center">
              <div class="toggle-nav"><span class="btnov-lines"></span></div>
              <div class="hidden-sm-down">
              {hook h='displayNav1'}
              </div>
            </div>
        </div>
        <div id="_desktop_logo" class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
          <a href="{$urls.base_url}">
            <img class="logo img-fluid" src="{$shop.logo}" alt="{$shop.name}">
          </a>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-3">
          <div class="top-content d-flex align-items-end justify-content-end">
           {hook h='displayNav2'}
           {hook h='displayCart'}
          </div>
        </div>
      </div>
	  	
    </div>
  </div>
  
{/block}

{block name='header_menu'}
<div id="_desktop_top_menu">
    {hook h="displayMegamenu"}
</div>
{/block}
