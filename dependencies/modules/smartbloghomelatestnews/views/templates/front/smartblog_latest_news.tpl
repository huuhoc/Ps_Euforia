<div class="block">
    <div class="novblog-box-content owl-carousel owl-theme owl-loaded owl-drag" data-autoplay="false" data-autoplaytimeout="6000" data-loop="true" data-margin="30" data-dots="true" data-nav="false" data-items="3">             
        {if isset($view_data) AND !empty($view_data)}
            {assign var='i' value=1}
            {foreach from=$view_data item=post}
               
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <div class="item post-item">
                        <div class="post-image">
                             <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img_small img-fluid" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default.jpg" width="370" height="230"></a>
                        </div>
                        <div class="post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a></div>
                        <div class="post-info">{$post.date_added|date_format:"%B %d, %Y"}<span class="time">{$post.date_added|date_format:"%H:%M:%S"}</span></div>
                        <div class="post-desc">
                            {$post.short_description|escape:'htmlall':'UTF-8'}
                        </div>
                        <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}" class="read_more">{l s='Read More' mod='smartbloghomelatestnews'}</a>
                    </div>
                
                {$i=$i+1}
            {/foreach}
        {/if}
    </div>
</div>