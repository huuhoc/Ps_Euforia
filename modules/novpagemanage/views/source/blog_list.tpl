{if isset($blogs) AND !empty($blogs)}
<div class="nov-blog col-lg-{$columns} col-md-{$columns}{if isset($class) && $class} {$class}{/if}">
    <div class="block">
        {if isset($show_title) && $show_title == 1 && isset($title) && !empty($title)}
           <div class="title_block">
                {if isset($sub_title) && !empty($sub_title)}
                    <span class="sub_title">{$sub_title nofilter}</span>
                {/if}
                {$title nofilter}
           </div>
        {/if}
        {if $list_style == 'type_slider'}
            <div class="novblog-box-content owl-carousel owl-theme owl-loaded owl-drag" data-autoplay="false" data-autoplaytimeout="6000" data-loop="true" data-margin="{$spacing_item}" data-dots="{if $show_dots == '1'}true{else}false{/if}" data-nav="{if $show_nav == '1'}true{else}false{/if}" data-items="{$colspage}" data-items_tablet="{$column_tablet}" data-items_mobile="{$column_mobile}">
                {assign var='i' value=1}
                {foreach from=$blogs item=post}
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <div class="item post-item">
                        {if $show_thumb == 1}
                        <div class="post-image">
                             <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img_small img-fluid" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default.jpg" width="370" height="230"></a>
                        </div>
                        {/if}
                        <div class="post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a></div>
                        <div class="post-info">{$post.date_added|date_format:"%B %d, %Y"}<span class="time">{$post.date_added|date_format:"%H:%M:%S"}</span></div>
                        <div class="post-desc">
                            {$post.short_description|strip_tags:'UTF-8'|truncate:$number_desc:'...'}
                        </div>
                        <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}" class="read_more">{l s='Read More' mod='smartbloghomelatestnews'}</a>
                    </div>
                    {$i=$i+1}
                {/foreach}
            </div>
        {/if}
    </div>
</div>
{/if}