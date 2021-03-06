<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#camptab').dataTable( {
                /*"sSortColumn": "1",*/
                "bSort": false,
				/*"aaSorting": [],*/
                "sPaginationType": "full_numbers"
	});

});
</script>
  	 <!-- Display page title dymically. page_title content must be initialized corresponding controller. -->
	 <?php if($page_title != ''): ?><h1 class="pageTitle"><?php echo $page_title; ?></h1><?php endif; ?>   
     
	<?php  if($this->session->flashdata('message') !=''): ?>
		 <div class="notification msgsuccess"><a class="close"></a><p><?php echo $this->session->flashdata('message'); ?></p></div>		
	<?php endif; ?>
	
		<form id="frmSuggestionsList" action="" method="post">
		<table cellpadding="0" cellspacing="0" border="0" class="dyntable" id="camptab">
    	<thead>
                <tr>
                <th class="head1" align="center"><?php echo $this->lang->line('label_suggestions_reply_inc'); ?></th>
                <th class="head0"><?php echo $this->lang->line('label_suggestions_reply_sender'); ?></th>
				<th class="head1"><?php echo $this->lang->line('label_suggestions_reply_subject'); ?></th>
				<th class="head0"><?php echo $this->lang->line('label_suggestions_reply_date'); ?></th>
				<th class="head1"><?php echo $this->lang->line('label_action'); ?></th>
				</tr>
            </thead>
            
            <colgroup>
					<col class="con0" width="5%" />
                    <col class="con1" width="20%" />
					<col class="con0" width="50%" />
					<col class="con1" width="15%" />
					<col class="con0" width="10%" />
            </colgroup>

              <tbody>

              <?php 
						$i=1;
						foreach($rs as $row):
						if($row->type =='ADVERTISER') { $client	=$this->mod_suggestions->get_advertiser_info($row->suggestion_sender); $sender	=@$client[0]->clientname; }
						else if($row->type =='TRAFFICKER') { $client =$this->mod_suggestions->get_publisher_info($row->suggestion_sender); $sender	=@$client[0]->contact; }
						else { $sender	='MANAGER'; }
				?>
				<tr>
					<td align="center"><?php echo $i++; ?></td>
					<td><?php echo $sender; ?></td>
					<td><?php echo view_text($row->subject); ?></td>
					<td><?php echo date("F d, Y", strtotime($row->suggestion_date)); ?></td>
					<td align="center"><a href="<?php echo site_url('admin/messages/view/'.$row->suggestion_id); ?>" class="views">
					<?php echo $this->lang->line("label_suggestions_reply_read"); ?></a> &nbsp;
					<?php $chk =$this->mod_suggestions->get_reply_status($row->suggestion_id); if($chk ==0) : ?>
					 <a href="<?php echo site_url('admin/messages/reply/'.$row->suggestion_id); ?>" class="views"><?php echo $this->lang->line("label_suggestions_reply_reply"); ?></a>
					 <?php endif; ?>
					 </td>	
			  </tr>
  			  <?php	endforeach;  ?>
			</tbody>
           </table>
		</form>


			 
