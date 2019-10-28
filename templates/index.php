<!DOCTYPE html>
<html lang="en">
<head>
  <?php include __DIR__ . '/partial/head.php' ?>
</head>
<body>

<div class="head">
    <h2 class="text-center"><b>記事本</b></h2>
</div>
<br>

<div class="container">
    <div class="content">
        <div class="word"><b>標題</b></div>
        <div class="pull-right">
            <div class="btn btn-primary word" data-toggle="modal" data-target="#addContent">新增</div>
        </div>
    </div>
    <hr>

    <?php  foreach($pageContent as $value): ?>
    <div class="content">
        <div onclick="showContent('<?= $value['title'] ?>','<?= $value['content'] ?>')" 
        data-toggle="modal" data-target="#showContent">
          <?= $value['title'] ?>
        </div>
        <div class="pull-right">
            <div class="btn btn-warning" data-toggle="modal" data-target="#updateContent" 
            onclick="updateContent(<?= $value['id'] ?>, '<?= $value['title'] ?>', '<?= $value['content'] ?>')">修改</div>
            <div class="btn btn-danger" onclick="deleteContent(<?= $value['id'] ?>)">刪除</div>
        </div>
        <hr>
    </div>
    <?php endforeach ?>

</div>

<!-- addContent -->
<div class="modal fade" id="addContent" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>新增標題和內容:</b></h4>
      </div>
      <div class="modal-body">
        <form action="<?= $app->urlFor("HomePost") ?>" method="post" id="addForm">
            <div class="form-group">
                <label for="addTitle">標題:</label><br>
                <input type="text" class="form-control" name="addTitle" id="addTitle">
            </div>
            <div class="form-group">
                <label for="addContent">內容:</label><br>
                <textarea class="form-control" rows="7"  cols="70" name="addContent" style="resize:none;" id="addContent"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="add">新增</button>
      </div>
    </div>
  </div>
</div>

<!-- showContent -->
<div class="modal fade" id="showContent" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div id="showContentBody"></div>
      </div>
    </div>
  </div>
</div>

<!-- updateContent -->
<div class="modal fade" id="updateContent" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>修改標題和內容:</b></h4>
      </div>
      <div class="modal-body">
        <form action="<?= $app->urlFor("HomePost") ?>" method="post" id="updateForm">
            <div class="form-group">
                <label for="updateTitle">標題:</label><br>
                <input type="text" class="form-control" name="updateTitle" id="updateTitle">
            </div>
            <div class="form-group">
                <label for="updateContent">內容:</label><br>
                <textarea class="form-control" rows="7"  cols="70" name="updateData" 
                style="resize:none;" id="updateData"></textarea>
            </div>
            <input type="hidden" name="updateId" id="updateId">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="update">修改</button>
      </div>
    </div>
  </div>
</div>

<script>
$("#add").click(function(){
  $("#addForm").submit();
});
$("#update").click(function(){
  $("#updateForm").submit();
});
function showContent(title, content){
    $("#showContentBody").html("<h4 class='text-center'><b>"+title+"</b></h4>" + "<p>"+content+"</p>");
}
function updateContent(id, title, content){
    $("#updateId").val(id);
    $("#updateTitle").val(title);
    $("#updateData").val(content);
}
function deleteContent(id){
    $.post("<?= $app->urlFor("HomePost") ?>",{deleteId : id},function(){
        location.href = "<?= $app->urlFor("ShowHome") ?>";
        alert("刪除成功");
    });
}
</script>

</body>
</html>
