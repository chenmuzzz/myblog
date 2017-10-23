<?php if (!defined('THINK_PATH')) exit();?>
    <div class="pure-u-1 pure-u-md-3-4">
     <div class="content_container">
      <div class="post" style="max-width:709px">
       <h1 class="post-title"><?php echo ($res["title"]); ?></h1>
       <div class="post-meta">
        <?php echo (date('y-m-d',$res["created_time"])); ?>
        <!--<script src="/oa/Public/Home/about/c.min.js" async=""></script>-->
        <span id="busuanzi_container_page_pv" style="display: inline;"> | <span id="busuanzi_value_page_pv"><?php echo ($res["views"]); ?></span><span> Hits</span></span>
       </div>
       <!--<a data-thread-key="2016/02/25/極月至陽/" href="http://shinksun.github.io/2016/02/25/%E6%A5%B5%E6%9C%88%E8%87%B3%E9%99%BD/#comments" class="ds-thread-count"></a>-->
       <div class="post-content" style="min-height:200px;">
        <?php echo ($res["content"]); ?>
       </div>
       <a data-url="" data-id="" class="article-share-link">分享到</a>
       <div class="tags">
        <a id='article_tag' href="javascript:void(0);" data-url="<?php echo U('index/article_list',array('cate_id'=>$res['cate_id'],'cate_name'=>$res['cate_name']));?>"><?php echo ($res["cate_name"]); ?></a>
       </div>

       <div class="post-nav">
           <?php if($prev_res["id"] != 0): ?><a href="javascript:void(0);" data-url="<?php echo U('index/article',array('id'=>$prev_res['id']));?>" class="pre next-article" style="max-width: 40%;overflow:hidden;text-overflow:ellipsis;"><?php echo ($prev_res["title"]); ?></a>
               <?php else: ?>
               <a href="javascript:void(0);" class="pre"><?php echo ($prev_res["title"]); ?></a><?php endif; ?>

           <?php if($next_res["id"] != 0): ?><a href="javascript:void(0);" data-url="<?php echo U('index/article',array('id'=>$next_res['id']));?>" class="next next-article" style="max-width: 40%;overflow:hidden;text-overflow:ellipsis;"><?php echo ($next_res["title"]); ?></a>
            <?php else: ?>
               <a href="javascript:void(0);" class="next"><?php echo ($next_res["title"]); ?></a><?php endif; ?>
       </div>
       <!--<div data-thread-key="2016/02/25/極月至陽/" data-title="極月至陽" data-url="http://shinksun.github.io/2016/02/25/極月至陽/" class="ds-share flat" >-->
        <div class="ds-share-inline">
         <ul class="ds-share-icons-16">
          <li data-toggle="ds-share-icons-more"><a href="javascript:void(0);" class="ds-more">分享到：</a></li>
          <!--<li><a href="javascript:void(0);" data-service="weibo" class="ds-weibo">微博</a></li>-->
          <!--<li><a href="javascript:void(0);" data-service="qzone" class="ds-qzone">QQ空间</a></li>-->
          <!--<li><a href="javascript:void(0);" data-service="qqt" class="ds-qqt">腾讯微博</a></li>-->
          <li><a href="javascript:void(0);" data-service="wechat" class="ds-wechat">微信</a></li>
         </ul>
         <div class="ds-share-icons-more"></div>
        </div>
       </div>
       <!--<div data-thread-key="2016/02/25/極月至陽/" data-title="極月至陽" data-url="http://shinksun.github.io/2016/02/25/極月至陽/" data-author-key="1" class="ds-thread"></div>-->
      </div>
     </div>
    </div>
    <script>
        $('#article_tag,.next-article').click(function(){
            get_ajax_data($(this));
        })
    </script>