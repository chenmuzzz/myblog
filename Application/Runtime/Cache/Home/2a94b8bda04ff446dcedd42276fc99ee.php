<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="description" content="沉木" />
    <title> | 沉木</title>
    <link rel="stylesheet" type="text/css" href="/oa/Public/Home/about/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/oa/Public/Home/about/pure-min.css" />
    <link rel="stylesheet" type="text/css" href="/oa/Public/Home/about/grids-responsive-min.css" />
    <link rel="stylesheet" type="text/css" href="/oa/Public/Home/about/style.css" />
    <link rel="stylesheet" href="/oa/Public/Home/about/font-awesome.min.css" />
    <!--<link rel="Shortcut Icon" type="image/x-icon" href="http://shinksun.github.io/favicon.ico" />-->
    <!--<link rel="apple-touch-icon" href="http://shinksun.github.io/apple-touch-icon.png" />-->
    <!--<link rel="apple-touch-icon-precomposed" href="http://shinksun.github.io/apple-touch-icon.png" />-->
    <!--<link rel="alternate" type="application/atom+xml" href="http://shinksun.github.io/atom.xml" />-->
    <style>
        .hwh-page-info a{color: #CCC;}.hwh-page-info a em{font-style: normal;margin: 0 2px;}
        .red{color:red}
        .pure-u-md-3-4{width:100%}
    </style>
</head>
<body>
<div class="body_container">
    <div id="header">
        <div class="site-name">
            <h1 class="hidden">沉木</h1>
            <a id="logo" href="javascript:void(0);">沉木</a>
            <p class="description">生命的意义当然是暴富</p>
        </div>
        <div id="nav-menu">
            <a href="javascript:void(0);" data-url="<?php echo U('index/index');?>" id="index" class="current"><i class="fa fa-home"> 首页</i></a>
            <a href="javascript:void(0);" data-url="<?php echo U('index/article_list');?>" id="article_list"><i class="fa fa-archive"> 归档</i></a>
            <a href="javascript:void(0);" data-url="<?php echo U('index/about');?>" id="about"><i class="fa fa-user"> 关于</i></a>
            <a href="javascript:void(0);" data-url="<?php echo U('index/contact');?>" id="contact"><i class="fa fa-user"> 联系我 </i></a>
        </div>
    </div>



<div id="layout" class="pure-g">

    <div id="public_div" style="min-width:73.7%;">
            <div class="pure-u-1 pure-u-md-3-4">
             <div class="content_container" >
                <?php if(is_array($article)): foreach($article as $key=>$v): ?><div class="post">
                       <h2 class="post-title"><a href="javascript:void(0);" data-url="<?php echo U('index/article',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a></h2>
                       <div class="post-meta">
                        <?php echo (date('y-m-d',$v["created_time"])); ?>
                       </div>
                          <!--评论-->
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
    </div>


    <div class="pure-u-1-4">
        <div id="sidebar">
            <!--搜索-->
            <div class="widget">
                <form action="http://www.baidu.com/baidu" method="get" accept-charset="utf-8" target="_blank" class="search-form">
                    <input type="search" name="word" maxlength="20" placeholder="Search" class="search-form-input" />
                    <input type="hidden" name="si" value="127.0.0.1/oa" />
                    <input name="tn" type="hidden" value="bds" />
                    <input name="cl" type="hidden" value="3" />
                    <input name="ct" type="hidden" value="2097152" />
                    <input name="s" type="hidden" value="on" />
                </form>
            </div>

            <!--<div class="widget">-->
                <!--<div class="widget-title">-->
                    <!--<i class="fa fa-folder-o"> 分类</i>-->
                <!--</div>-->

            <!--</div>-->
            <div class="widget">
                <div class="widget-title">
                    <i class="fa fa-star-o"> 标签</i>
                </div>
                <div class="tagcloud">
                    <?php if(is_array($cate_res)): foreach($cate_res as $key=>$v): ?><a href="javascript:void(0);" style="font-size: 15px;" ><span class="tags" data-url="<?php echo U('index/article_list',array('cate_id'=>$v['id'],'cate_name'=>$v['cate_name']));?>" > <?php echo ($v["cate_name"]); ?></span></a><?php endforeach; endif; ?>
                </div>
            </div>
            <div class="widget">
                <div class="widget-title">
                    <i class="fa fa-file-o"> 最新文章</i>
                </div>
                <ul class="post-list">
                    <li class="post-list-item"><a class="post-list-link" href="javascript:void(0);" data-url="<?php echo U('index/article',array('id'=>$new_article['id']));?>"><?php echo ($new_article["title"]); ?></a></li>
                </ul>
            </div>
            <!--<div class="widget">-->
                <!--<div class="comments-title">-->
                    <!--<i class="fa fa-comment-o"> 最近评论</i>-->
                <!--</div>-->
                <!--<div data-num-items="5" data-show-avatars="0" data-show-time="1" data-show-admin="0" data-excerpt-length="32" data-show-title="1" class="ds-recent-comments"></div>-->
            <!--</div>-->
            <div class="widget">
                <div class="widget-title">
                    <i class="fa fa-external-link"> 友情链接</i>
                </div>
                <ul></ul>
                <a href="https://weibo.com/2020450797/profile?rightmod=1&wvr=6&mod=personinfo&is_all=1" title="myblog" target="_blank">新浪主页</a>
            </div>
        </div>
    </div>
</div>

    <div id="footer">
        &copy;
        <a href="##" rel="nofollow">沉木.</a> Powered by
        <a rel="nofollow" target="_blank" href="javascript:void(0);"> Zxf.</a>
        <!--a(rel='nofollow', target='_blank', href='https://github.com/tufu9441/maupassant-hexo')  Theme-->
        <!--|  by-->
        <!--a(rel='nofollow', target='_blank', href='https://github.com/pagecho')  Cho.-->
    </div>
    <a id="rocket" href="127.0.0.1/0a#top" class="show"></a>
    <script type="text/javascript" src="/oa/Public/Home/about/jquery.min.js"></script>
    <script type="text/javascript" src="/oa/Public/Home/about/totop.js"></script>
    <script>

        //        $(function(){
        //            if(document.URL.indexOf('a=index')>0){
        //                $('#index').addClass('current');
        //            }
        //            if(document.URL.indexOf('a=article_list')>0){
        //                $('#article_list').addClass('current');
        //            }
        //            if(document.URL.indexOf('a=about')>0){
        //                $('#about').addClass('current');
        //            }
        //            if(document.URL.indexOf('a=contact')>0){
        //                $('#contact').addClass('current');
        //            }
        //        })

        //when click tags/category
        $('.tags').click(function(){
            if($('#article_list').attr('class') != 'current'){
                $('#nav-menu>a').removeClass('current');
                $('#article_list').addClass('current');
            }
            $(this).parents('a').siblings().find('span').removeClass('red');
            $(this).addClass('red');
            get_ajax_data($(this));
        })

        $('.post-list-link').click(function(){
            get_ajax_data($(this));
        })

        $('#nav-menu>a').click(function(){
            change_menu_color($(this));
            get_ajax_data($(this));

        })
        $('.post-title>a').click(function(){
            get_ajax_data($(this));
        })
        $('.readmore>a').click(function(){
            get_ajax_data($(this));
        })

        function get_ajax_data(obj){
            var url=obj.attr('data-url');
            $.ajax({
                type:'GET',
                url:url,
                data:{'ajax':'ajax'},
                success:function(msg){
                    $('#public_div').html(msg);
                }
            })
        }
        //when click menu, change it's style
        function change_menu_color(obj){
            if(obj.attr('class') != 'current'){
                obj.addClass('current');
                obj.siblings('a').removeClass('current');
            }
        }
    </script>


</div>
</body>
</html>