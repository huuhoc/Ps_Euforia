<div class="social col-lg-{$columns} col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
	<div class="block">
		<div class="d-flex align-items-center">
		  {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
          <div class="title_block mr-4">{$title nofilter}</div>
          {/if}
          <ul class="list-inline mb-0">
	          {if isset($novconfig.social_facebook) && $novconfig.social_facebook}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_facebook}"><i class="zmdi zmdi-facebook"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_twitter) && $novconfig.social_twitter}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_twitter}"><i class="zmdi zmdi-twitter"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_google) && $novconfig.social_google}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_google}"><i class="zmdi zmdi-google-old"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_instagram) && $novconfig.social_instagram}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_instagram}"><i class="zmdi zmdi-instagram"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_dribbble) && $novconfig.social_dribbble}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_dribbble}"><i class="zmdi zmdi-dribbble"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_flickr) && $novconfig.social_flickr}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_flickr}"><i class="zmdi zmdi-flickr"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_pinterest) && $novconfig.social_pinterest}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_pinterest}"><i class="zmdi zmdi-pinterest"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_linkedIn) && $novconfig.social_linkedIn}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_linkedIn}"><i class="zmdi zmdi-linkedin"></i></a></li>
	          {/if}
	          {if isset($novconfig.social_skype) && $novconfig.social_skype}
	          <li class="list-inline-item mb-0"><a href="{$novconfig.social_skype}"><i class="zmdi zmdi-skype"></i></a></li>
	          {/if}
          </ul>
        </div>
	</div>
</div>