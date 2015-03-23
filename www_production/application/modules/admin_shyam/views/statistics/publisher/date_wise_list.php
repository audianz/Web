
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
		
		jQuery.post('<?php echo site_url('admin/statistics_publisher/view_more_details'); ?>', {'advertiser_id': adv_id}, function(response) {
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

<?php
$searchObj = $this->session->userdata('statistics_search_arr');
?>
</script>
<div id="statistics_title">
<h1 class="pageTitle"><?php echo $this->lang->line('lang_statistics_publisher_statistics');?></h1>
<?php
$data=$stat_data['stat_list'];
if(!empty($data))
{
?>
<a href="<?php echo site_url('admin/statistics_publisher/export_publisher_date_wise');?>" title="<?php echo $this->lang->line('lang_export_excel_pub_title_as_date_wise');?>"><span class="export_excel_link"><?php echo $this->lang->line('label_export_excel'); ?></span></a>
<?php } ?>
</div>
<br/>		
<br/>

		<form id="search_form" action="<?php echo site_url("admin/statistics_publisher/view"); ?>" method="post">
        
        	<div class="form_default">
                <fieldset style="padding:5px;">
                	<div style="width:100%;height:50px;padding-top:10px;">
						<div style="width:65%;height:50px;float:left;vertical-align:bottom;">
							<span style="margin:10px;" ><?php echo $this->lang->line('lang_statistics_publisher_date');?></span>
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
							
								$sel_val = (set_value('search_field') != '')?set_value('search_field'):$this->input->post('search_field');
								echo form_dropdown('search_field', $options_arr,$sel_val,"onchange='show_date(this.value)' id='search_field' alt='".$this->lang->line('label_enter_advertiser')."'"); 
							?>
							<?php
								$searchObj = $this->session->userdata('statistics_search_arr');
							?>
							<span id="specificDataSec" style=" <?php echo ($sel_val=="specific_date")?"":"display:none"; ?>" >     
								<?php echo $this->lang->line('lang_statistics_publisher_from_date');?>
								<input id="from_date" name="from_date" readonly="true" type="text" value="<?php echo date("m/d/Y",strtotime($searchObj['from_date']));  ?>" size="10" width="100" class="width100" /> 
								<?php echo $this->lang->line('lang_statistics_publisher_to_date');?>
								<input id="to_date"  name="to_date" readonly="true" type="text" value="<?php echo date("m/d/Y",strtotime($searchObj['to_date']));  ?>" size="10" width="100" class="width100" /> 
								<button style='margin-left:10px'><?php echo $this->lang->line('label_search16');?></button>
							</span>
						</div>
						<div style="width:34%;height:50px;float:right;vertical-align:bottom;">
						<strong><?php echo $this->lang->line('lang_statistics_publisherss_site');?> :</strong> 
							<?php echo  ucfirst($stat_adv_det); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
							<?php if(isset($stat_zone_data)): ?>
							<strong><?php //echo $this->lang->line('lang_statistics_publisher_zones_name');?> </strong> <?php //echo ucfirst($stat_zone_data); ?>
							<?php endif; ?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<br/>
						<strong><?php echo $this->lang->line('lang_statistics_publisher_from_date');?>:</strong> <?php echo date("m/d/Y",strtotime($searchObj['from_date']));  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>
							<?php echo $this->lang->line('lang_statistics_publisher_to_date');?> :</strong> <?php echo date("m/d/Y",strtotime($searchObj['to_date']));  ?>
							</div>
					</div>
				</fieldset>
            </div><!--form-->
        </form>
		
<table cellpadding="0" cellspacing="0" border="0" class="dyntable" id="adv_stat">
    <thead>
        <tr>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_date');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_impression');?> (<?php echo $stat_data['tot_val']['IMP'];?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_clicks');?> (<?php echo $stat_data['tot_val']['CLK'];?>)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_conversions');?> (<?php echo $stat_data['tot_val']['CON'];?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_call');?> (<?php echo $stat_data['tot_val']['CALL'];?>)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_web');?> (<?php echo $stat_data['tot_val']['WEB'];?>)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_map');?> (<?php echo $stat_data['tot_val']['MAP'];?>)</th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_ctr');?> (<?php echo number_format($stat_data['tot_val']['CTR'],2,".",","); ?>%)</th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_revenue');?> ($<?php echo number_format($stat_data['tot_val']['SPEND'],2,".",","); ?>)</th>
			<th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_share');?> ($<?php echo number_format($stat_data['tot_val']['PUBSHARE'],2,".",","); ?>)</th>
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
    	if(count($stat_data['stat_list']) > 0):
		foreach($stat_data['stat_list'] as $date_key=>$objStat):
		?>
		<tr class="gradeX">
		  <td>
		 <?php if((isset($objStat['IMP']) AND $objStat['IMP'] > 0 ) || (isset($objStat['CLK']) AND $objStat['CLK'] > 0) || (isset($objStat['CON']) AND $objStat['CON'] > 0 ) ): ?>
													<a href="javascript: view_reports_hour_wise('<?php echo $date_key; ?>');" ><?php echo $date_key; ?></a>
		  <?php else: ?>
			  <?php echo $date_key; ?>
		  <?php endif; ?>
		 </td>
		  <td><?php echo $objStat['IMP']; ?></td>
		  <td><?php echo $objStat['CLK']; ?></td>
		  <td><?php echo $objStat['CON']; ?></td>
		  <td><?php echo $objStat['CALL']; ?></td>
		  <td><?php echo $objStat['WEB']; ?></td>
		  <td><?php echo $objStat['MAP']; ?></td>
		  <td><?php echo $objStat['CTR']; ?>%</td>
		  <td>$<?php echo $objStat['SPEND']; ?></td>
		  <td>$<?php echo $objStat['PUBSHARE']; ?></td>
		</tr>
		<?php
		endforeach;
		else:
		?>	
		<tr><td align="center" colspan="7"> <em><strong><?php echo $this->lang->line('lang_statistics_advertiser_rec_not');?></strong></em> </td></tr>
		<?php endif; ?>
    </tbody>
<?php
if(count($data)>10)
{
?>
    <tfoot>
        <tr>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_date');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_impression');?></th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_clicks');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_conversions');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_call');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_web');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_map');?></th>
            <th class="head0"><?php echo $this->lang->line('lang_statistics_publisher_ctr');?></th>
            <th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_revenue');?></th>
			<th class="head1"><?php echo $this->lang->line('lang_statistics_publisher_share');?></th>
        </tr>
    </tfoot>
<?php
}
?>
</table>
<form name="frmViewDateWise" method="post" id="frmViewDateWise" action="<?php echo site_url('admin/statistics_publisher/view_hour_wise'); ?>">
	<input type="hidden" name="start_date" 	id="start_date" value="<?php echo date("m/d/Y",strtotime($searchObj['from_date']));  ?>" />
	<input type="hidden" name="sel_date" 	id="sel_date" />
	<input type="hidden" name="end_date" 	id="end_date" 	value="<?php echo date("m/d/Y",strtotime($searchObj['to_date']));  ?>" />
	<input type="hidden" name="search_type" id="search_type" value="<?php echo $searchObj['search_type'];  ?>" />
	<input type="hidden" name="parent" 		id="parent"  value="<?php echo $searchObj['parent']; ?>"/>
	<input type="hidden" name="ref_id" 		id="ref_id"  value="<?php echo $searchObj['sel_publisher_id']; ?>" />
	<input type="hidden" name="zone_id" 	id="zone_id"  value="<?php echo $searchObj['sel_zone_id']; ?>" />
	
</form>
<script>
	function view_reports_hour_wise(sel_date){
	
		document.getElementById('sel_date').value	=	sel_date;
		document.getElementById('frmViewDateWise').submit();
	}
</script>    
