{if isset($posts) && !empty($posts)}
<div id="articleRelated">
    <h4 class="title_block">{l s="Related News"  mod="smartblog"}</h4>
    <div class="block-content"> 
        <div class="owl-carousel owl-theme owl-loaded owl-drag" data-autoplay="false" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="3" data-items_tablet="3" data-items_mobile="2">  
            {foreach from=$posts item="post"}
                {assign var="options" value=null}
                {$options.id_post= $post.id_smart_blog_post}
                {$options.slug= $post.link_rewrite}
                <div class="item post-item">
                    <div class="post-image">
                         <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.meta_title}" class="feat_img_small img-fluid" src="{$modules_dir}smartblog/images/{$post.id_smart_blog_post}-home-default.jpg" width="370" height="230"></a>
                    </div>
                    <div class="post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.meta_title}</a></div>
                    <div class="post-info">{$post.created|date_format:"%B %d, %Y"}<span class="time">{$post.created|date_format:"%H:%M:%S"}</span></div>
                    <div class="post-desc">
                        {$post.short_description|escape:'htmlall':'UTF-8'}
                    </div>
                </div> 
            {/foreach}
        </div>
    </div>
</div>
{/if}