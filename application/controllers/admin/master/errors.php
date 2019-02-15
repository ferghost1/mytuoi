<?= validation_errors()?>

            <?php if(isset($error)):?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endif;?>
            <?php if(isset($noti_success)):?>
                <div class="alert alert-success"><?=$noti_success?></div>
            <?php endif;?>            
