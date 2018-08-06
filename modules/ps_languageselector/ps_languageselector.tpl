{*
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="_desktop_language_selector">
    <div class="language-selector-wrapper">
        <span class="hidden-xs-up">{l s='Language:' d='Shop.Theme'}</span>
        <div class="language-selector js-dropdown{if $novconfig.novthemeconfig_footer_style == 'displayFooterNovTwo'} dropup{else} dropdown{/if}">
            <div class="expand-more" data-toggle="dropdown">
                <span>{$current_language.name_simple}</span>
                <img class="img-fluid" src="{$img_lang}{$current_language.id_lang}.jpg" alt="{$current_language.name_simple}" />
            </div>
            <ul class="dropdown-menu">
                {foreach from=$languages item=language}
                    <li {if $language.id_lang == $current_language.id_lang} class="current" {/if}>
                        <a href="{url entity='language' id=$language.id_lang}">
                            <img class="img-fluid" src="{$img_lang}{$language.id_lang}.jpg" alt="{$language.name_simple}" />
                            <span>{$language.name_simple}</span>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>