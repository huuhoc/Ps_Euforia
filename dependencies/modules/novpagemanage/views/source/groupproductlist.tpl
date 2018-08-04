<div class="col-md-{$columns} col-xs-12">
	<div class="groupproductlist{if isset($class) && $class} {$class}{/if}">
		<div class="d-flex{if isset($show_reverse) && $show_reverse == 1} flex-row-reverse{/if}">
			<div class="w-1464p group--catelist">
				<div class="group-catelist-content">
					{if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
					<h2 class="title_block">
						{if isset($image_icon) && !empty($image_icon)}
							<img src="{$novpagemanage_img nofilter}{$image_icon nofilter}" alt="icon title">
						{/if}
						{$title nofilter}
						{if isset($sub_title) && !empty($sub_title)}
							<span class="sub_title">{$sub_title}</span>
						{/if}
					</h2>
					{/if}
					<div class="cate-child">
					{if isset($children) && $children }
						<ul>
						{foreach from=$children item=category_children}
							<li><a href="{$link->getCategoryLink({$category_children.id_category})}">{$category_children.name}</a></li>
						{/foreach}
							<li class="last"><a href="{$link->getCategoryLink({$id_category})}">{l s='View all'}</a></li>
						</ul>
					{/if}
					</div>
				</div>
			</div>
			<div class="group--banner w-2736p">
				<div class="owl-carousel owl-theme" data-autoplay="false" data-autoplayTimeout="8000" data-loop="false" data-margin="0" data-dots="true" data-nav="false" data-items="1" data-items_tablet="1" data-items_mobile="1">
					{if isset($image1) && $image1}
					<div class="effect">
						<a href="{$link_image1}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image1 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
					</div>
					{/if}
					{if isset($image2) && $image2}
					<div class="effect">
						<a href="{$link_image2}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image2 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
					</div>
					{/if}
					{if isset($image3) && $image3}
					<div class="effect">
						<a href="{$link_image3}"><img class="img-fluid" src="{$novpagemanage_img nofilter}{$image3 nofilter}" alt="{$title nofilter}" title="{$title nofilter}"></a>
					</div>
					{/if}
				</div>
			</div>

			<div class="block_content w-58p no-padding">
				<div class="product_tab_content tab-content">
					{if !empty($products)}
					<div id="{$name_tab nofilter}" class="product_list grid owl-carousel owl-theme" data-autoplay="false" data-autoplayTimeout="6000" data-loop="false" data-margin="5" data-dots="false" data-nav="true" data-items="{$colspage nofilter}" data-items_tablet="{$column_tablet nofilter}" data-items_mobile="{$column_mobile nofilter}">
						{include file='_partials/layout/items/item_one.tpl' class_item="" number_row=$number_row show_countdown=0}
					</div>
					{else}
						<p class="alert alert-info">{l s='No products at this time.'}</p>
					{/if}
				</div>
			</div>
		</div>
	</div>
</div>