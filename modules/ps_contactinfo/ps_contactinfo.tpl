{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="block-contact">
  <div class="logo-footer">
    <img src="{$img_dir}/logo-footer.png" alt="logo footer" title="Logo" />
  </div>
  {*
  <div class="title_block">{l s='Store information' d='Modules.Contactinfo'}</div>
  {$contact_infos.address.formatted nofilter}
  *}
  {if $contact_infos.address.address1}
  <div class="address d-flex">
    <i class="fa fa-home"></i>
    <div>
    {l
      s='Address: [1]%address1%[/1]'
      sprintf=[
        '[1]' => '<span>',
        '[/1]' => '</span>',
        '%address1%' => $contact_infos.address.address1
      ]
      d='Modules.Contactinfo'
    }
    </div>
  </div>
  {/if}
  {if $contact_infos.address.address2}
  <div class="address d-flex">
    <i class="fa fa-home"></i>
    <div>
    {l
      s='Address: [1]%address2%[/1]'
      sprintf=[
        '[1]' => '<span>',
        '[/1]' => '</span>',
        '%address2%' => $contact_infos.address.address2
      ]
      d='Modules.Contactinfo'
    }
    </div>
  </div>
  {/if}
  {if $contact_infos.email}
  <div class="email d-flex">
    <i class="fa fa-envelope"></i>
    <div>
    {* [1][/1] is for a HTML tag. *}
    {l
      s='Email: [1]%email%[/1]'
      sprintf=[
        '[1]' => '<span>',
        '[/1]' => '</span>',
        '%email%' => $contact_infos.email
      ]
      d='Modules.Contactinfo'
    }
    </div>
  </div>
  {/if}
  {if $contact_infos.phone}
  <div class="phone d-flex">
    <i class="fa fa-phone"></i>
    <div>
    {* [1][/1] is for a HTML tag. *}
    {l s='Hotline: [1]%phone%[/1]'
      sprintf=[
      '[1]' => '<span>',
      '[/1]' => '</span>',
      '%phone%' => $contact_infos.phone
      ]
      d='Modules.Contactinfo'
    }
    </div>
  </div>
  {/if}
  {if $contact_infos.fax}
  <div class="fax d-flex">
    <i class="fa fa-fax"></i>
    {* [1][/1] is for a HTML tag. *}
    <div>
    {l
      s='Fax: [1]%fax%[/1]'
      sprintf=[
        '[1]' => '<span>',
        '[/1]' => '</span>',
        '%fax%' => $contact_infos.fax
      ]
      d='Modules.Contactinfo'
    }
    </div>
  </div>
  {/if}

</div>