{if isset($image1)}
<div class="nov-image col-lg-{$columns} col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
 <div class="block">
  <div class="block_content">
		<div class="effect">
			<a href="{$link_image}"> <img class="img-fluid" src="{$novpagemanage_img nofilter}{$image1 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
		</div>
  </div>
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <div class="title_block">
    {$title nofilter}
    {if isset($subtitle) && !empty($subtitle)}
    <span class="sub_title">{$subtitle nofilter}</span>
    {/if}
   </div>
  {/if}
 </div>
</div>
{/if}