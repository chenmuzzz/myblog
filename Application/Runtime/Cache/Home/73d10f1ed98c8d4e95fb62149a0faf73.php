<?php if (!defined('THINK_PATH')) exit();?>
    <div class="pure-u-1 pure-u-md-3-4">
     <div class="content_container">
<?php if(is_array($article)): foreach($article as $key=>$v): ?><div class="post">
          <h2 class="post-title"><a href="javascript:void(0);" data-url="<?php echo U('index/article',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a></h2>
       <div class="post-meta">
        <?php echo (date('y-m-d',$v["created_time"])); ?>
       </div>
       <!--<a data-thread-key="2016/02/25/未到过的远方/" href="" class="ds-thread-count"></a>-->
       <div class="post-content">
        <?php echo ($v["description"]); ?>  &nbsp;....
       </div>
       <p class="readmore"><a href="javascript:void(0);" data-url="<?php echo U('index/article',array('id'=>$v['id']));?>">阅读更多</a></p>
      </div><?php endforeach; endif; ?>
      <nav class="page-navigator">
       <?php echo ($page); ?>
      </nav>
     </div>
    </div>
<script>
    $('.post-title>a').click(function(){
        get_ajax_data($(this));
    })
    $('.readmore>a').click(function(){
        get_ajax_data($(this));
    })
</script>