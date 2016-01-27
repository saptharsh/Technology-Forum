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
                    
                    <form role="form" method="POST" action="editp.php?topic=<?php echo $MainTopic->id; ?>">				
                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="body">
                                
                                <?php echo $MainTopic->body; ?>
                            </textarea>
                            <script>CKEDITOR.replace('reply');</script>
                        </div>
                        <button name="edit_content" type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default" href="topic.php?id=<?php echo $MainTopic->id; ?>">Cancel</a>
                    </form>
                    
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
                        
                        <!-- CRUD for REPLIES -->
                        <div class="col-md-12">
                            <div class="edit-content pull-left">
                                <?php if (isLoggedIn()) : ?>
                                    <?php if ($_SESSION['username'] == $reply->username) : ?>
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php echo $reply->body; ?>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>    
</ul>

<?php include '../templates/includes/footer.php'; ?>
