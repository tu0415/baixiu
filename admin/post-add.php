<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './INC/navbar.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include_once './INC/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
<script>
  /*
    需求1
      选择图片之后
        ajax上传
        实现图片预览
    需求2
      页面打开之后
        通过ajax 获取分类信息
          渲染到页面上即可
    需求3
      点击保存
        阻止默认行为 调用接口 新增文章

  */
  $(function(){
    // 需求1
    $("#feature").change(function(){
      // formData
      var formData = new FormData();
      // append 加多一组 发送给服务器的 键值对
      // console.log(this.files);
      // console.log(this.files[0]);
      formData.append('preview',this.files[0]);

      $.ajax({
        url:'http://www.baixiu_my.com/admin/API/06.imgPreview.php',
        data:formData,
        type:'post',
        processData:false,//不自动格式化数据
        contentType:false,//不自动设置请求头,
        success:function(backData){
          console.log(backData);
          $('.help-block').attr('src',backData).show();
        }
      })
    })
  
    // 需求2
    // 页面一打开 就干掉
    // $("#category").empty();
    $.ajax({
      url:"http://www.baixiu_my.com/admin/API/01.getAllCategories.php",
      // data:,
      // type:,
      success:function(backData){
        // console.log(backData);
        // 因为默认有两个 干掉他们
       

        for(var i =0;i<backData.length;i++){

          var $opt = $('<option value="'+backData[i].id+'">'+backData[i].name+'</option>');

          // 添加到 select
          $("#category").append($opt);

        }
      }
    })
  
    // 需求3
    $('form button.btn-primary').click(function(event){
      event.preventDefault();

      // ajax新增即可
      // form表单中
      // 自动格式化form表单中的数据
      var sendData = new FormData(document.querySelector('form'));
      $.ajax({
        url:'http://www.baixiu_my.com/admin/API/07.insertPost.php',
        data:sendData,
        type:'post',
        processData:false,// 不格式化数据
        contentType:false,// 不设置请求头
        success:function(backData){
          console.log(backData);
        }
      })
    })
  })
</script>
