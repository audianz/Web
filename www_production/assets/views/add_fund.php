<script>
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#add_fund_form").validationEngine();
	});
function Numericcheck(field, rules, i, options)
		{
			var reg 		= /^[-]?[0-9\.]+$/;
			var value	=		field.val();
			if(!reg.test(value))
				{
					return "<?php echo $this->lang->line('lang_inventory_websites_add_only_numbers'); ?>";
				}
			
			}
			
function goToList(){	
	document.location.href= '<?php echo site_url('advertiser/payments'); ?>';
}			
   
</script>
<h1 class="pageTitle"><?php echo $this->lang->line('lang_add_fund');?></h1>
<form id="add_fund_form" action="<?php echo site_url('advertiser/payments/add_fund_process'); ?>" method="post">

<div class="form_default">
    <fieldset>
	 <legend><?php echo $this->lang->line('lang_add_fund');?></legend>
	<?php if ($this->session->userdata('error_fund') != '')
					{
						?><div class="notification msgerror"><a class="close"></a>
						<?php echo $this->session->userdata('error_fund');
						$this->session->unset_userdata('error_fund');?>
						</div><?php
					 }?>
	
	
    <p>
        <label for="name"><?php echo $this->lang->line('lang_publisher_option_amount');?></label>
        <input type="text" name="amount"  id="amount" class="validate[required,funcCall[Numericcheck],min[1]] sf" alt="<?php echo $this->lang->line('label_enter_fund_amount'); ?>" />
    </p>
    <p>
        <button><?php echo $this->lang->line('label_submit');?></button>
        <button type="button" style="margin-left:10px;" onclick="javascript: goToList();">Cancel</button>
    </p>
    </fieldset>
</div><!--form-->


</form>
