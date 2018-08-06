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

<section class="contact-form">
  {if $urls.pages.contact}
  <form action="{$urls.pages.contact}" method="post" {if $contact.allow_file_upload}enctype="multipart/form-data"{/if}>

    {if $notifications}
      <div class="col-xs-12 alert {if $notifications.nw_error}alert-danger{else}alert-success{/if}">
        <ul>
          {foreach $notifications.messages as $notif}
            <li>{$notif}</li>
          {/foreach}
        </ul>
      </div>
    {/if}

    <section class="form-fields">
      {*
      <div class="form-group row">
        <div class="col-md-9 col-md-offset-3">
          <h3>{l s='Contact us' d='Shop.Theme'}</h3>
        </div>
      </div>
      *}
      <div class="form-group row">
        {*<label class="col-md-3 form-control-label">{l s='Email address' d='Shop.Forms.Labels'}</label>*}
        <div class="col-md-6">
          <input
            class="form-control"
            name="name"
            placeholder="{l s='Your name' d='Shop.Forms.Help'}"
          >
        </div>
        <div class="col-md-6">
          <input
            class="form-control"
            name="from"
            type="email"
            value="{$contact.email}"
            placeholder="{l s='Your email' d='Shop.Forms.Help'}"
          >
        </div>
      </div>

      <div class="form-group row">
        {*<label class="col-md-3 form-control-label">{l s='Subject' d='Shop.Forms.Labels'}</label>*}
        <div class="col-md-12">
          <select name="id_contact" class="form-control form-control-select">
            {foreach from=$contact.contacts item=contact_elt}
              <option value="{$contact_elt.id_contact}">{$contact_elt.name}</option>
            {/foreach}
          </select>
        </div>
      </div>


      {if $contact.orders}
        <div class="form-group row">
          {*<label class="col-md-3 form-control-label">{l s='Order reference' d='Shop.Forms.Labels'}</label>*}
          <div class="col-md-12">
            <select name="id_order" class="form-control form-control-select">
              <option value="">{l s='Select reference' d='Shop.Forms.Help'}</option>
              {foreach from=$contact.orders item=order}
                <option value="{$order.id_order}">{$order.reference}</option>
              {/foreach}
            </select>
          </div>
          {*
          <span class="col-md-3 form-control-comment">
            {l s='optional' d='Shop.Forms.Help'}
          </span>
          *}
        </div>
      {/if}

      {if $contact.allow_file_upload}
        <div class="form-group row">
          {*<label class="col-md-3 form-control-label">{l s='Attachment' d='Shop.Forms.Labels'}</label>*}
          <div class="col-md-12">
            <input type="file" name="fileUpload" class="filestyle">
          </div>
        </div>
      {/if}

      <div class="form-group row">
        {*<label class="col-md-3 form-control-label">{l s='Message' d='Shop.Forms.Labels'}</label>*}
        <div class="col-md-12">
          <textarea
            class="form-control"
            name="message"
            placeholder="{l s='Message' d='Shop.Forms.Help'}"
            rows="8"
          >{if $contact.message}{$contact.message}{/if}</textarea>
        </div>
      </div>

    </section>

    <footer class="form-footer d-flex justify-content-end">
      <input class="btn" type="submit" name="submitMessage" value="{l s='Send message' d='Shop.Theme.Actions'}">
    </footer>
  </form>
  {/if}
</section>
