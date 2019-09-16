<?php if(!empty($chart)){ foreach($chart as $row){ ?>
    <tr>
        <td><?php echo $row['comment_name']; ?></td>
        <td><?php echo $row['comment_content']; ?></td>
        <td><img alt="Alexa's Avatar" src="<?php echo base_url();?>assets/images/avatars/avatar1.png" /></td>
        <td>
            <button class="btn btn-xs btn-success reply" type="button" id="<?php echo $row['id'];?>">Reply</button>
        </td>
    </tr>
<?php } }else{ ?>
    <tr><td colspan="7">No message(s) found...</td></tr>
<?php } ?>