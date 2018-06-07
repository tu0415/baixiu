<!DOCTYPE html>

<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
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
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/
                <strong>slug</strong>
              </p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
              <!-- button 默认的 type 就是submit -->
              <button class="btn btn-success" type="button" style="display:none">取消</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action" style="height:30px">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40">
                  <input type="checkbox">
                </th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include_once './INC/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- 导入模板引擎 -->
  <script src="../assets/vendors/art-template/template-web.js"></script>
  <!-- 定义模板 -->
  <script type="text/html" id="cateTem">
    {{each}}
      <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td>{{$value.name}}</td>
        <td>{{$value.slug}}</td>
        <td class="text-center">
          <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
          <a href="javascript:;" deleteid="{{$value.id}}" class="btn btn-danger btn-xs">删除</a>
        </td>
      </tr>
    {{/each}}
  </script>
</body>

</html>
<script>
  /*
    需求1
      页面打开 通过ajax 获取分类信息 添加到页面上
        数据回来之后
          使用模板引擎渲染页面
            导入模板引擎
            定义模板
            挖坑
            起名字
            填坑
            使用
    需求2
      点击添加按钮
        通过ajax 把新增的数据发动到服务器
    需求3
      点击删除
        使用ajax 告诉服务器 我们需要删除的数据
    需求4
      4.1点击编辑按钮 进入编辑状态
      4.2点击取消按钮 还原为默认的状态

    需求5
      1.点击全选 让 tbody中的checkbox的 选中状态 跟自己一样即可
      2.点击tbody中的 checkbox  判断选中的个数 跟总个数 是否一致 一致勾选 全选按钮 反之 取消勾选即可

    需求6
      点击批量删除
        ajax 删除数据
          删除成功之后
            重新获取数据 getData()
  */
  $(function () {
    // 抽取的需求1
    function getData() {
      $.ajax({
        url: 'http://www.baixiu_my.com/admin/API/01.getAllCategories.php',
        // type:,
        // data:,
        success: function (backData) {
          console.log(backData);
          var result = template('cateTem', backData);
          // console.log(result);
          $('tbody').html(result);
        }
      })
    }


    // 需求1
    getData();


    // 需求2
    $('form button.btn-primary').click(function (event) {
      // 写哪里都可以
      event.preventDefault();

      // 调用接口 调用接口2
      if ($(this).html() == '添加') {
        $.ajax({
          url: "http://www.baixiu_my.com/admin/API/02.insertCategory.php",
          type: 'post',
          data: {
            slug: $("#slug").val(),
            name: $("#name").val()
          },
          success: function (backData) {
            // console.log(backData);
            // 新增成功之后 服务器的数据更改了
            // 但是页面中的数据是第一次ajax获取到的 并没有重新获取
            // 解决方法1 刷新页面 low
            // window.location.reload();
            // 解决方法2 重新调用ajax 获取数据即可
            getData();
          }
        })

      }
      else{
        // 如果是保存 调用接口4
        var editId = $(this).attr('editId');
        var slug = $('#slug').val();
        var name = $('#name').val();
        $.ajax({
          url:'http://www.baixiu_my.com/admin/API/04.updateCategory.php',
          data:{
            id:editId,
            slug:slug,
            name:name,
          },
          type:'post',
          success:function(backData){
            // console.log(backData);
            // 重新获取数据
            getData();
            // 人为的调用一次 取消按钮的点击事件
            $('form .btn-success').click();
          }
        })
      }
      

      // 只能写在最后面哦
      // return false;
    })

    // 需求3
    // 调用时 会为页面存在的 a标签绑定点击事件
    // 页面中后来显示的tr 都是通过 ajax 动态增加上去的 默认不存在 这个时候使用 jQ的事件委托即可
    // $('tbody a.btn-danger').click(function(){
    $('tbody').on('click', 'a.btn-danger', function () {
      // console.log('你点我啦');
      var deleteId = $(this).attr('deleteId');
      $.ajax({
        url: 'http://www.baixiu_my.com/admin/API/03.deleteCategory.php',
        data: {
          id: deleteId
        },
        // type:,
        success: function (backData) {
          console.log(backData);
          // 调用函数 重新获取数据即可
          getData();
        }
      })
    })

    // 需求4.1
    $('tbody').on('click', 'a.btn-info', function () {
      // 获取名称
      var name = $(this).parent().siblings().eq(1).html();
      // 获取别名
      var slug = $(this).parent().siblings().eq(2).html();
      // id
      var id = $(this).next().attr('deleteId');

      // 设置给左边的区域
      $('form h2').html('编辑分类');
      $('#name').val(name);
      $('#slug').val(slug);
      $('form button.btn-primary').html('保存');
      $('form button.btn-primary').attr('editId', id);
      $('form button.btn-success').show();
    })

    // 需求4.2
    $('form button.btn-success').click(function () {
      // 还原给左边的区域
      $('form h2').html('添加新分类目录');
      $('#name').val('');
      $('#slug').val('');
      $('form button.btn-primary').html('添加');
      $('form button.btn-primary').attr('editId', '');
      $('form button.btn-success').hide();
    })

    // 需求5.1
    $('thead input[type=checkbox]').click(function(){
      // 获取自己的选中状态
      var thisChecked = $(this).prop('checked');

      // 设置给tbody中的checkbox
      $('tbody input[type=checkbox]').prop('checked',thisChecked);

      // 显示隐藏 批量删除
      if(thisChecked==true){
        $('.page-action a').fadeIn();
      }else{
        $('.page-action a').fadeOut();
      }
    })

    // 需求5.2
    $('tbody').on('click','input[type=checkbox]',function(){
      // 总个数
      var totalNum =  $('tbody input[type=checkbox]').length;
      // 选中个数
      var checkedNum =  $('tbody input[type=checkbox]:checked').length;

      // 设置 顶部的选中状态
      $('thead input[type=checkbox]').prop('checked',totalNum==checkedNum);

      if(checkedNum!=0){
        $('.page-action a').fadeIn();
      }else{
        $('.page-action a').fadeOut();
      }
    })

    // 需求6
    // on click
    $('.page-action a').click(function(){
      // 获取 被选中的 那些id
      // checkbox                               
      var $checkedAs = $('tbody input[type=checkbox]:checked');
      // 定义变量
      var ids = '';
      // each 是jq提供的循环方法 传入一个回调函数 参数分别是 索引 dom元素
      $('tbody input[type=checkbox]:checked').each(function(i,e){
        // e去获取他的兄弟
        //         td     td们       最后一个 儿子们 最后一个a
        var id = $(e).parent().siblings().last().children().last().attr('deleteid');
        // console.log(id);
        // id 评级为 id1,id2,id3
        ids+=id;
        // 如果是最后一个那么不需要拼接,即可
        if(i!=$checkedAs.length-1){
          ids+=',';
        }
      })
      // 循环完毕之后 拼接完成了吗
      // console.log(ids);
      //  ids = ids.slice(0,-1);
      //  console.log(ids);
      
      $.ajax({
        url:'http://www.baixiu_my.com/admin/API/05.deleteCategories.php',
        data:{
          ids:ids //id1,id2,id3...
        },
        // type:,
        success:function(backData){
          console.log(backData);
          getData();
          // 藏起来 批量删除按钮
          $('.page-action a').hide();
        }
      })
    });
  })


</script>