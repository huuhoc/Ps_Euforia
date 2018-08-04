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

{extends file="layouts/`$novconfig.novthemeconfig_cateblog_layout`.tpl"}



{block name='breadcrumb-title'}
    <div class="breadcrumb-title-page">{if $title_category != ''}{$title_category}{else}{l s='Our blog' d='Shop.Theme'}{/if}</div>
{/block}
{block name='breadcrumb-link'}
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{$urls.base_url}">
                <span itemprop="name">{l s='Home' d='Shop.Theme'}</span>
            </a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="http://localhost/prestashop_nova_index2/index.php?id_category=3&amp;controller=category&amp;id_lang=1">
            <span itemprop="name">{if $title_category != ''}{$title_category}{else}{l s='Our blog' d='Shop.Theme'}{/if}</span>
            </a>
            <meta itemprop="position" content="2">
        </li>
    </ol>
{/block}

{block name='content'}
    <div class="blogwapper{if $novconfig.novthemeconfig_cateblog_layout == 'layout-one-column'} one-columns{/if}">
    {capture name=path}
        <a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='All Blog News' mod='smartblog'}</a>
        {if $title_category != ''}
        {*<span class="navigation-pipe">{$navigationPipe}</span>*}{$title_category}{/if}
    {/capture}
    {if $postcategory == ''}
        {if $title_category != ''}
             <p class="error">{l s='No Post in Category' mod='smartblog'}</p>
        {else}
             <p class="error">{l s='No Post in Blog' mod='smartblog'}</p>
        {/if}
    {else}
    	{if $smartdisablecatimg == '1'}
            {assign var="activeimgincat" value='0'}
            {$activeimgincat = $smartshownoimg} 
            {if $title_category != ''}
               {foreach from=$categoryinfo item=category}
                <div id="sdsblogCategory">
                    {if $cat_image != 'no' || $activeimgincat == 0}
                       <img alt="{$category.meta_title}" src="{$modules_dir}/smartblog/images/category/{$cat_image}-home-default.jpg" class="imageFeatured">
                    {/if}
                    {$category.description}
                </div>
                {/foreach}  
            {/if}
        {/if}
        <div id="smartblogcat" class="block {if $novconfig.novthemeconfig_cateblog_layout == 'layout-one-column'}items-center{/if}">
            {foreach from=$postcategory item=post}
                {include 'module:smartblog/views/templates/front/category_loop.tpl' postcategory=$postcategory}
            {/foreach}
        </div>

        {if !empty($pagenums)}
            <div class="post-page row">
                <div class="col-lg-12">
                    <ul class="pagination text-center">
                        {for $k=0 to $pagenums}
                            {if $title_category != ''}
                                {assign var="options" value=null}
                                {$options.page = $k+1}
                                {$options.id_category = $id_category}
                                {$options.slug = $cat_link_rewrite}
                            {else}
                                {assign var="options" value=null}
                                {$options.page = $k+1}
                            {/if}
                            {if ($k+1) == $c}
                                <li><span class="page-active">{$k+1}</span></li>
                            {else}
                                {if $title_category != ''}
                                    <li><a class="page-link" href="{smartblog::GetSmartBlogLink('smartblog_category_pagination',$options)}">{$k+1}</a></li>
                                {else}
                                    <li><a class="page-link" href="{smartblog::GetSmartBlogLink('smartblog_list_pagination',$options)}">{$k+1}</a></li>
                                {/if}
                            {/if}
                       {/for}
                    </ul>
    			</div>
                {*
    			<div class="col-md-6 hidden-xs-up">
                    <div class="results">{l s="Showing" mod="smartblog"} {if $limit_start!=0}{$limit_start}{else}1{/if} {l s="to" mod="smartlatestnews"} {if $limit_start+$limit >= $total}{$total}{else}{$limit_start+$limit}{/if} {l s="of" mod="smartblog"} {$total} ({$c} {l s="Pages" mod="smartblog"})</div>
                </div>
                *}
            </div>
        {/if}
    {/if}

    {if isset($smartcustomcss)}
        <style>
            {$smartcustomcss}
        </style>
    {/if}
    </div>
{/block}