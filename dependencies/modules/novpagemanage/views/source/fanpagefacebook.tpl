<div class="nov-fanpage col-lg-{$columns} col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
 <div class="block">
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <h4 class="title_block">
    {$title nofilter}
   </h4>
  {/if}
  
  <div class="block_content">
		<div class="fb-page" data-href="{$fanpage_url}" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="{if $hidden_cover == 1}true{else}false{/if}" data-show-facepile="true">
			<blockquote cite="{$fanpage_url}" class="fb-xfbml-parse-ignore">
				<a href="{$fanpage_url}">{$fanpage_url}</a>
			</blockquote>
		</div>
  </div>
 </div>
</div>