{extends file="helpers/form/form.tpl"}



{block name='defaultForm'}
	<div class="themeconfig-heading">
		<img src="{$imagelogo}" />
		<span class="module-name">Themes configurator</span>
	</div>
    <ul id="nov-config-tabs">
        {foreach $sptabs as $tabTitle => $tabClass}
            <li class="tab" data-tab="{$tabClass}">
                {$tabTitle}
            </li>
        {/foreach}
		
    </ul>
    {$smarty.block.parent}
{/block}

{block name="legend"}
	{*
	<div class="panel-heading">
		{if isset($field.image) && isset($field.title)}<img src="{$field.image}" alt="{$field.title|escape:'html':'UTF-8'}" />{/if}
		<span class="module-name">{$field.title}</span> <span class="description">You can create new item.</span>
	</div>
	*}
{/block}

{block name="label"}
	{if isset($input.label)}
		<label class="control-label col-lg-2{if isset($input.required) && $input.required && $input.type != 'radio'} required{/if}">
			{if isset($input.hint)}
			<span class="label-tooltip" data-toggle="tooltip" data-html="true" title="{if is_array($input.hint)}
						{foreach $input.hint as $hint}
							{if is_array($hint)}
								{$hint.text|escape:'html':'UTF-8'}
							{else}
								{$hint|escape:'html':'UTF-8'}
							{/if}
						{/foreach}
					{else}
						{$input.hint|escape:'html':'UTF-8'}
					{/if}">
			{/if}
			{$input.label}
			{if isset($input.hint)}
			</span>
			{/if}
		</label>
	{/if}
{/block}
{block name="input"}
	
    {if $input.name == 'novthemeconfig_payment_image'}
        {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img class="img-responsive" src="{$imagePath}{$fields_value[$input.name]}"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}
		{$smarty.block.parent}
	{elseif $input.name == 'novthemeconfig_logo_mobile'}
        {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img class="img-responsive" src="{$imagePath}{$fields_value[$input.name]}"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}
		{$smarty.block.parent}
	{elseif $input.name == 'novthemeconfig_logo_footer'}
        {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img class="img-responsive" src="{$imagePath}{$fields_value[$input.name]}"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}
		{$smarty.block.parent}
	{elseif $input.name == 'novthemeconfig_body_bg_image'}
		 {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img class="img-responsive" src="{$imagePath}{$fields_value[$input.name]}"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}
		{$smarty.block.parent}
	{elseif $input.name == 'novpopup_loading_image'}
		 {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img class="img-responsive" src="{$imagePath}{$fields_value[$input.name]}"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}
		{$smarty.block.parent}
	{elseif $input.name == 'novpopup_newsletter_bg'}
		 {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img class="img-responsive" src="{$imagePath}{$fields_value[$input.name]}"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}
		{$smarty.block.parent}
	{elseif $input.name == 'nov_clearcss'}
		<div class="alert alert-warning">
			<button id="nov_clearcss" class="btn btn-success" type="button">
				<i class="icon-eraser"></i> {l s="Clear CSS"}
			</button>
		  	<span style="margin:0 10px;">{l s='Delete all of the theme css file and regenerate from sass.'}</span>		
		</div>
		<script>
			function objToString(obj) {
				var str = '';
				for (var p in obj) {
					if (obj.hasOwnProperty(p)) {
						str += '&' + p + '=' + obj[p];
					}
				}
				return str;
			}
			$('#nov_clearcss').on('click', function(){
				var that = $(this);
				that.attr('class', 'btn btn-warning disabled');
				that.find('i').attr('class', 'icon-spinner icon-spin');
				var params = {
					action : 'clearCss',
					ajax : 1
				};
				var query = $.ajax({
					type: 'POST',
					url: '{$controller_url}',
					data: objToString(params),
					dataType: 'json',
					success: function(data) {
						if(data.success){
							that.attr('class', 'btn btn-success disabled');
							that.find('i').attr('class', 'icon-eraser');
						} else {
							that.attr('class', 'btn btn-danger');
							that.find('i').attr('class', 'icon-frown');
						}
					}
				});
			});
		</script>
    {else}
        {$smarty.block.parent}
    {/if}

{/block}



{block name="footer"}
{capture name='form_submit_btn'}{counter name='form_submit_btn'}{/capture}
	{if isset($fieldset['form']['submit']) || isset($fieldset['form']['buttons'])}
		<div class="panel-footer">
			{if isset($fieldset['form']['submit']) && !empty($fieldset['form']['submit'])}
			<button type="submit" value="1"	id="{if isset($fieldset['form']['submit']['id'])}{$fieldset['form']['submit']['id']}{else}{$table}_form_submit_btn{/if}{if $smarty.capture.form_submit_btn > 1}_{($smarty.capture.form_submit_btn - 1)|intval}{/if}" name="{if isset($fieldset['form']['submit']['name'])}{$fieldset['form']['submit']['name']}{else}{$submit_action}{/if}{if isset($fieldset['form']['submit']['stay']) && $fieldset['form']['submit']['stay']}AndStay{/if}" class="{if isset($fieldset['form']['submit']['class'])}{$fieldset['form']['submit']['class']}{else}btn btn-default pull-right{/if}">
				<i class="{if isset($fieldset['form']['submit']['icon'])}{$fieldset['form']['submit']['icon']}{else}process-icon-save{/if}"></i> {$fieldset['form']['submit']['title']}
			</button>
			{/if}
			{if isset($show_cancel_button) && $show_cancel_button}
			<a href="{$back_url|escape:'html':'UTF-8'}" class="btn btn-default" onclick="window.history.back();">
				<i class="process-icon-cancel"></i> {l s='Cancel' d='Admin.Actions'}
			</a>
			{/if}
			{if isset($fieldset['form']['reset'])}
			<button
				type="reset"
				id="{if isset($fieldset['form']['reset']['id'])}{$fieldset['form']['reset']['id']}{else}{$table}_form_reset_btn{/if}"
				class="{if isset($fieldset['form']['reset']['class'])}{$fieldset['form']['reset']['class']}{else}btn btn-default{/if}"
				>
				{if isset($fieldset['form']['reset']['icon'])}<i class="{$fieldset['form']['reset']['icon']}"></i> {/if} {$fieldset['form']['reset']['title']}
			</button>
			{/if}
			{if isset($fieldset['form']['buttons'])}
			{foreach from=$fieldset['form']['buttons'] item=btn key=k}
				{if isset($btn.href) && trim($btn.href) != ''}
					<a href="{$btn.href}" {if isset($btn.target) && $btn.target=='_blank'}target="_blank"{/if} {if isset($btn['id'])}id="{$btn['id']}"{/if} class="btn btn-default{if isset($btn['class'])} {$btn['class']}{/if}" {if isset($btn.js) && $btn.js} onclick="{$btn.js}"{/if}>{if isset($btn['icon'])}<i class="material-icons {$btn['icon']}" >{$btn['icon']}</i> {/if}{$btn.title}</a>
				{else}
					<button type="{if isset($btn['type'])}{$btn['type']}{else}button{/if}" {if isset($btn['id'])}id="{$btn['id']}"{/if} class="btn btn-default{if isset($btn['class'])} {$btn['class']}{/if}" name="{if isset($btn['name'])}{$btn['name']}{else}submitOptions{$table}{/if}"{if isset($btn.js) && $btn.js} onclick="{$btn.js}"{/if}>{if isset($btn['icon'])}<i class="material-icons {$btn['icon']}" >{$btn['icon']}</i> {/if}{$btn.title}</button>
				{/if}
			{/foreach}
			{/if}
		</div>
	{/if}
{/block}