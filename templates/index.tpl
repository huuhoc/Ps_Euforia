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
{extends file='page.tpl'}

{block name='page_content_container'}
  {block name='page_content_top'}{/block}
    {block name='page_content'}
      {if isset($novconfig.novthemeconfig_home_style) && $novconfig.novthemeconfig_home_style == "displayHomeNovOne"}
        <section id="content" class="page-home pagehome-one">
          {hook h='displayHomeNovOne'}
        </section>
      {elseif isset($novconfig.novthemeconfig_home_style) && $novconfig.novthemeconfig_home_style == "displayHomeNovTwo"}
        <section id="content" class="page-home pagehome-two">
          {hook h='displayHomeNovTwo'}
        </section>
      {elseif isset($novconfig.novthemeconfig_home_style) && $novconfig.novthemeconfig_home_style == "displayHomeNovThree"}
        <section id="content" class="page-home pagehome-three">
                {hook h='displayHomeNovThree'}
        </section>
      {elseif isset($novconfig.novthemeconfig_home_style) && $novconfig.novthemeconfig_home_style == "displayHomeNovFour"}
        <section id="content" class="page-home pagehome-four">
                {hook h='displayHomeNovFour'}
        </section>
      {elseif isset($novconfig.novthemeconfig_home_style) && $novconfig.novthemeconfig_home_style == "displayHomeNovFive"}
        <section id="content" class="page-home pagehome-five">
                {hook h='displayHomeNovFive'}
        </section>
      {else}
        <section id="content" class="page-home pagehome-one">
          {hook h='displayHomeNovOne'}
        </section>
      {/if}
    {/block}
  
{/block}
{block name='page_footer_container'}{/block}