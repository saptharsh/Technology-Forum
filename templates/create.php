<?php include '../templates/includes/header.php'; ?>
<form role="form" method="POST" action="create.php" >
    <div class="form-group">
        <label>Topic Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
    </div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category">
            
            <?php foreach (getCategories() as $category) : ?>
            <option value="<?php echo htmlentities($category->id); ?>"><?php echo htmlentities($category->name); ?></option>
            <?php endforeach; ?>                            
            
        </select>
    </div>
    <div class="form-group">
        <label>Topic Body</label>
        <textarea id="bod" rows="10" cols="80" class="form-control" name="body"></textarea>
        <!-- name of the <textarea> where we want to add -->
        <script>CKEDITOR.replace('body');</script>
    </div>
    <button name="do_create" type="submit" class="btn btn-default">Submit</button>
</form>
<?php include '../templates/includes/footer.php'; ?>
