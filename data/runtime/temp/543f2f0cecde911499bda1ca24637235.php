<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:30:"./template/pc/view_product.htm";i:1589880040;s:57:"D:\phpStudy\PHPTutorial\WWW\dongji\template\pc\header.htm";i:1589427060;s:58:"D:\phpStudy\PHPTutorial\WWW\dongji\template\pc\nav-nei.htm";i:1589880072;s:57:"D:\phpStudy\PHPTutorial\WWW\dongji\template\pc\footer.htm";i:1591346064;}*/ ?>
<!DOCTYPE html>
<html>
<!-- 提交压缩包记得要恢复，浏览时记得删除 -->
<meta http-equiv="x-ua-compatible" content="ie=Edge,Chrome=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">
<title><?php echo $eyou['field']['seo_title']; ?></title>
<meta name="description" content="<?php echo $eyou['field']['seo_description']; ?>"/>
<meta name="keywords" content="<?php echo $eyou['field']['seo_keywords']; ?>"/>
<link href="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmspath"); echo $__VALUE__; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
>
<?php  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/bootstrap.min.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/common.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/animate.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/css.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/media.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/foot.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/dongji/base.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/dongji/index.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/css/dongji/swiper.min.css","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/jquery-1.11.3.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/slick.min.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/common.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/wow.min.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/jquery.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/dongji/swiper.min.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/dongji/jquery1.42.min.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/dongji/jquery.SuperSlide.2.1.3.js","","",""); echo $__VALUE__; ?>
<!--[if lt IE 9]>
<?php  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/html5shiv.min.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/respond.min.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/selectivizr-min.js","","",""); echo $__VALUE__; ?>
<![endif]-->

</head>
<body>
<div id="over"
     style="display: hidden;position: fixed;top: 0;left: 0;width: 100%;height: 100%;background-color: #f5f5f5;opacity:1.0;z-index: 1000;"></div>
<div id="layout"
     style="display: hidden;position: absolute;top: 40%;left: 40%;width: 20%;height: 20%;z-index: 1001;text-align:center;">
    <img src="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/load.gif" alt=""/></div>
<?php  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/loading.js","","",""); echo $__VALUE__; ?>
<div id="wrap_top">
    <div id="model-body">
          <div class="top">
        <div class="w">
            <div class="top-text"><a href=""><?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:4:"hygw";}'); echo $__VALUE__; ?></a></div>
            <div class="languages">
                <?php  $tagLanguage = new \think\template\taglib\eyou\TagLanguage; $_result = $tagLanguage->getLanguage("list", "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["title"] = text_msubstr($field["title"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <img src="<?php echo $field['logo']; ?>" alt="<?php echo $field['title']; ?>"/>
                <a href="<?php echo $field['url']; ?>"><?php echo $field['title']; ?></a>
                <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="tit">
        <div class="logos"><a href="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmsurl"); echo $__VALUE__; ?>"><img src="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_logo"); echo $__VALUE__; ?>" alt="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_name"); echo $__VALUE__; ?>"/></a></div>
          <?php  $tagSearchform = new \think\template\taglib\eyou\TagSearchform; $_result = $tagSearchform->getSearchform("","","","","","default"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
         <form method="get" action="<?php echo $field['action']; ?>">
           <?php echo $field['hidden']; ?>
            <input type="text" name="keywords"  class="p" placeholder="<?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:4:"sys7";}'); echo $__VALUE__; ?>"/>
            <input type="submit" class="t" value=" "/>
        </form>
         <?php ++$e; endforeach;endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> 
    </div>


 
        <div id="quickbar-wrap" class="page-active">
            <div class="model_wrapper">
               <div class="nav">
    <div class="w">
        <ul>
            <li class="<?php if(\think\Request::instance()->param('m') == 'Index'): ?>active<?php endif; ?>"><a href="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmsurl"); echo $__VALUE__; ?>" title="<?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:4:"sys1";}'); echo $__VALUE__; ?>"><?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:4:"sys1";}'); echo $__VALUE__; ?></a></li>
            <?php  if(isset($ui_typeid) && !empty($ui_typeid)) : $typeid = $ui_typeid; else: $typeid = ""; endif; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  if(isset($ui_row) && !empty($ui_row)) : $row = $ui_row; else: $row = 8; endif; $tagChannel = new \think\template\taglib\eyou\TagChannel; $_result = $tagChannel->getChannel($typeid, "top", "active", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["typename"] = text_msubstr($field["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li class="<?php echo $field['currentstyle']; ?>"><a href='<?php echo $field['typeurl']; ?>'><?php echo $field['typename']; ?></a>
                <?php if(!(empty($field['children']) || (($field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator ) && $field['children']->isEmpty()))): ?>
                <div class="dropdown">
                    <?php  if(isset($ui_typeid) && !empty($ui_typeid)) : $typeid = $ui_typeid; else: $typeid = ""; endif; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  if(isset($ui_row) && !empty($ui_row)) : $row = $ui_row; else: $row = 10; endif;if(is_array($field['children']) || $field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator): $i = 0; $e = 1;$__LIST__ = is_array($field['children']) ? array_slice($field['children'],0,10, true) : $field['children']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field2): $field2["typename"] = text_msubstr($field2["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field2;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <a href="<?php echo $field2['typeurl']; ?>"><?php echo $field2['typename']; ?></a>
                    <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field2 = []; ?>
                </div>
                <?php endif; ?>
            </li>
            <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
        </ul>
    </div>
</div>
<!--banner图开始-->
<div class="banner">
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php  $tagAdv = new \think\template\taglib\eyou\TagAdv; $_result = $tagAdv->getAdv(7, "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$__LIST__ = is_array($_result) ? array_slice($_result,0, 10, true) : $_result->slice(0, 10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field):  if ($i == 0) : $field["currentstyle"] = ""; else:  $field["currentstyle"] = ""; endif;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <div class="swiper-slide"><a href='<?php echo $field['links']; ?>' <?php echo $field['target']; ?>><img src='<?php echo $field['litpic']; ?>' alt='<?php echo $field['title']; ?>'/></a></div>
            <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>


        </div>
        <!-- Add Pagination -->
       <!-- <div class="swiper-pagination"></div> -->
        <!-- Add Arrows -->
        <!--<div class="swiper-button-next"></div>-->
        <!--<div class="swiper-button-prev"></div>-->
    </div>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            paginationClickable: true,
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: 2500,
            autoplayDisableOnInteraction: false
        });


    </script>
</div>
<!--banner图结束-->

                <div class="model_contant model_leftright">
                    <!-- 手机内页分类下拉 -->
                    <div class="model-classify visible-xs">
                        <div class="model-classify-posnav"><?php echo gettoptype($eyou['field']['typeid'],'typename'); ?> <span
                                class="model-classify-btn transition">分类<i><img
                                src="<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/icon12.png"></i></span></div>
                        <div class="model-classify-nav">
                            <ul class="one">
                                <?php  if(isset($ui_typeid) && !empty($ui_typeid)) : $typeid = $ui_typeid; else: $typeid = ""; endif; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  if(isset($ui_row) && !empty($ui_row)) : $row = $ui_row; else: $row = 100; endif; $tagChannel = new \think\template\taglib\eyou\TagChannel; $_result = $tagChannel->getChannel($typeid, "first", "ez", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["typename"] = text_msubstr($field["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                                <li class="o_li"><a href="<?php echo $field['typeurl']; ?>"
                                                    class="one_a transition <?php echo $field['currentstyle']; ?>"> <?php if(!(empty($field['children']) || (($field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator ) && $field['children']->isEmpty()))): ?><i class="transition"></i><?php endif; ?> <?php echo $field['typename']; ?></a>
                                    <?php if(!(empty($field['children']) || (($field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator ) && $field['children']->isEmpty()))): ?>
                                    <ul class="second">
                                        <li class="e_li"><a class="er_a transition" href="<?php echo $field2['typeurl']; ?>"><?php echo $field2['typename']; ?><i
                                                class="visible-xs"></i> </a></li>
                                    </ul>
                                    <?php endif; ?>
                                </li>
                                <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                            </ul>
                        </div>
                    </div>
                    <div id="model_contant_main" class="container">
                        <!-- pc内页分类 -->
                        <div class="model_leftright_l hidden-xs">
                            <div class="l_posnav"><?php echo gettoptype($eyou['field']['typeid'],'typename'); ?></div>
                            <div class="cont_nav">
                                <ul class="one">
                                    <?php  if(isset($ui_typeid) && !empty($ui_typeid)) : $typeid = $ui_typeid; else: $typeid = ""; endif; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  if(isset($ui_row) && !empty($ui_row)) : $row = $ui_row; else: $row = 100; endif; $tagChannel = new \think\template\taglib\eyou\TagChannel; $_result = $tagChannel->getChannel($typeid, "first", "ez", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["typename"] = text_msubstr($field["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                                    <li class="o_li"><a href="<?php echo $field['typeurl']; ?>"
                                                        class="one_a transition <?php echo $field['currentstyle']; ?>"> <?php if(!(empty($field['children']) || (($field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator ) && $field['children']->isEmpty()))): ?><i class="transition"></i><?php endif; ?><b>
                                            <?php echo $field['typename']; ?></b></a> <?php if(!(empty($field['children']) || (($field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator ) && $field['children']->isEmpty()))):  if(isset($ui_typeid) && !empty($ui_typeid)) : $typeid = $ui_typeid; else: $typeid = ""; endif; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  if(isset($ui_row) && !empty($ui_row)) : $row = $ui_row; else: $row = 100; endif;if(is_array($field['children']) || $field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator): $i = 0; $e = 1;$__LIST__ = is_array($field['children']) ? array_slice($field['children'],0,100, true) : $field['children']->slice(0,100, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field2): $field2["typename"] = text_msubstr($field2["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field2;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                                        <a href="<?php echo $field2['typeurl']; ?>" class="one_a transition <?php echo $field2['currentstyle']; ?>">
                                            <?php if(!(empty($field2['children']) || (($field2['children'] instanceof \think\Collection || $field2['children'] instanceof \think\Paginator ) && $field2['children']->isEmpty()))): ?>
                                            <i class="transition"></i>
                                            <?php endif; ?> <?php echo $field2['typename']; ?></a>
                                        <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field2 = []; ?>
                                        <ul class="second">
                                            <li class="e_li"><a class="er_a transition" href="<?php echo $field2['typeurl']; ?>"><?php echo $field2['typename']; ?><i
                                                    class="visible-xs"></i> </a></li>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                                </ul>
                            </div>
                            <!-- 左边联系我们-->
                            <div class="contact_left">
                                <img src="template/pc/skin/img/dongji/c.jpg" alt=""/>
                                <ul>
                                    <li> <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_5"); echo $__VALUE__; ?></li>
                                    <li> <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_1"); echo $__VALUE__; ?></li>
                                    <li> <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_6"); echo $__VALUE__; ?></li>
                                    <li> <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_7"); echo $__VALUE__; ?></li>

                                </ul>
                            </div>
                            <!-- 左边联系我们-->
                        </div>
                        <div class="moder_leftright_r">
                            <div class="r_posnav hidden-xs">
                                <p><?php echo $eyou['field']['typename']; ?></p>
                                <span><?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:14:"dangqianweizhi";}'); echo $__VALUE__; ?>：<?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:4:"sys1";}'); echo $__VALUE__;  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagPosition = new \think\template\taglib\eyou\TagPosition; $__VALUE__ = $tagPosition->getPosition($typeid, "", "crumb"); echo $__VALUE__; ?></span>
                            </div>
                            <div class="model-dectil">
                                <div class="model-dectil-img model_img_four" autoplay=1>
                                    <div class="single-item dec_item" id="marquee">
                                        <?php if(is_array($eyou['field']['image_list']) || $eyou['field']['image_list'] instanceof \think\Collection || $eyou['field']['image_list'] instanceof \think\Paginator): $i = 0; $e = 1; $__LIST__ = $eyou['field']['image_list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                                        <div>
                                            <div class="pimg"><img src="<?php echo $field['image_url']; ?>" alt="<?php echo $field['intro']; ?>"/></div>
                                        </div>
                                        <?php echo isset($field["ey_1563185380"])?$field["ey_1563185380"]:""; ?><?php echo (1 == $e && isset($field["ey_1563185376"]))?$field["ey_1563185376"]:""; ++$e; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#marquee").slick({
                                            dots: true,
                                            infinite: false,
                                            arrows: false,
                                            autoplay: true,
                                            autoplaySpeed: 2000000,
                                            fade: true,
                                            cssEase: "linear"
                                        });
                                    });
                                </script>
                                <div class="model-dectil-title"><?php echo $eyou['field']['title']; ?></div>
                                <div class="model-dectil-text">
                                    <?php echo $eyou['field']['content']; ?>
                                </div>
                                <div class="model-dectil-bottom">
                                    <ul class="model-dectil-chose">
                                        <?php  $tagPrenext = new \think\template\taglib\eyou\TagPrenext; $_result = $tagPrenext->getPrenext("pre");if(!empty($_result) || (($_result instanceof \think\Collection || $_result instanceof \think\Paginator ) && $_result->isEmpty())): $field = $_result; $field["title"] = text_msubstr($field["title"], 0, 100, false); ?>
                                        <li><a href="<?php echo $field['arcurl']; ?>" title="<?php echo $field['title']; ?>"> <?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:5:"sys11";}'); echo $__VALUE__; ?>
                                            : <?php echo $field['title']; ?></a></li>
                                        <?php else: ?>
                                        <li><a href="javascript:;"><?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:5:"sys11";}'); echo $__VALUE__; ?>：<?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:5:"sys10";}'); echo $__VALUE__; ?></a></li>
                                        <?php endif; $field = [];  $tagPrenext = new \think\template\taglib\eyou\TagPrenext; $_result = $tagPrenext->getPrenext("next");if(!empty($_result) || (($_result instanceof \think\Collection || $_result instanceof \think\Paginator ) && $_result->isEmpty())): $field = $_result; $field["title"] = text_msubstr($field["title"], 0, 100, false); ?>
                                        <li><a href="<?php echo $field['arcurl']; ?>" title="<?php echo $field['title']; ?>"> <?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:5:"sys12";}'); echo $__VALUE__; ?>
                                            : <?php echo $field['title']; ?></a></li>
                                        <?php else: ?>
                                        <li><a href="javascript:;"><?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:5:"sys12";}'); echo $__VALUE__; ?>：<?php  $tagLang = new \think\template\taglib\eyou\TagLang; $__VALUE__ = $tagLang->getLang('a:1:{s:4:"name";s:5:"sys10";}'); echo $__VALUE__; ?></a></li>
                                        <?php endif; $field = []; ?>
                                    </ul>
                                    <div class="model-dectil-share hidden-xs"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--footer-->
                <!--新闻动态end-->
<div class="clearfix"></div>
<!--footer start-->
<div class="footer">
  <div class="w">
    <div class="contact">
      <ul>
        <li><?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_8"); echo $__VALUE__; ?></li>
        <li> <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_1"); echo $__VALUE__; ?></li>
        <li>  <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_6"); echo $__VALUE__; ?></li>
        <li>  <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_5"); echo $__VALUE__; ?></li>
        <li> <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_7"); echo $__VALUE__; ?></li>
        <li> <?php echo htmlspecialchars_decode($global['web_copyright']); ?>--SEO技术支持：<a href="http://www.0917bjms.com/">麦思科技</a>
</li>
      </ul>
    </div>
    <div class="wx">
      <img src="  <?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_4"); echo $__VALUE__; ?>" alt=""/>
    </div>
  </div>

</div>

<?php  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/colorful.js","","",""); echo $__VALUE__;  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/quickbar.js","","",""); echo $__VALUE__; ?> 
  <script>$(document).ready(function() { var b_name = navigator.appName; var b_version = navigator.appVersion;var version = b_version.split(";");if(version[1]){var trim_version = version[1].replace(/[ ]/g, "");if (b_name == "Microsoft Internet Explorer") { if (trim_version == "MSIE7.0" || trim_version == "MSIE6.0"|| trim_version == "MSIE8.0") {$("body").append('<div class="banbendi" style="width:100%;height:30px;background:#FFFF99;text-align:center;line-height:30px;color:#666666;position:absolute;top:0;left:0;" onClick="hid()">您的浏览器版本过低，会影响网页浏览，请使用更高版本的浏览器</div>');}}}});function hid(){$(".banbendi").css("display","none");}</script> 
  <!-- 应用插件标签 start --> 
   <?php  $tagWeapp = new \think\template\taglib\eyou\TagWeapp; $__VALUE__ = $tagWeapp->getWeapp("default"); echo $__VALUE__; ?> 
  <!-- 应用插件标签 end -->
<!--  <div id='cs_box'>
  	<span class='cs_title'>在线咨询</span>
  	<span class='cs_close'>x</span>
  	<div class='cs_img'></div>
  	<span class='cs_info'>有什么可以帮到你</span>
  	<div class='cs_btn'>点击咨询</div>
  </div>
  <style>
  	#cs_box {width:120px; height:220px; background:#1692d6; position:fixed; right:10px; top:500px; border-radius:10px; z-index:1000}
  	#cs_box span {color:#fff; height:20px; line-height:20px; font-family:'Arial'; display:block;}
  	.cs_close {position:absolute; right:10px; top:10px; cursor:pointer; font-size:12px;}
  	.cs_title {font-size:14px; margin:10px; font-weight:bold;}
  	.cs_img {width:100px; height:100px; background:#fff; margin:10px;}
  	.cs_info {font-size:12px; margin:0px 10px; overflow:hidden; text-align:center;}
  	.cs_btn {width:100px; height:25px; border: 1px solid #ccc; margin:5px 10px; border-radius:5px; font-size:12px; line-height:25px; color:#fff; text-align:center; cursor:pointer;}
  	.cs_btn:hover{background: #fff;color: #1692d6;}
  </style>
  <?php  $tagStatic = new \think\template\taglib\eyou\TagStatic; $__VALUE__ = $tagStatic->getStatic("skin/js/kf.js","","",""); echo $__VALUE__; ?>
  <script type="text/javascript">
  	myEvent(window,'load',function(){
  		cs_box.set({
  			img_path : '<?php  $tagGlobal = new \think\template\taglib\eyou\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_attr_27"); echo $__VALUE__; ?>',		//设置图片路径
  			qq : '2056951181',		//设置QQ号码
  		});
  	});
  </script> -->
            </div>
        </div>
    </div>
</div>
</body>
</html>