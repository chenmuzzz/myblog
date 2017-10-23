<?php if (!defined('THINK_PATH')) exit();?>

    <div class="pure-u-1 pure-u-md-3-4">
     <div class="content_container">
      <div class="post">
       <div class="post-archive" id="list_article">
        <!--Use lodash to classify posts. See https://lodash.com/docs#groupBy-->
        <?php if(!$article_list): ?><h3>暂无该标签的数据</h3>
         <?php else: ?>

            <?php if($cate_name): ?><h3 style="margin-bottem:20px;color: grey">
                    正在查看&nbsp;
                    <span style="color: red;font-size: 25px;font-style: italic"><?php echo ($cate_name); ?></span>&nbsp;
                    下的标签列表</h3><?php endif; ?>

        <?php if(is_array($article_list)): foreach($article_list as $k=>$v): ?><h2><?php echo ($k); ?></h2>
        <ul class="listing">
          <?php if(is_array($v)): foreach($v as $key=>$vv): ?><li class="article_info"><span class="date"><?php echo (date('m-d',$vv["created_time"])); ?></span><a href="javascript:void(0);" title="<?php echo ($vv["title"]); ?>" data-url="<?php echo U('index/article',array('id'=>$vv['id']));?>"><?php echo ($vv["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul><?php endforeach; endif; endif; ?>
       </div>
      </div>
     </div>
    </div>
<script>
    $('.article_info>a').click(function(){
        get_ajax_data($(this));
    })
</script>