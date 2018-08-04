{if isset($posts) AND !empty($posts)}
<div class="block block-recentpost">
   <div class="block_content sdsbox-content">
      <div class="recentArticles">
        {foreach from=$posts item="post"}
             {assign var="options" value=null}
             {$options.id_post= $post.id_smart_blog_post}
             {$options.slug= $post.link_rewrite}
             <div class="post-item">
                {*
                <a class="image" title="{$post.meta_title}" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">
                   <img class="img-fluid" alt="{$post.meta_title}" src="{$modules_dir}/smartblog/images/{$post.post_img}-home-small.jpg">
                </a>
                *}
                <a class="post-title"  title="{$post.meta_title}" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.meta_title}</a>
                <div class="post-info">{$post.created|date_format:"%B %d, %Y"}<span class="time">{$post.created|date_format:"%H:%M:%S"}</span></div>
                <div class="post-description">{$post.short_description}</div>
                <div class="readmore"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{l s='Read more' mod='smartblogrecentposts'}</a></div>
             </div>
         {/foreach}
      </div>
   </div>
</div>
{/if}