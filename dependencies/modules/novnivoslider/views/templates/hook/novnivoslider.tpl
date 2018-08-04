{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- Module Novnivoslide -->
{if isset($novnivoslider_slides)}
    <div id="nov-slider" class="slider-wrapper theme-default" 
    	 data-effect="{$novnivoslider.novnivoslider_effect nofilter}"
    	 data-slices="{$novnivoslider.novnivoslider_slices|intval}"
    	 data-animSpeed="{$novnivoslider.novnivoslider_animspeed|intval}"
    	 data-pauseTime="{$novnivoslider.novnivoslider_pausetime|intval}"
    	 data-startSlide="{if isset($novnivoslider.novnivoslider_startslide) && $novnivoslider.novnivoslider_startslide}{$novnivoslider.novnivoslider_startslide|intval}{else}1{/if}"
    	 data-directionnav="{if isset($novnivoslider.novnivoslider_directionnav) && $novnivoslider.novnivoslider_directionnav == 1}true{else}false{/if}"
    	 data-controlNav="{if isset($novnivoslider.novnivoslider_ctrnav) && $novnivoslider.novnivoslider_ctrnav == 1}true{else}false{/if}"
    	 data-controlNavThumbs="{if isset($novnivoslider.novnivoslider_ctrnavthumbs) && $novnivoslider.novnivoslider_ctrnavthumbs}{$novnivoslider.novnivoslider_ctrnavthumbs nofilter}{else}false{/if}"
    	 data-pauseOnHover="{if isset($novnivoslider.novnivoslider_pauseonhover) && $novnivoslider.novnivoslider_pauseonhover == 1}true{else}false{/if}"
    	 data-manualAdvance="{if isset($novnivoslider.novnivoslider_manualadvance) && $novnivoslider.novnivoslider_manualadvance == 1}true{else}false{/if}"
    	 data-randomStart="{if isset($novnivoslider.novnivoslider_randomstart) && $novnivoslider.novnivoslider_randomstart == 1}true{else}false{/if}"
   	>
		<div class="nov_preload">
			<div class="process-loading active">
	            <div class="loader">
	                <div class="dot"></div>
	                <div class="dot"></div>
	                <div class="dot"></div>
	                <div class="dot"></div>
	                <div class="dot"></div>
	            </div>
	        </div>
		</div>
		<div id="nivoSlider" class="nivoSlider">
		{foreach from=$novnivoslider_slides item=slide name=slide}
			<a href="{$slide.url|escape:'html':'UTF-8'}">
				<img src="{$link->getMediaLink("`$smarty.const._MODULE_DIR_`novnivoslider/images/`$slide.image|escape:'htmlall':'UTF-8'`")}" alt="" title="#htmlcaption_{$slide.id_slide}" />
			</a>
		{/foreach} 
		</div>	
		{foreach from=$novnivoslider_slides item=slide name=slide}
			<div id="htmlcaption_{$slide.id_slide}" class="nivo-html-caption">
				<div class="nov-slider-ct">
					<div class="nov-center {$slide.align}">
						{if isset($slide.title) && trim($slide.title) != ''}
							<div class="nov-title {$slide.effect_title}" >
								{$slide.title nofilter}
							</div>
							{/if}
							{if isset($slide.description) && trim($slide.description) != ''}
							<div class="nov-description {$slide.effect_description}" >
								{$slide.description nofilter}
							</div>
							{/if}
							{if isset($slide.html) && trim($slide.html) != ''}
							<div class="nov-html {$slide.effect_html}">
								{$slide.html nofilter}
							</div>
						{/if}
					</div>
				</div>
			</div>
		{/foreach} 	
    </div>
{/if}
<!-- Module Novnivoslide -->