<?php
$votes = get_field("up_down_votes");
if ( "" != $votes ) {
?>
    <div class="badge-circle">
        <div class="badge-text">
            <?php echo $votes; ?>
        </div>
    </div>
<?php
}
