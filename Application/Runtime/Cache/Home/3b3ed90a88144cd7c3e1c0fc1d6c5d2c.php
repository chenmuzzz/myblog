<?php if (!defined('THINK_PATH')) exit();?>

        <!--Use lodash to classify posts. See https://lodash.com/docs#groupBy-->
        <?php if(!$article_list): ?><h3>暂无该标签的数据</h3>
         <?php else: ?>

        <?php if(is_array($article_list)): foreach($article_list as $k=>$v): ?><h2><?php echo ($k); ?></h2>
        <ul class="listing">
          <?php if(is_array($v)): foreach($v as $key=>$vv): ?><li><span class="date"><?php echo (date('m-d',$vv["created_time"])); ?></span><a href="<?php echo U('index/article',array('id'=>$vv['id']));?>" title="<?php echo ($vv["title"]); ?>"><?php echo ($vv["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul><?php endforeach; endif; endif; ?>