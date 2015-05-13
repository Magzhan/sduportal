<span class="announcements announcement-subject"><?php echo $model['subject']; ?></span>
<p class="announcements announcement-content">
<?php echo $model['content']; ?>
</p>
<span class="announcements announcement-author"><?php echo "by ".$model['name']." ".$model['surname']; ?></span>
<span class="announcements announcement-date">on<?php echo " ".$model['created_at']; ?></span>
<span class="announcements announcement-view-link"><?php echo "URL to View ".$model['id']; ?></span>
<hr/>