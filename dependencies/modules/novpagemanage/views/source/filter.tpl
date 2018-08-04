<div class="products_block_filter col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
		{if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
		<h2 class="title_block">
			{$title nofilter}
			{if isset($sub_title) && !empty($sub_title)}
				<span class="sub_title">{$sub_title}</span>
			{/if}
		</h2>
		{/if}
		<div class="block_content_filter" data-action="{$action}" data-limit="{$limit}" data-numberload="{$number_load}">
			<div class="filter-top d-flex align-items-center">
				{if ($categories)}
				<div class="btn dropdown-toggle toggle-category hidden-lg-up mr-auto">{l s="Select Category"}</div>
				<div class="category mr-auto">
					<ul class="filter_product list-category list-inline">
						{if isset($show_all_product) && $show_all_product == 1}
						<li data-id_category="0" class="list-inline-item active">{l s="All product"}</li>
						{/if}
						{foreach from=$categories item=category_name key=k name=categories}
						<li data-id_category="{$k}" class="list-inline-item{if $smarty.foreach.foo.last && isset($show_all_product) && $show_all_product == 0} active{/if}">{$category_name}</li>
						{/foreach}
					</ul>
				</div>
				{/if}
				{if ($orderby)}
					<div class="filter-sortby{if isset($show_sort) && $show_sort == 0} hidden{/if}">
					    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      {l s='Sort by'}
					    </button>
					    <div  class="dropdown-menu">
					    	<ul class="list-unstyled mb-0">
								{foreach from=$orderby item=order}
									<li class="dropdown-item" data-value="{$order.value}" value="{$order.value}">{$order.name}</li>
								{/foreach}
							</ul>
					    </div >
					</div>
				{/if}

				<div class="toggle-filter btn dropdown-toggle ml-3{if isset($show_filter) && $show_filter == 0} hidden{/if}" data-label="{l s='Filter'}" data-label-hidden="{l s='Hide Filter'}">{l s='Filter'}</div>

			</div>
			<div class="content_filter{if isset($show_filter) && $show_filter == 0} hidden{/if}">
				<div class="row">	
					{if ($atributes)}
					{foreach from=$atributes item=attribute_group}
						<div class="col-md-3">
							<div class="nov-filter-title d-flex align-items-center">
								<span>
									<i class="material-icons add">add</i>
									<i class="material-icons remove">remove</i>
								</span>
								{l s="Choose"} {$attribute_group.name}
							</div>
							{if $attribute_group.atribute}
								<ul class="atribute filter_product list-unstyled active">
								{foreach from=$attribute_group.atribute item=atribute}
									{if $attribute_group.is_color_group == 1}
										{if $atribute.texture}
											<li data-id_attribute="{$atribute.id_attribute}"><span class="color" style="background-image: url({$atribute.texture});"></span><span>{$atribute.name}</span></li>
										{else}
											<li data-id_attribute="{$atribute.id_attribute}"><span class="color" style="background-color:{$atribute.color};"></span><span>{$atribute.name}</span></li>
										{/if}
									{else}
										<li data-id_attribute="{$atribute.id_attribute}">{$atribute.name}</li>
									{/if}
								{/foreach}
								</ul>
							{/if}
						</div>
					{/foreach}	
					{/if}

					{if ($manus)}
					<div class="col-md-3">
						<div class="nov-filter-title d-flex align-items-center">
							<span>
								<i class="material-icons add">add</i>
								<i class="material-icons remove">remove</i>
							</span>
							{l s='Choose Manufacture'}
						</div>
						<ul class="manufacture filter_product list-unstyled active">
						{foreach from=$manus item=manu}
							<li data-id_manufacture="{$manu.id_manufacturer}">{$manu.name}</li>
						{/foreach}
						</ul>
					</div>
					{/if}
					
					<div class="nov-filter-price col-md-3">
						<div class="nov-filter-title d-flex align-items-center">
							<span>
								<i class="material-icons add">add</i>
								<i class="material-icons remove">remove</i>
							</span>
							{l s='Choose Price'}
						</div>
						<div class="filter_product">
							<div id="nov_slider_price" data-min="{$aggregatedRanges.min}" data-max="{$aggregatedRanges.max}"></div>
							<div class="price-input">
								<span>{l s='Range'}</span>
								<span class="input-text text-price-filter" id="text-price-filter-min-text">{$aggregatedRanges.min}</span> -
								<span class="input-text text-price-filter" id="text-price-filter-max-text">{$aggregatedRanges.max}</span>	
								<input class="input-text text-price-filter hidden-lg-up hidden-md-up hidden-xs-up" id="price-filter-min-text" type="text" value="{$aggregatedRanges.min}">
								<input class="input-text text-price-filter hidden-lg-up hidden-md-up hidden-xs-up" id="price-filter-max-text" type="text" value="{$aggregatedRanges.max}">
							</div>
						</div>

					</div>

				</div>
			</div>

			<div class="content_product">	
				<div class="clear_all" style="display:none;"><span><i class="zmdi zmdi-close"></i>{l s="Clear All Filter"}</span></div>
				
			{if !empty($products)}
				<div class="product_list grid row">
					{if $number_load < 12 && 12/$number_load == 2.4 }
						{assign var='class_col' value='cus-5'}
					{else}
						{assign var='class_col' value=12/$number_load }
					{/if}
					{include file='_partials/layout/items/item_one.tpl' class_item="col-lg-{$class_col} col-md-{$class_col} col-xs-6" number_row=1}
				</div>
			{else}
				<p class="alert alert-info">{l s='No products at this time.'}</p>	
			{/if}
				<div class="process-loading">
		            <div class="loader">
		                <div class="dot"></div>
		                <div class="dot"></div>
		                <div class="dot"></div>
		                <div class="dot"></div>
		                <div class="dot"></div>
		            </div>
		        </div>
			</div>
			<div class="content_showmore text-center{if isset($show_loadmore) && $show_loadmore == 1} has-showmore{else} hidden{/if}">
				<button type="button" class="btn btn-default novShowMore" name="novShowMore" data-loading="{l s='Loading...'}" data-loadmore="{l s='Load More'}">
					<i class="fa fa-spinner" aria-hidden="true"></i><span>{l s='Load More'}</span>
				</button>
				<input type="hidden" value="0" class="count_showmore"/>
			</div>
		</div>
</div>