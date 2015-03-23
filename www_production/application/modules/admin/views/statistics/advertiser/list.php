 <!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/css/ie9.css"/>
<![endif]-->

<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/css/ie8.css"/>
<![endif]-->

<!--[if IE 7]>
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/css/ie7.css"/>
<![endif]-->


<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.jgrowl.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
   
   				 var date = new Date();
                 var currentMonth = date.getMonth();
                 var currentDate = date.getDate();
                 var currentYear = date.getFullYear();
 
    /**
	 * Date picker
	**/
	jQuery( "#from_date" ).datepicker({
								 minDate:null,
								 maxDate: 0,
								   onSelect: function(selected) {
								   		jQuery("#to_date").datepicker("option","minDate", selected)
        						}
								 
                		 });
	jQuery( "#to_date" ).datepicker({
								minDate:null,
                    			 maxDate: 0,
								 onSelect: function(selected) {
          								jQuery("#from_date").datepicker("option","maxDate", selected)
        						}
                		 });
	
});

function open_toggle(adv_id)
{		
	if(jQuery("#child_row"+adv_id).is(":visible")) {
	jQuery("#child_row"+adv_id).toggle('very slow');
		var imgsrc ='<?php echo base_url("assets/images/icons/toggle_up.jpeg"); ?>';
		jQuery("#test"+adv_id).attr('src', imgsrc);
		jQuery("#child_content_"+adv_id).hide();
	}
	else {
		jQuery("#child_row"+adv_id).toggle('very slow');
		var imgsrc ='<?php echo base_url("assets/images/icons/toggle_down.jpeg"); ?>';
		jQuery("#test"+adv_id).attr('src', imgsrc);
		
		jQuery.post('<?php echo site_url('admin/statistics_advertiser/view_more_details'); ?>', {'advertiser_id': adv_id}, function(response) {
			//document.getElementById("child_conetnt_"+adv_id).innerHTML = response;
			
			jQuery("#child_conetnt_"+adv_id).html(response);			
			jQuery("#child_conetnt_"+adv_id).show();			
	    });
		
	}	  
}

function show_date(selVal){
	if(selVal == "specific_date"){
		jQuery("#specificDataSec").show();
	}
	else
	{
		jQuery("#specificDataSec").hide();
		document.getElementById('search_form').submit();
	}
	
}	

</script>
<div id="statistics_title">
<h1 class="pageTitle"><?php echo $this->lang->line('lang_statistics_advertiser_statistics');?></h1>

<?php
if(!empty($stat_data['stat_list'])){
foreach($stat_data['stat_list'] as $temp){
	$data = $temp;
}


if($data['CLK'] > 0 OR $data['CON'] > 0 OR $data['SPEND'] > 0 OR $data['CTR'] > 0)
{
?>
	<a href="<?php echo site_url('admin/statistics_advertiser/export_advertisers_excel');?>" title="<?php echo $this->lang->line('lang_export_excel_ad_title');?>"><span class="export_excel_link"><?php echo $this->lang->line('label_export_excel'); ?></span></a>
	<?php } 
}
?>

</div>
<br/>		
<br/>	
		<form id="search_form" action="<?php echo site_url("admin/statistics_advertiser/view"); ?>" method="post">
        
        	<div class="form_default">
                <fieldset style="padding:5px;">
                	<div style="width:100%;height:50px;padding-top:10px;">
						<div style="width:65%;height:50px;float:left;vertical-align:bottom;">
							<span style="margin:10px;" ><?php echo $this->lang->line('lang_statistics_advertiser_date');?></span>
							<?php
								$options_arr = array(
												"all"=>$this->lang->line('lang_statistics_all_stats'),
												"today"=>$this->lang->line('lang_statistics_today'),
												"yesterday"=>$this->lang->line('lang_statistics_yesterday'),
												"thisweek"=>$this->lang->line('lang_statistics_this_week'),
												"last7days"=>$this->lang->line('lang_statistics_last_sev_day'),
												"thismonth"=>$this->lang->line('lang_statistics_this_month'),
												"lastmonth"=>$this->lang->line('lang_statistics_last_month'),
												"specific_date"=>$this->lang->line('lang_statistics_spec_date')
											);
							
								$sel_val = (set_value('search_field') != '')?set_value('search_field'):$search_type;
								echo form_dropdown('search_field', $options_arr,$sel_val,"onchange='show_date(this.value)' id='search_field' alt='".$this->lang->line('label_enter_advertiser')."'"); 
							?>
							<?php
								$searchObj = $this->session->userdata('statistics_search_arr');
							?>
							<span id="specificDataSec" style=" <?php echo ($sel_val=="specific_date")?"":"display:none"; ?>" >     
								<?php echo $this->lang->line('lang_statistics_advertiser_from_date');?>
								<input id="from_date" name="from_date" readonly="true" type="text" value="<?php echo date("m/d/Y",strtotime($searchObj['from_date']));  ?>" size="10" width="100" class="width100" /> 
								<?php echo $this->lang->line('lang_statistics_advertiser_to_date');?>
								<input id="to_date"  name="to_date" readonly="true" type="text" value="<?php echo date("m/d/Y",strtotime($searchObj['to_date']));  ?>" size="10" width="100" class="width100" /> 
								<button style='margin-left:10px'><?php echo $this->lang->line('lang_statistics_advertiser_search');?></button>
							</span>
						</div>
							<?php if(count($advertiser_list) > 0 AND $advertiser_list != FALSE): ?>
							<div style="width:34%;height:50px;float:right;vertical-align:bottom;">
							<br/>
							<strong><?php echo $this->lang->line('lang_statistics_advertiser_from_date');?>:</strong> <?php echo date("m/d/Y",strtotime($searchObj['from_date']));  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>
							<?php echo $this->lang->line('lang_statistics_advertiser_to_date');?> :</strong> <?php echo date("m/d/Y",strtotime($searchObj['to_date']));  ?>
							</div>
						   <?php endif; ?>	
					</div>
				</fieldset>
            </div><!--form-->
        </form>
		<?php
			$tot_val	=	$stat_data['tot_val'];
		?>
<table cellpadding="0" cellspacing="0" border="0" class="dyntable" id="adv_stat">
    <thead>
        <tr>
            <th class="head0">&nbsp;</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_site');?></th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_impression');?> (<?php echo $tot_val['IMP']; ?>) </th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_clicks');?> (<?php echo $tot_val['CLK']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_conversions');?> (<?php echo $tot_val['CON']; ?>)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_call');?> (<?php echo $tot_val['CALL']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_web');?> (<?php echo $tot_val['WEB']; ?>)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_map');?> (<?php echo $tot_val['MAP']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_ctr');?> (<?php echo $tot_val['CTR']; ?> %)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_spent');?>  ($<?php echo $tot_val['SPEND']; ?>)</th>
        </tr>
    </thead>
    <colgroup>
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
    	<col class="con0" />
    	<col class="con1" />
    	<col class="con0" />
    	<col class="con1" />
    	<col class="con0" />
    	<col class="con1" />
    	
    </colgroup>
    <tbody>
    	<?php
    	if(count($advertiser_list) > 0 AND $advertiser_list != FALSE):
		
		$stat_list = $stat_data['stat_list'];
		
		
		foreach($advertiser_list as $adv):
		?>
		<tr class="gradeX">
		  <td id="<?php echo $adv->client_id; ?>" align="center"><?php echo (isset($stat_list[$adv->client_id]))?"<a href='javascript:open_toggle(".$adv->client_id.");'><img id='test".$adv->client_id."' src='".base_url("assets/images/icons/toggle_up.jpeg")."'></a>":"&nbsp;"; ?></td>
		  <td>
		  <?php if((isset($stat_list[$adv->client_id]['IMP']) AND $stat_list[$adv->client_id]['IMP'] > 0 ) || (isset($stat_list[$adv->client_id]['CLK']) AND $stat_list[$adv->client_id]['CLK'] > 0) || (isset($stat_list[$adv->client_id]['CON']) AND $stat_list[$adv->client_id]['CON'] > 0 ) ): ?>
		  <a href="javascript: view_reports_date_wise('ADV','<?php echo $adv->client_id; ?>')" ><?php echo view_text($adv->advertiser_name); ?></a>
		  <?php else: ?>
			  <?php echo view_text($adv->advertiser_name); ?>
		  <?php endif; ?>
		  </td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['IMP']:'0'; ?></td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['CLK']:'0'; ?></td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['CON']:'0'; ?></td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['CALL']:'0'; ?></td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['WEB']:'0'; ?></td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['MAP']:'0'; ?></td>
		  <td><?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['CTR']:"0.00";?>%</td>
		  <td>$<?php echo (isset($stat_list[$adv->client_id]))?$stat_list[$adv->client_id]['SPEND']:'0.00';?></td>
		</tr>
		<?php 
		if(isset($stat_list[$adv->client_id])):
		?>
		<tr style="display:none;" id="child_row<?php echo $adv->client_id; ?>" >
		<td colspan="7">
		<div style="text-align:center;" id="child_conetnt_<?php echo $adv->client_id; ?>">
			<img src="<?php echo base_url('assets/images/loaders/loader6.gif'); ?>" alt="" />
		</div>
		</td>
		</tr>
		<?php endif;
		endforeach;
		else:
		?>	
		<tr><td align="center" colspan="7"> <em><strong><?php echo $this->lang->line('lang_statistics_advertiser_not_found');?></strong></em> </td></tr>
		<?php endif; ?>
    </tbody>
    <?php if(count($advertiser_list) > 10 AND $advertiser_list != FALSE): ?>
	<tfoot>
        <tr>
            <th class="head0">&nbsp;</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_site');?></th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_impression');?> (<?php echo $tot_val['IMP']; ?>) </th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_clicks');?> (<?php echo $tot_val['CLK']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_conversions');?> (<?php echo $tot_val['CON']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_call');?> (<?php echo $tot_val['CALL']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_web');?> (<?php echo $tot_val['WEB']; ?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_map');?> (<?php echo $tot_val['MAP']; ?>)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_advertiser_ctr');?> (<?php echo $tot_val['CTR']; ?> %)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_advertiser_spent');?> ($<?php echo $tot_val['SPEND']; ?>)</th>
        </tr>
    </tfoot>
	<?php endif; ?>
</table>
<form name="frmViewDateWise" method="post" id="frmViewDateWise" action="<?php echo site_url('admin/statistics_advertiser/view_date_wise'); ?>">
	<input type="hidden" name="start_date" 	id="start_date" value="<?php echo date("m/d/Y",strtotime($searchObj['from_date']));  ?>" />
	<input type="hidden" name="end_date" 	id="end_date" 	value="<?php echo date("m/d/Y",strtotime($searchObj['to_date']));  ?>" />
	<input type="hidden" name="search_type" id="search_type" value="<?php echo $searchObj['search_type'];  ?>" />
	<input type="hidden" name="parent" 		id="parent"  />
	<input type="hidden" name="ref_id" 		id="ref_id"  />
	
</form>
<script>
	function view_reports_date_wise(ptype,refid){
	
		document.getElementById('parent').value	=	ptype;
		document.getElementById('ref_id').value	=	refid;
		document.getElementById('frmViewDateWise').submit();
	}
</script>    
