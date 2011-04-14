<html>
<head>
  <title><?php echo $title; ?> - <?php echo $subtitle; ?></title>
</head>

<body>
<?php echo heading($title, 1); ?>
<?php echo heading($description, 4); ?>

<div><?php echo img("images/output.jpg"); ?></div>
<?php echo form_open('deadrising/generate'); ?>
  <div><?php echo form_input($form_input_data); ?></div>
  <div><?php echo form_submit('submit', '嘆く'); ?></div>
</form>

</body>
</html>
