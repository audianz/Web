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
	   <div style="width:44%;float:right;text-align: right;">
         <a href="<?php echo site_url('publisher/messages'); ?>" class="iconlink"><span>Inbox</span></a>
       
	     <a href="<?php echo site_url('publisher/messages/sent_list'); ?>" class="iconlink"><span>Outbox</span></a>
       
	     <a href="<?php echo site_url('publisher/messages/add'); ?>" class="iconlink views"><span><?php echo $this->lang->line("label_suggestions_add_new"); ?></span></a>
       </div>
	   <br /><br />
	<?php  if($this->session->flashdata('message') !=''): ?>
		 <div class="notification msgsuccess"><a class="close"></a><p><?php echo $this->session->flashdata('message'); ?></p></div>		
	<?php endif; ?>
	
		<form id="frmSuggestionsList" action="" method="post" >
    	<table cellpadding="0" cellspacing="0" border="0" class="dyntable" id="camptab">
            <thead>
                <tr>
                <th class="head1" align="center"><?php echo $this->lang->line('label_suggestions_reply_inc'); ?></th>
                <th class="head0"><?php echo "Sent To"?></th>
				<th class="head1"><?php echo $this->lang->line('label_suggestions_reply_subject'); ?></th>
				<th class="head0"><?php echo "Message"; ?></th>
				<th class="head1"><?php echo $this->lang->line('label_suggestions_reply_date'); ?></th>
                    
                </tr>
            </thead>
            <colgroup>
                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
            </colgroup>
          
            <tbody>
        
  			<?php 
					$i=1;
						foreach($rs as $row):
				?>
				<tr>
					<td align="center"><?php echo $i++; ?></td>
					<td><?php echo 'Manger' ?></td>
					<td><?php echo view_text($row->subject); ?></td>
					<td>
						<a href="<?php echo site_url('publisher/messages/sent_view/'.$row->suggestion_id); ?>" class="views">
						<?php echo $this->lang->line("label_suggestions_reply_read"); ?></a> &nbsp;
					</td>

					<td><?php echo date("F d, Y", strtotime($row->suggestion_date)); ?></td>
			    </tr>
  			  <?php	endforeach; ?>
			</tbody>
            </table>
	       
			</form>



			
