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
{extends file='page.tpl'}

{block name='page_title'}
	<div class="hidden-xs-up">
  		{$page.title}
  	</div>
{/block}

{block name='header'}{/block}

{block name='breadcrumb'}
{/block}

{block name='page_content_container'}
  	<section id="content" class="page-content page-not-found row align-items-center">
		<div class="content-404 col-lg-6 col-sm-6 text-center">
			<div class="image">
				<img class="img-fluid" src="{$img_dir}image-404.png" alt="Image 404" />
			</div>
			<p class="h4">{l s='We’re sorry — something has gone wrong on our end.' d='Shop.Theme.Errors'}</p>
			<div class="info"><p>{l s='If difficulties persist, please contact the System Administrator 
		of this site and report the error below.' d='Shop.Theme.Errors'}</p></div>
			<a class="btn btn-default" href="{$urls.base_url}"><i class="fa"></i><span>{l s='Back to homepage'}</span></a>
			{*
				{block name='search'}
				{hook h='displaySearch'}
				{/block}
			*}

			{hook h='displayNotFound'}
		</div>
		<div class="content-right-404 col-lg-6 col-sm-6">
			<a href="{$urls.base_url}"><img class="img-fluid" src="{$img_dir}image-02-404.jpg" alt="image 404 right" /></a>
		</div>
	</section>
{/block}

{block name="footer"}{/block}
{block name="stickymenu_bottom_mobile"}{/block}