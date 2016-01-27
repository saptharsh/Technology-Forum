<?php include '../templates/includes/header.php'; ?>
<ul id="topics">
    <li id="main-topic" class="topic topic">
        <div class="row">
            <div class="col-md-2">
                <div class="user-info">
                    <img class="avatar pull-left" src="images/avatars/<?php echo $MainTopic->avatar; ?>" />
                    <ul>
                        <li><strong><?php echo $MainTopic->username; ?></strong></li>
                        <li><?php echo userPostCount($MainTopic->user_id); ?> Posts</li>
                        <li>
                            <a href="<?php echo BASE_URI; ?>topics.php?user=<?php echo $MainTopic->user_id; ?>">View topics</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="topic-content pull-right">

                    <!-- CRUD for POSTS -->
                    <div class="col-md-12">
                        <div class="edit-content pull-left">
                            <?php if (isLoggedIn()) : ?>
                                <?php if ($_SESSION['username'] == $MainTopic->username) : ?>
                                    <a class="btn btn-default" href="editp.php?topic=<?php echo $topicId; ?>">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <a class="btn btn-default" href="deletep.php?topic=<?php echo $topicId; ?>">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php echo $MainTopic->body; ?>
                </div>
            </div>
        </div>
    </li>


    <?php foreach ($replies as $reply) : ?>
        <li class="topic topic">
            <div class="row">
                <div class="col-md-2">
                    <div class="user-info">
                        <img class="avatar pull-left" src="images/avatars/<?php echo $reply->avatar; ?>" />
                        <ul>
                            <li><strong><?php echo $reply->username; ?></strong></li>
                            <li><?php echo userPostCount($reply->user_id); ?> Posts</li>
                            <li><a href="<?php echo BASE_URI; ?>topics.php?user=<?php echo $reply->user_id; ?>">View Topics</a>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="topic-content pull-right">

                        <?php if ($reply->id == $_GET['reply']) : ?>
                            <form role="form" method="POST" action="editr.php?reply=<?php echo $replyId; ?>&topic=<?php echo $topicId; ?>">				
                                <div class="form-group">
                                    <textarea id="reply" rows="10" cols="80" class="form-control" name="body">
                                        <?php //echo $_GET['reply'] . $reply->id; ?>
                                        <?php echo $reply->body; ?>
                                    </textarea>
                                    <script>CKEDITOR.replace('reply');</script>
                                </div>
                                <button name="edit_reply" type="submit" class="btn btn-default">Submit</button>
                            </form>
                        <?php else : ?>
                            <?php echo $reply->body; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>    
</ul>

<?php include '../templates/includes/footer.php'; ?>
