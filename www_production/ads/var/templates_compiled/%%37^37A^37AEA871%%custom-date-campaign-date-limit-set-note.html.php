<?php /* Smarty version 2.6.18, created on 2013-05-13 18:36:31
         compiled from /var/www/ads/lib/templates/admin/form/custom-date-campaign-date-limit-set-note.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't', '/var/www/ads/lib/templates/admin/form/custom-date-campaign-date-limit-set-note.html', 29, false),)), $this); ?>

<span class="link" help="help-date-disabled"><span class="icon icon-info"><?php echo OA_Admin_Template::_function_t(array('str' => 'WhyDisabled'), $this);?>
</span></span>
<div class="hide" id="help-date-disabled" style="height: auto; width: 290px;">
    <?php echo OA_Admin_Template::_function_t(array('str' => 'CannotSetBothDateAndLimit'), $this);?>

</div>