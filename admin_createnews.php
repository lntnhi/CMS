<?php include_once("header.php") ?>
<?php include_once("nav.php")?>
<?php
include_once("model/Category.php");
$lsCategory = Category::getList();
?>

<div class="container">
<form action="controller/news_controller.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Type title...">
  </div>
  <div class="form-group">
    <label for="subtitle">Subtitle</label>
    <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Type title...">
  </div>
  <div class="form-group">
    <label for="txtContent">Content</label>
    <textarea class="form-control" name="editor-blog-content" required>Content</textarea>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" id="customFile" name="image">
  </div>  
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" name="categoryID" id="category">
    <?php
        foreach ($lsCategory as $key => $value) {?>
      <option value="<?php echo $value->ID?>"><?php echo $value->name ?></option>
      <?php }?>
    </select>
  </div>
  <button name="createNews" type="submit" class="btn btn-create btn-primary mb-5">Tạo mới</button>
</form>
</div>
<?php include_once("footer.php") ?>
<script src="js/blog_cms.js"></script>