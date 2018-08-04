{if isset($twitter_name) && $twitter_name}
<div class="nov-html{if isset($class) && $class} {$class}{/if} col-md-{$columns} col-xs-12">
 <div class="block">
  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
   <h4 class="title_block">
    {$title nofilter}
   </h4>
  {/if}
  <div class="block_content">
		<div id="nov-twitter{$twitter_id}" class="nov-twitter">
			<a class="twitter-timeline" width="{$tw_width}px" height="{$tw_height}px" data-chrome="{$chrome}" data-dnt="true"   data-link-color="{$link_color}"  data-border-color="{$border_color}" lang="{$iso_code}" data-tweet-limit="{$limit}" data-link-color="{$link_color}"  data-show-replies="{$show_replies}" href="https://twitter.com/{$twitter_name}"  data-widget-id="{$twitter_id}"  >Tweets by @{$twitter_name}</a>
			{$js_twitter}
		</div>	
  </div>
 </div>
</div>

<script type="text/javascript">
{literal}
var hideTwitterAttempts = 0;
	function hideTwitterBoxElement() {
	 setTimeout( function() {
	  if ( $('[id*=nov-twitter{/literal}{$twitter_id}{literal}]').length ) {
	   $('#nov-twitter{/literal}{$twitter_id}{literal} iframe').each( function(){
		var ibody = $(this).contents().find( 'body' );
		var show_scroll =  {/literal}{$show_scrollbar}{literal}; 
		var tw_height =  {/literal}{$tw_height}{literal}+'px'; 
		if ( ibody.find( '.timeline .stream .h-feed li.tweet' ).length ) {
			ibody.find( '.header .p-nickname' ).css( 'color', '{/literal}{$mail_color}{literal}' );
			ibody.find( '.p-name' ).css( 'color', '{/literal}{$name_color}{literal}' );
			ibody.find( '.e-entry-title' ).css( 'color', '{/literal}{$text_color}{literal}' );
			if(show_scroll == 1){
				ibody.find( '.timeline .stream' ).css( 'max-height', tw_height );
				ibody.find( '.timeline .stream' ).css( 'overflow-y', 'auto' );	
				ibody.find( '.timeline .twitter-timeline' ).css( 'height', 'inherit !important' );	
			}
		} else {
		 $(this).hide();
		}
	   });
	  }
	  
	  hideTwitterAttempts++;
	  
	  if ( hideTwitterAttempts < 3 ) {
		hideTwitterBoxElement();
	  }
	  
	 }, 1500);
	}
	hideTwitterBoxElement();
{/literal}
</script>
{/if}