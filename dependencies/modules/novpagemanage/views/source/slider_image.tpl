
<div class="nov-slider-image col-lg-{$columns} col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
 <div class="block">
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <h4 class="title_block">
    {$title nofilter}
   </h4>
  {/if}
  
  <div class="block_content">
		<div class="owl-carousel owl-theme" data-autoplay="false" data-autoplayTimeout="6000" data-loop="false" data-margin="{$spacing_item}" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_tablet="{$column_tablet nofilter}" data-items_mobile="{$column_mobile nofilter}">
			<a href="{$link_image1}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image1 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
			<a href="{$link_image2}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image2 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
			<a href="{$link_image3}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image3 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
			<a href="{$link_image4}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image4 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
			<a href="{$link_image5}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image5 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
			<a href="{$link_image6}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image6 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
		</div>
  </div>
 </div>
</div>