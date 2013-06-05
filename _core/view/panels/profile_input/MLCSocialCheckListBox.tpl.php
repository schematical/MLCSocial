<?php foreach($_CONTROL->arrCheckBoxs as $strKey => $chkOpt){ ?>

    <?php echo $chkOpt->Attr('title'); ?>

    <?php $chkOpt->Render(); ?>
<?php } ?>