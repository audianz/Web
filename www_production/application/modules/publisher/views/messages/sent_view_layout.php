<style>
.noborder {
    border: 1px solid #666666 !important;
    -moz-box-shadow: 0px 0px 0px rgba(0, 0, 0, .0) !important;
    -webkit-box-shadow: 0px 0px 0px rgba(0, 0, 0, .0) !important;
    box-shadow: 0px 0px 0px rgba(0, 0, 0, .0) !important;
    border-radius: 0px 0px 0px 0px !important;
    background: none !important;
}
</style>

<?php if(count($rs) > 0 && $rs !=''): ?>
<?php foreach($rs as $row) : ?>
  <div class="form_default">
    <h4 id="popup_title"><?php echo "Sent Message" #echo $this->lang->line('label_suggestions_message_from'); ?> : <?php #echo $admin_email; ?></h4><br />
	<div id="popup_message" style="padding-left:10px; min-height:200px !important; word-wrap:break-word !important;"><strong><u><?php echo $row->subject; ?></u></strong> :<br /><br /><textarea class="noborder" style="padding-left:10px; height:250px !important; width:95% !important; overflow:scroll-y !important; word-wrap:break-word !important;" readonly="readonly"><?php echo $row->content; ?></textarea></div>
  </div>

<?php endforeach; endif; ?>
<p align="center">
	<a id="close" class="iconlink" href="#">
		<span>Cancel</span>
	</a>
</p>
<script type="text/javascript">
		jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#close").click(function(){
			jQuery.colorbox.close();
		});

		jQuery.colorbox.resize({width:"50%", height:"80%", scrolling: false}); //, fixed: true, rel :'iframe'});
		//cboxLoadedContent
		jQuery("#cboxClose").remove();
		
		jQuery("#reply").click(function(){
			var reply_data	=jQuery('#reply_url').val();
			//jQuery.colorbox.close();

			jQuery.colorbox({width:"50%", height:"82%", href:reply_data});
			
		});
});
</script>
