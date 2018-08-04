{extends file="helpers/form/form.tpl"}

{block name="legend"}
	<div class="panel-heading">
		{if isset($field.image) && isset($field.title)}<img src="{$field.image}" alt="{$field.title|escape:'html':'UTF-8'}" />{/if}
		<span class="module-name">{$field.title}</span> <span class="description">You can create new item.</span>
	</div>
{/block}

{block name="field"}
    {if $input.type == 'homepage'}
		<div class="nov-content">
		{foreach from=$hooks item=hook}
		<div class="panel nov-panel-2" id="{$hook}">
				<div class="pull-right btn-group">
					<button type="button" class="btn btn-default dropdown-toggle btn-add-group btn-add-col" tabindex="-1" data-toggle="dropdown">
						{l s='Insert a item'} <span class="caret"></span>
					</button>
					{if $sources}
						<ul class="dropdown-menu pull-right list-group">
						{foreach from=$sources item=source}
						<li>
							<a  href="{$currentIndex}&action=additem&type={$source}&hook={$hook}" tabindex="-1">                                          
								<span >{$source}</span>
							</a>
						</li>
						{/foreach}
						</ul>
					{/if}
				</div>
				<div class="form-wrapper">
					<div class="form-group">
						<h2>{$hook}</h4>
						<div class="novpagemanage">
							<ol class="lever-1 novpagemanage-list clearfix">
								{if $datas[$hook]}
									{foreach from=$datas[$hook] item=item}
										{assign var="title" value="title_`$id_language`"}
										{if $item.type == "row"}
										<li class="novpagemanage-item novpagemanage-item-row col-md-{$item['data']['columns']} col-sm-{$item['data']['columns']}" id="items_{$item.id_novpagemanage}">
											<div class="novpagemanage-handle"><i class="material-icons">menu</i></div>
											<div class="novpagemanage-content clearfix">
												<div class="group-config">
													<div>
														<a class="" href="{$currentIndex}&action=additem&type={$item.type}&hook={$item.hook}&id_novpagemanage={$item.id_novpagemanage}" title="{l s='Edit'}"><i class="material-icons">edit</i></a>
														<a class="check {if $item['data']['active'] == 0}disabled{/if}" data-idnovpagemanage="{$item.id_novpagemanage}" href="#" title="{l s='Status'}"><i class="material-icons">check</i></a>
														{if isset($item['data']['link_module']) && $item['data']['link_module']}
															<a class="" href="{$item['data']['link_module']}" title="{l s='Config Module'}"><i class="material-icons">settings</i></a>
														{/if}
														<a class="remove" data-idnovpagemanage="{$item.id_novpagemanage}" href="#" title="{l s='Delete'}"><i class="material-icons">close</i></a>
													</div>
												</div>											
												<div class="btn-group">
													<button type="button" class="btn btn-default dropdown-toggle btn-add-group btn-add-col" tabindex="-1" data-toggle="dropdown">
														{l s='Insert A Item'} <span class="caret"></span>
													</button>
													{if $sources}
														<ul class="dropdown-menu pull-right list-group">
														{foreach from=$sources item=source}
														{if $source != "row"}
														<li>
															<a  href="{$currentIndex}&action=additem&type={$source}&hook={$hook}&row={$item.id_novpagemanage}" tabindex="-1">                                          
																<span >{$source}</span>
															</a>
														</li>
														{/if}		
														{/foreach}
														</ul>
													{/if}									
												</div>											
												<div class="form-wrapper">
													<div class="form-group">
														<div class="novpagemanage">										
															<ol class="lever-2 novpagemanage-list clearfix">
																{if isset($item.row) && $item.row}
																	{foreach from=$item.row item=row}
																		<li class="novpagemanage-item col-md-{$row['data']['columns']} col-sm-{$row['data']['columns']}" id="items_{$row.id_novpagemanage}">
																			<div class="novpagemanage-handle"><i class="material-icons">menu</i></div>
																			<div class="novpagemanage-content clearfix">
																					<div class="group-config">
																						<div>
																							
																							{assign var="row_type" value= "-"|explode:$row.type }
																							<a class="" href="{$currentIndex}&action=additem&type={$row_type[0]}&hook={$row.hook}&id_novpagemanage={$row.id_novpagemanage}&row={$item.id_novpagemanage}" title="{l s='Edit'}"><i class="material-icons">edit</i></a>
																							<a class="check {if $row['data']['active'] == 0}disabled{/if}" data-idnovpagemanage="{$row.id_novpagemanage}" href="#" title="{l s='Status'}"><i class="material-icons">check</i></a>
																							{if isset($row['data']['link_module']) && $row['data']['link_module']}
																								<a class="" href="{$row['data']['link_module']}" title="{l s='Config Module'}"><i class="material-icons">settings</i></a>
																							{/if}
																							<a class="remove" data-idnovpagemanage="{$row.id_novpagemanage}" href="#" title="{l s='Delete'}"><i class="material-icons">close</i></a>
																						</div>
																					</div>
																				{if $row['data']['columns'] > 2}	
																				<div class="col-md-12 col-sm-12">
																				{else}
																				<div class="col-md-12 col-sm-12">
																				{/if}
																					{if $row['data']['columns'] == 2}
																						{$row['data'][$title]|truncate:15:'...':true|escape:'html':'UTF-8'}
																					{elseif $row['data']['columns'] == 3}
																						{$row['data'][$title]|truncate:18:'...':true|escape:'html':'UTF-8'}
																					{elseif $row['data']['columns'] == 4}
																						{$row['data'][$title]|truncate:25:'...':true|escape:'html':'UTF-8'}	
																					{else}
																						{$row['data'][$title]}
																					{/if}	
																				</div>
																				{if $row['data']['columns'] > 2}
																				<div class="col-md-5 col-sm-4 text-center hidden">{$row.type}</div>
																				{/if}
																			</div>
																		</li>
																	{/foreach}
																{/if}	
															</ol>
														</div>
													</div>
												</div>	
											</div>			
										</li>
										{else}
										<li class="novpagemanage-item col-md-{$item['data']['columns']} col-sm-{$item['data']['columns']}" id="items_{$item.id_novpagemanage}">
											<div class="novpagemanage-handle"><i class="material-icons">menu</i></div>
											<div class="novpagemanage-content clearfix">
													<div class="group-config">
														<div>
															<a class="" href="{$currentIndex}&action=additem&type={$item.type}&hook={$item.hook}&id_novpagemanage={$item.id_novpagemanage}" title="{l s='Edit'}"><i class="material-icons">edit</i></a>
															<a class="check {if $item['data']['active'] == 0}disabled{/if}" data-idnovpagemanage="{$item.id_novpagemanage}" href="#" title="{l s='Status'}"><i class="material-icons">check</i></a>
															{if isset($item['data']['link_module']) && $item['data']['link_module']}
																<a class="" href="{$item['data']['link_module']}" title="{l s='Config Module'}"><i class="material-icons">settings</i></a>
															{/if}
															<a class="remove" data-idnovpagemanage="{$item.id_novpagemanage}" href="#" title="{l s='Delete'}"><i class="material-icons">close</i></a>
														</div>
													</div>
												{if $item['data']['columns'] > 2}	
												<div class="col-md-8 col-sm-8">
												{else}
												<div class="col-md-12 col-sm-12">
												{/if}
													{if $item['data']['columns'] == 2}
														{$item['data'][$title]|truncate:15:'...':true|escape:'html':'UTF-8'}
													{elseif $item['data']['columns'] == 3}
														{$item['data'][$title]|truncate:18:'...':true|escape:'html':'UTF-8'}
													{elseif $item['data']['columns'] == 4}
														{$item['data'][$title]|truncate:25:'...':true|escape:'html':'UTF-8'}	
													{else}
														{$item['data'][$title]}
													{/if}	
												</div>
												{if $item['data']['columns'] > 2}
												<div class="col-md-4 col-sm-4">{$item.type}</div>
												{/if}
											</div>
										</li>										
										{/if}
									{/foreach}
								{/if}
							</ol>
						</div>	
					</div>	
				</div>
			</div>	
			{/foreach}
		</div>
		<script type="text/javascript">
		{literal}
		$(document).ready(function(){
			var action ='{/literal}{$currentIndex}{literal}';
			$(".nov-content").Mghomepage({action:action});
		});
		{/literal}
		</script>	
    {/if} 
    {$smarty.block.parent}
{/block}