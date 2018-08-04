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

{block name='page_header_container'}{/block}


{block name='left_column'}
  {*
  <div id="left-column" class="col-xs-12 col-sm-3">
    {widget name="ps_contactinfo" hook='displayLeftColumn'}
  </div>
  *}
{/block}

{block name='breadcrumb-title'}
	<div class="breadcrumb-title-page">{l s='Contact us' d='Shop.Theme'}</div>
{/block}
{block name='breadcrumb-link'}{/block}

{block name='page_content'}
	<div class="infomation-store">
		{widget name="ps_contactinfo" hook='displayLeftColumn'}
	</div>
	<div class="google-map">
		<div id="nov-map-contact"></div>
		<div class="map-locker"></div>		
	</div>
	{if isset($novconfig.contact_desc) && $novconfig.contact_desc}
	<div class="desc-store text-center">
		{$novconfig.contact_desc nofilter}
	</div>
	{/if}
	<div class="text-center"><i class="icon-comment"></i></div>
	<div class="row justify-content-md-center">
		<div class="col-lg-6 co-md-6 col-sm-12 col-xs-12">
  			{widget name="contactform"}
		</div>
	</div>
{/block}

{block name='javascript_bottom'}
  {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
  <script>
  	var store_latitude = {$novconfig.store_latitude};
  	var store_longitude = {$novconfig.store_longitude};
  {literal}
	function initMap() {
	var uluru = {lat: store_latitude, lng: store_longitude};
	var map = new google.maps.Map(document.getElementById('nov-map-contact'), {
	  zoom: 15,
	  center: uluru,
	  zoomControlOptions: {
          position: google.maps.ControlPosition.LEFT_BOTTOM
      },
	  styles: [
	  	{elementType: 'geometry', stylers: [{color: '#f7f7f7'}]},
	  	{elementType: 'labels.text.fill', stylers: [{color: '#256155'}]},
		{
			featureType: 'poi.park',
			elementType: 'geometry',
			stylers: [{color: '#e5e5e5'}]
		},
		{
		  featureType: 'road',
		  elementType: 'geometry',
		  stylers: [{color: '#ffffff'}]
		},
		{
		  featureType: 'water',
		  elementType: 'geometry',
		  stylers: [{color: '#cadce6'}]
		}
	  ],
	});
	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map
	});
	}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxR9btB02y_hWZqtAt6BTh6kHDtWNdbs&callback=initMap"></script>
	{/literal}
{/block}

