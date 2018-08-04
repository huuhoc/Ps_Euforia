<div id="_desktop_account_content" class="hidden-sm-up">
  {if $logged}
    <div>
      <a class="account" href="{$my_account_url}" title="{l s='View my customer account' d='Modules.Customeraccount'}" rel="nofollow"><i class="fa fa-cog"></i><span>{$customerName}</span></a>
    </div>
    <div>
      <a class="logout"  href="{$logout_url}" rel="nofollow" title="{l s='Log me out' d='Modules.Customeraccount'}"><i class="fa fa-sign-out"></i><span>{l s='Sign out' d='Modules.Customeraccount'}</span></a>
    </div>
  {else}
    <div>
      <a class="login" href="{$my_account_url}" rel="nofollow" title="{l s='Log in to your customer account' d='Modules.Customeraccount'}"><i class="fa fa-cog"></i><span>{l s='My Account' d='Modules.Customeraccount'}</span></a>
    </div>
    <div>
      <a class="login" href="{$my_account_url}" rel="nofollow" title="{l s='Log in to your customer account' d='Modules.Customeraccount'}"><i class="fa fa-sign-in"></i><span>{l s='Sign in' d='Modules.Customeraccount'}</span></a>
    </div>
  {/if}
  <div>
    <a class="register" href="{$my_account_url}" rel="nofollow" title="{l s='Register Account' d='Modules.Customeraccount'}"><i class="fa fa-user"></i><span>{l s='Register Account' d='Modules.Customeraccount'}</span></a>
  </div>
  <div>
    <a class="check-out" href="{$link->getPageLink('order')|escape:'html'}" rel="nofollow" title="{l s='Checkout' d='Modules.Customeraccount'}"><i class="material-icons">check_circle</i><span>{l s='Checkout' d='Modules.Customeraccount'}</span></a>
  </div>

</div>
{if $logged}
  <div>
    <a class="account" href="{$my_account_url}" title="{l s='View my customer account' d='Modules.Customeraccount'}" rel="nofollow"><i class="fa fa-cog"></i><span>{$customerName}</span></a>
  </div>
  <div>
    <a class="logout"  href="{$logout_url}" rel="nofollow" title="{l s='Log me out' d='Modules.Customeraccount'}"><i class="fa fa-sign-out"></i><span>{l s='Sign out' d='Modules.Customeraccount'}</span></a>
  </div>
{else}
  <div>
    <a class="login" href="{$my_account_url}" rel="nofollow" title="{l s='Log in to your customer account' d='Modules.Customeraccount'}"><i class="fa fa-cog"></i><span>{l s='My Account' d='Modules.Customeraccount'}</span></a>
  </div>
  <div>
    <a class="login" href="{$my_account_url}" rel="nofollow" title="{l s='Log in to your customer account' d='Modules.Customeraccount'}"><i class="fa fa-sign-in"></i><span>{l s='Sign in' d='Modules.Customeraccount'}</span></a>
  </div>
{/if}
<div>
  <a class="register" href="{$my_account_url}" rel="nofollow" title="{l s='Register Account' d='Modules.Customeraccount'}"><i class="fa fa-user"></i><span>{l s='Register Account' d='Modules.Customeraccount'}</span></a>
</div>
<div>
  <a class="check-out" href="{$link->getPageLink('order')|escape:'html'}" rel="nofollow" title="{l s='Checkout' d='Modules.Customeraccount'}"><i class="material-icons">check_circle</i><span>{l s='Checkout' d='Modules.Customeraccount'}</span></a>
</div>