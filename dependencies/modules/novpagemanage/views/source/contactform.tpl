<div class="nov-html col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
 <div class="block">
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <div class="title_block">
    	{$title nofilter}
   </div>
  {/if}
  <div class="block_content">
	{widget name="contactform"}
  </div>
 </div>
</div>