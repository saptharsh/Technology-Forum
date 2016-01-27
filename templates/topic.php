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
                                    <a class="confirm btn btn-default" id="posts" data-postid="<?php echo $topicId; ?>">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </a>

                                    <script type="text/javascript">
                                        var data = $('#posts').data('postid');
                                        
                                        $(".confirm").confirm({
                                            text: "Are you sure you want to delete this Post?",
                                            title: "Confirmation required",
                                            confirm: function (button) {

                                                $.ajax({
                                                        type: "POST",
                                                        url: "<?php echo BASE_URI; ?>/deletep.php",
                                                        data: {
                                                            postid: data
                                                        },
                                                        success: function () {
                                                            window.location.href = "https://localhost:444/PHPApps/Forum/"
                                                        }
                                                    });

                                                    // Checking
                                                    console.log("Deleting Post id: " + data);
                                            },
                                            cancel: function (button) {
                                                // nothing to do
                                            },
                                            confirmButton: "Yes",
                                            cancelButton: "No",
                                            post: true,
                                            confirmButtonClass: "btn-danger",
                                            cancelButtonClass: "btn-default",
                                            dialogClass: "modal-dialog" // Bootstrap classes for large modal
                                        });
                                    </script>

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
        <li class="topic">
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
                                        <a class="btn btn-default" href="editr.php?reply=<?php echo $reply->id; ?>&topic=<?php echo $topicId; ?>">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        <a class="confirm btn btn-default" id="replies" data-replyid="<?php echo $reply->id; ?>">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>

                                        <script type="text/javascript">
                                            var data = $('#replies').data('replyid');

                                            $(".confirm").confirm({
                                                text: "Are you sure you want to delete your comment?",
                                                title: "Confirmation required",
                                                confirm: function (button) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?php echo BASE_URI; ?>/deleter.php",
                                                        data: {
                                                            replyid: $('#replies').data('replyid')
                                                        },
                                                        success: function () {
                                                            window.location.reload(true);
                                                        }
                                                    });

                                                    // Checking
                                                    console.log("Deleting reply id: " + data);
                                                },
                                                cancel: function (button) {
                                                    // nothing to do
                                                },
                                                confirmButton: "Yes",
                                                cancelButton: "No",
                                                post: true,
                                                confirmButtonClass: "btn-danger",
                                                cancelButtonClass: "btn-default",
                                                dialogClass: "modal-dialog" // Bootstrap classes for large modal
                                            });
                                        </script>

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


<h3>Reply To Topic</h3>
<?php if (isLoggedIn()) : ?>
    <form role="form" method="POST" action="topic.php?id=<?php echo $MainTopic->id; ?>">				
        <div class="form-group">
            <textarea id="reply" rows="10" cols="80" class="form-control" name="body"></textarea>
            <script>CKEDITOR.replace('reply');</script>
        </div>
        <button name="do_reply" type="submit" class="btn btn-default">Submit</button>
    </form>
<?php else : ?>
    <p style="margin: 10px; color: #0066cc; font-style: italic">Please Login to Reply!!</p>
<?php endif; ?>
<?php include '../templates/includes/footer.php'; ?>
