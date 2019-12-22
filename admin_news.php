<?php session_start(); ?>
<?php include_once("header.php") ?>
<?php include_once("nav.php") ?>

<?php
include_once("model/Category.php");
include_once("model/News.php");
include_once("model/Admin.php");

if (!isset($_SESSION["admin"])) {
  header("location:admin_login.php");
}

$admin = unserialize($_SESSION["admin"]);
$lsCategory = Category::getList();

if (isset($_REQUEST["del"])) {
  $ID = $_REQUEST["del"]; 
  News::delete($ID);
}

if (isset($_REQUEST["categoryid"])) {
  $categoryID = $_REQUEST["categoryid"]; 
  $lsNews = News::getListByCategoryAdmin($admin->username, $categoryID);
} else {
  $keyWord = null;
  if (strpos($_SERVER['REQUEST_URI'], "search")) {
      $keyWord = $_REQUEST['search'];      
  }
  $lsNews = News::getListAdmin($admin->username, $keyWord);
} 
/**
 * HTML
 */
?>
<div class="container pt-5">
  <a href="admin_createnews.php" class="btn btn-outline-info float-right"><i class="fas fa-plus-circle"></i> Thêm</a>
  <form action="" method="GET">
    <div class="form-group">
      <input class="form-control" name="search" value="<?php echo $_REQUEST["search"] ?? ""; ?>" style="max-width: 200px; display:inline-block;" placeholder="Search">
      <button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
    </div>
  </form>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Subtitle</th>
        <th scope="col">Image</th>
        <th scope="col">Created Time</th>
        <th scope="col">Category</th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($lsNews as $key => $value) {?>
        <tr>
          <th scope="row"><?php echo $value->ID ?></th>
          <td><a href="detail.php?ID=<?php echo $value->ID?>"><?php echo $value->title ?></a></td>
          <td><?php echo $value->subtitle ?></td>
          <td><img src="<?php echo $value->image ?>" alt="image" width="80" height="80"></td>
          <td><?php echo $value->createdTime ?></td>
          <td>
            <?php $category = Category::getCategoryByID($value->categoryID);
            echo $category->name ?></td>
          <td class="d-flex">
            <a href="admin_editnews.php?edit=<?php echo $value->ID ?>" class="btn btn-outline-info mr-3"><i class="far fa-edit"></i> Sửa</a>
            <button class="btn btn-outline-danger" name="delete" data-toggle="modal" data-target="#deleteItem<?php echo $key ?>"><i class="fas fa-trash-alt"></i> Xóa</button>
            <!--Delete-->
            <form action="" method="DELETE">
              <div class="modal fade" id="deleteItem<?php echo $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Do you want to delete this?</div>
                    <div class="modal-footer">
                      <button class="btn btn-danger" name="del" type="submit" value="<?php echo $value->ID ?>">Delete</button>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </form> <!--end Delete-->
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<?php include_once("footer.php") ?>