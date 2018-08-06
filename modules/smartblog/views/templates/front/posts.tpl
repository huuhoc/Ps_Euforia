{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
**}

{extends file="layouts/`$novconfig.novthemeconfig_cateblog_layout`.tpl"}


{block name='breadcrumb-title'}
    <div class="breadcrumb-title-page">{$meta_title}</div>
{/block}
{block name='breadcrumb-link'}
	{assign var="catOptions" value=null}
	{$catOptions.id_category = $id_category}
	{$catOptions.slug = $cat_link_rewrite}
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{$urls.base_url}">
                <span itemprop="name">{l s='Home' d='Shop.Theme'}</span>
            </a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{smartblog::GetSmartBlogLink('smartblog_category',$catOptions)}">
            <span itemprop="name">{$title_category}</span>
            </a>
            <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <span itemprop="name">{$meta_title}</span>
            <meta itemprop="position" content="3">
        </li>
    </ol>
{/block}

{block name='content'}
	<div class="blogwapper{if $novconfig.novthemeconfig_cateblog_layout == 'layout-one-column'} one-columns{/if}">
		{capture name=path}<a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='All Blog News' mod='smartblog'}</a>{$meta_title}{/capture}
		<div id="content" class="block">
		    <div itemtype="#" itemscope="" id="sdsblogArticle" class="blog-post">
		    	<div class="post-img">
		    		{assign var="activeimgincat" value='0'}
		            {$activeimgincat = $smartshownoimg} 
		            {if ($post_img != "no" && $activeimgincat == 0) || $activeimgincat == 1}
		                <a id="post_images" href="{$modules_dir}/smartblog/images/{$post_img}-single-default.jpg"><img class="img-fluid" src="{$modules_dir}/smartblog/images/{$post_img}-single-default.jpg" alt="{$meta_title}"></a>
		            {/if}
		    	</div>
		   		<h1 class="post-title">{$meta_title}</h1>
				
			    <div class="articleContent" itemprop="articleBody">
				    <div class="sdsarticle-des">
				       {$content}
				    </div>
			    </div>
			    {if $tags != ''}
			        <div class="sdstags-update">
			            <span class="tags"><b>{l s='Tags:' mod='smartblog'} </b> 
			                {foreach from=$tags item=tag}
			                    {assign var="options" value=null}
			                    {$options.tag = $tag.name}
			                    <a title="tag" href="{smartblog::GetSmartBlogLink('smartblog_tag',$options)}">{$tag.name}</a>
			                {/foreach}
			            </span>
			        </div>
			   {/if}
				<div class="sdsarticleBottom">
					<div class="post-info">
						{assign var="catOptions" value=null}
						{$catOptions.id_category = $id_category}
						{$catOptions.slug = $cat_link_rewrite}
			            <span>
					       {l s='Posted by ' mod='smartblog'} {if $smartshowauthor ==1}&nbsp;<i class="icon icon-user"></i><span itemprop="author">{if $smartshowauthorstyle != 0}{$firstname} {$lastname}{else}{$lastname} {$firstname}{/if}</span>&nbsp;<i class="icon icon-calendar"></i>&nbsp;<span itemprop="dateCreated">{$created|date_format}</span>{/if}&nbsp;&nbsp;<i class="icon icon-tags"></i>&nbsp;<span itemprop="articleSection"><a href="{smartblog::GetSmartBlogLink('smartblog_category',$catOptions)}">{$title_category}</a></span> &nbsp;<i class="icon icon-comments"></i>&nbsp; {if $countcomment != ''}{$countcomment}{else}{l s='0' mod='smartblog'}{/if}{l s=' Comments' mod='smartblog'}</span>
					    <a title="" style="display:none" itemprop="url" href="#"></a>
					</div>
					{hook h="displaySmartAfterPost"}
					{*{$HOOK_SMART_BLOG_POST_FOOTER}*}
				</div>
		    </div>

			{if $countcomment != ''}
			<div id="articleComments">
	            <h3>{*{if $countcomment != ''}{$countcomment}{else}{l s='0' mod='smartblog'}{/if}*}{l s='Comments' mod='smartblog'}</h3>
		        <div id="comments">      
		            <ul class="commentList">
	                  	{$i=1}
		                {foreach from=$comments item=comment}
		                    
		                       {include file="./comment_loop.tpl" childcommnets=$comment}
		                   
		                  {/foreach}
		            </ul>
		        </div>
			</div>
			{/if}

		</div>

		{if Configuration::get('smartenablecomment') == 1}
			{if $comment_status == 1}
			<div class="smartblogcomments" id="respond">
			    <h4 class="comment-reply-title" id="reply-title">{l s="Submit comment"  mod="smartblog"}</h4>
				<div id="commentInput">
					<form action="" method="post" id="commentform">
						<input type='hidden' name='comment_post_ID' value='1478' id='comment_post_ID' />
						<input type='hidden' name='id_post' value='{$id_post}' id='id_post' />
						<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
						<div class="row">
							<div class="form-group col col-xs-12">
								<input type="text" class="inputName form-control" name="name" placeholder="{l s='Your Name *'  mod='smartblog'}">
							</div>
							<div class="form-group col col-xs-12">
								<input type="text" class="inputMail form-control" name="mail" placeholder="{l s='Your E-mail *'  mod='smartblog'}">
							</div>
							<div class="form-group col col-xs-12">
								<input type="text" class="form-control" name="website" placeholder="{l s='Your Website'  mod='smartblog'}">
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<textarea tabindex="4" class="inputContent form-control grey" rows="10" name="comment" placeholder="{l s='Your Message'  mod='smartblog'}"></textarea>
							</div>
						</div>

						{if Configuration::get('smartcaptchaoption') == '1'}
							<img src="{$modules_dir}smartblog/classes/CaptchaSecurityImages.php?width=100&height=40&characters=5">
							<input type="text" tabindex="" value="" name="smartblogcaptcha" class="smartblogcaptcha form-control grey" placeholder="{l s='Please input capcha..'  mod='smartblog'}">
						{/if}

						<div class="submit">
				            <input type="submit" name="addComment" id="submitComment" class="btn btn-default" value="{l s='Send Message'  mod='smartblog'}">
						</div>

			        </form>
				</div>
			</div>

			{literal}
			<script type="text/javascript">
				$('#submitComment').bind('click',function(event) {
				event.preventDefault();
				var data = { 'action':'postcomment', 
				'id_post':$('input[name=\'id_post\']').val(),
				'comment_parent':$('input[name=\'comment_parent\']').val(),
				'name':$('input[name=\'name\']').val(),
				'website':$('input[name=\'website\']').val(),
				'smartblogcaptcha':$('input[name=\'smartblogcaptcha\']').val(),
				'comment':$('textarea[name=\'comment\']').val(),
				'mail':$('input[name=\'mail\']').val() };
					$.ajax( {
					  url: baseDir + 'modules/smartblog/ajax.php',
					  data: data,
					  
					  dataType: 'json',
					  
					  beforeSend: function() {
						$('.success, .warning, .error').remove();
						$('#submitComment').attr('disabled', true);
						$('#commentInput').before('<div class="attention"><img src="http://321cart.com/sellya/catalog/view/theme/default/image/loading.gif" alt="" />Please wait!</div>');

						},
						complete: function() {
						$('#submitComment').attr('disabled', false);
						$('.attention').remove();
						},
						success: function(json) {
							if (json['error']) {
									 
								$('#commentInput').before('<div class="warning">' + '<i class="icon-warning-sign icon-lg"></i>' + json['error']['common'] + '</div>');
								
								if (json['error']['name']) {
									$('.inputName').after('<span class="error">' + json['error']['name'] + '</span>');
								}
								if (json['error']['mail']) {
									$('.inputMail').after('<span class="error">' + json['error']['mail'] + '</span>');
								}
								if (json['error']['comment']) {
									$('.inputContent').after('<span class="error">' + json['error']['comment'] + '</span>');
								}
								if (json['error']['captcha']) {
									$('.smartblogcaptcha').after('<span class="error">' + json['error']['captcha'] + '</span>');
								}
							}
							
							if (json['success']) {
								$('input[name=\'name\']').val('');
								$('input[name=\'mail\']').val('');
								$('input[name=\'website\']').val('');
								$('textarea[name=\'comment\']').val('');
						 		$('input[name=\'smartblogcaptcha\']').val('');
							
								$('#commentInput').before('<div class="success">' + json['success'] + '</div>');
								setTimeout(function(){
									$('.success').fadeOut(300).delay(450).remove();
															},2500);
							
							}
						}
					});
				});
						
				var addComment = {
					moveForm : function(commId, parentId, respondId, postId) {

						var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');

						if ( ! comm || ! respond || ! cancel || ! parent )
							return;
				 
						t.respondId = respondId;
						postId = postId || false;

						if ( ! t.I('wp-temp-form-div') ) {
							div = document.createElement('div');
							div.id = 'wp-temp-form-div';
							div.style.display = 'none';
							respond.parentNode.insertBefore(div, respond);
						}


						comm.parentNode.insertBefore(respond, comm.nextSibling);
						if ( post && postId )
							post.value = postId;
						parent.value = parentId;
						cancel.style.display = '';

						cancel.onclick = function() {
							var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

							if ( ! temp || ! respond )
								return;

							t.I('comment_parent').value = '0';
							temp.parentNode.insertBefore(respond, temp);
							temp.parentNode.removeChild(temp);
							this.style.display = 'none';
							this.onclick = null;
							return false;
						};

						try { t.I('comment').focus(); }
						catch(e) {}

						return false;
					},

					I : function(e) {
						return document.getElementById(e);
					}
				};
			      
			</script>
			{/literal}

			{/if}
		{/if}

		{if isset($smartcustomcss)}
		    <style>
		        {$smartcustomcss}
		    </style>
		{/if}
	</div>

{/block}
