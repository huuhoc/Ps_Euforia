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

{if isset($image1)}
<div class="nov-image col-lg-{$columns} col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
 <div class="block">
  <div class="block_content">
		<div class="effect">
			<a href="{$link_image}"> <img class="img-fluid" src="{$novpagemanage_img}{$image1}" alt="{$title}" title="{$title}"></a>
		</div>
  </div>
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <div class="title_block">
    {$title}
    {if isset($subtitle) && !empty($subtitle)}
    <span class="sub_title">{$subtitle}</span>
    {/if}
   </div>
  {/if}
 </div>
</div>
{/if}