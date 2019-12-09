<?php session_start(); ?>
<?php include_once("header.php") ?>
<?php include_once("nav.php")?>
<?php
include_once("model/Category.php");
include_once("model/News.php");
include_once("model/Admin.php");

if (!isset($_SESSION["admin"])) {
  header("location:admin_login.php");
}

$lsCategory = Category::getList();
$news = "";

if (isset($_REQUEST["edit"])) {
    $ID = $_REQUEST["edit"];
    $news = News::getNewsByID($ID);
}
?>

<div class="container">
<form action="controller/news_controller.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" required value="<?php echo $news->title?>">
  </div>
  <div class="form-group">
    <label for="subtitle">Subtitle</label>
    <input type="text" name="subtitle" class="form-control" id="subtitle" required value="<?php echo $news->subtitle?>">
  </div>
  <div class="form-group">
    <label for="txtContent">Content</label>
    <textarea class="form-control" name="editor-blog-content" required><?php echo $news->content?></textarea>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <img src="<?php echo $news->image?>">
    <input type="file" class="form-control-file" id="customFile" name="image">
  </div>  
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" name="categoryID" id="category">
    <?php 
        foreach ($lsCategory as $key => $value) {?>
      <option value="<?php echo $value->ID?>" <?php echo ($value->ID==$news->categoryID)? "selected" : ""?>><?php echo $value->name ?></option>      
      <?php }?>
    </select>
  </div>
  <button name="editNews" value="<?php echo $news->ID ?>" type="submit" class="btn btn-create btn-primary mb-5">Chỉnh sửa</button>
</form>
</div>
<?php include_once("footer.php") ?>
<script src="js/blog_cms.js"></script>