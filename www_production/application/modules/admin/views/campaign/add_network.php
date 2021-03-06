
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.jgrowl.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom/elements.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/form_validation/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.css" type="text/css"/>

	<script type="text/javascript">
	
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#edit_network").validationEngine();
	
	});

	var ar = JSON.parse( '<?php echo json_encode($list); ?>' );
		
   	function Numericcheck(field, rules, i, options)
	{
		var reg 		= /^[-]?[0-9\.]+$/;
		var value	=		field.val();
		if(!reg.test(value))
			{
				return "<?php echo $this->lang->line('lang_inventory_websites_add_inor-idonly_numbers'); ?>";
			}
		
	}
	function Decimalcheck(field, rules, i, options)
	{
		var number = field.val();
		 var decimal= /^[0-9]+\.[0-9]{2}$/;
		 var str=number.split('.');
			if(typeof(str[1]) != "undefined" && str[1] !== null)
			{
				var len=str[1];
				var len_1=len.length;
				if(len_1 > 2)
				{	
					if ((!decimal.test(number)))
					{
						return '<?php echo "Cannot have more than 2 decimals." ?>'; 
					}
				}
			}
	}
	
   </script>
   <script>
		function goToList()
		{
			window.location.href="<?php echo base_url();?>index.php/admin/camp_optimisation";
		}

		function check_total(id,val)
		{
			var total =0;
			for (i = 0; i < ar.length; i++) 
			{ 
				if(ar[i]['Mix_id']!=id)
				{
					total= +total +  +ar[i]['Mix_percent'];
				}
				
			}
			var new_total=+total + +val;
			if(new_total > 100)
			jAlert('<?php echo "Total mix percent can not be greater than 100." ?>','<?php echo "Manage Optimisation Mix"; ?>');
		}
  </script>
		<form id="edit_network" name="edit_network" action="<?php echo site_url('admin/camp_optimisation/network_add_process'); ?>" method="post" >
		<h1 class="pageTitle"><?php echo "Add Network" ?></h1>
		        <div class="form_default">
		        <fieldset>
		            <legend><?php echo "Enter Network Details"; ?></legend>
		            
		            <p>
		                <label ><?php echo "Network Type"; ?><span style="color:red;">*</span></label>
		                <input type="text" name="type"  id="type" value="<?php echo $network[0]->Network_type; ?>" class="validate[required] sf" alt="<?php echo "Please Enter Network type"; ?>" value="<?php echo $beacon_info[0]->Beacon_UUID; ?>"  />
		                
		            </p> 
		            
		             
		            <p>
		                <label ><?php echo "Network"; ?><span style="color:red;">*</span></label>
		                <input type="text" name="network"  id="network" value="<?php echo $network[0]->Network; ?>" class="validate[required] sf" alt="<?php echo "Please Enter Network"; ?>" value="<?php echo $beacon_info[0]->Customer_ID; ?>" />
		                
		            </p> 
		              
			 <p>
		                <label ><?php echo "Mix Percentage (%)";?><span style="color:red;">*</span></label>
		                <input type="text" name="mix_percent"  id="mix_percent" class="validate[required] sf" onblur="check_total('<?php echo $network[0]->Mix_id; ?>',this.value)"  value="<?php echo $network[0]->Mix_percent; ?>" alt="<?php echo 'Please Enter Mix Percentage For Network'; ?>"  />
		                
		            </p>

			 <p>
		                <label ><?php echo "CPM Rate ($) "; ?><span style="color:red;">*</span></label>
		                <input type="text" name="cpm_rate"  id="cpm_rate" class="validate[required] sf"  value="<?php echo $network[0]->cpm_rate; ?>" alt="<?php echo "Please Enter CPM Rate For Network"; ?>"  />
		                
		            </p>
		             
		             
		            <p>
		                <button ><?php echo $this->lang->line('label_submit'); ?></button>
		                <button type="button" style="margin-left:10px;" onclick="javascript: goToList();" ><?php echo $this->lang->line('label_cancel'); ?></button>
		            </p>
		
		        </fieldset>
		    </div><!--form-->
		    </form>
		
		
	
