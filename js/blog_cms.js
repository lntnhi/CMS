console.log("huhu");
CKEDITOR.config.filebrowserBrowseUrl = '/cms/ckfinder/ckfinder.html';
CKEDITOR.config.filebrowserImageBrowseUrl = '/cms/ckfinder/ckfinder.html?type=Images';
CKEDITOR.config.filebrowserFlashBrowseUrl = '/cms/ckfinder/ckfinder.html?type=Flash';
CKEDITOR.config.filebrowserUploadUrl = '/cms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
CKEDITOR.config.filebrowserImageUploadUrl = '/cms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
CKEDITOR.config.filebrowserFlashUploadUrl = '/cms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

CKEDITOR.replace( 'editor-blog-content', {
	height: 400 // height này tùy ý thích, nó định nghĩa chiều cao cho khung soạn thảo
});
