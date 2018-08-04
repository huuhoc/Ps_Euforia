{*/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package    novpagemanage
 * @version    1.0
 * @author    http://vinovathemes.com/
 * @copyright  Copyright (C) May 2017 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/
*}
<div class="nov-instafeed{if isset($class) && $class} {$class}{/if} col-lg-{$columns} col-md-{$columns} col-xs-12">
 <div class="block">
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <div class="title_block">
      {$title  nofilter}
      {if isset($sub_title) && !empty($sub_title)}
        <span class="sub_title">{$sub_title nofilter}</span>
      {/if}
    </div>
  {/if}
  <div class="block_content">
  	{if isset($list_style) && $list_style == 'slider'}
   		<div id="instafeed" class="boxInstagram owl-theme" data-limit="{$limit}" data-userid="{$userId}" data-accesstoken="{$accessToken}" data-autoplay="false" data-autoplayTimeout="6000" data-loop="true" data-margin="{$spacing}" data-dots="false" data-nav="false" data-items="{$number_items}" data-items_mobile="3"></div>
   	{else}
   		<div id="instafeed" class="boxInstagram-grid row" data-limit="{$limit}" data-userid="{$userId}" data-accesstoken="{$accessToken}" data-items="4" data-items_mobile="3"></div>
    {/if}
  </div>
 </div>
</div>