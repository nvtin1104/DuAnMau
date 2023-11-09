<?
if (!empty($msg)) {
    echo $msg;
}
?>
<form method="post" action="<?php echo _WEB_ROOT; ?>/home/postUser">
    <div>
        <input name="username" type="text" placeholder="username" value="<?php echo old_data('username','') ?>">
        <?php echo form_error('username', '<span style="color:red;">', '</span>') ?>
    </div>
    <div>
        <input name="age" type="text" placeholder="age" value="<?php echo  old_data('age','') ?>">
        <?php echo form_error('age', '<span style="color:red;">', '</span>') ?>
    </div>
    <div>
        <input name="email" type="text" placeholder="Email" value="<?php  echo old_data('email','') ?>">
        <?php echo form_error('email', '<span style="color:red;">', '</span>') ?>
    </div>
    <div>
        <input name="password" type="password" placeholder="password">
        <?php echo form_error('password', '<span style="color:red;">', '</span>') ?>
    </div>
    <div>
        <input name="cf-password" type="password" placeholder="cf-password">
        <?php echo form_error('cf-password', '<span style="color:red;">', '</span>') ?>
    </div>
    <button type="submit">Submit</button>
</form>