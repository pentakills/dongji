<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:61:"./application/admin/template/language\official_pack_index.htm";i:1589160978;s:79:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\public\layout.htm";i:1589161016;s:78:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\language\bar.htm";i:1589160978;s:79:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\public\footer.htm";i:1574240950;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="/public/plugins/layui/css/layui.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/css/main.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/css/page.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="/public/static/admin/font/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript">
    var eyou_basefile = "<?php echo \think\Request::instance()->baseFile(); ?>";
    var module_name = "<?php echo MODULE_NAME; ?>";
    var GetUploadify_url = "<?php echo url('Uploadify/upload'); ?>";
    var __root_dir__ = "";
    var __lang__ = "<?php echo $admin_lang; ?>";
</script>  
<link href="/public/static/admin/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="/public/static/admin/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="/public/static/admin/js/jquery.js"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/public/static/admin/js/admin.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="/public/static/admin/js/common.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/public/static/admin/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/public/plugins/layui/layui.js"></script>
<script src="/public/static/admin/js/myFormValidate.js"></script>
<script src="/public/static/admin/js/myAjax2.js?v=<?php echo $version; ?>"></script>
<script src="/public/static/admin/js/global.js?v=<?php echo $version; ?>"></script>
<link href="/public/static/admin/css/diy_style.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="/public/static/admin/js/clipboard.min.js"></script>
<body class="bodystyle" style="cursor: default; -moz-user-select: inherit;min-width:auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="min-width:auto;">
    
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-chevron-left"></i></a>
            <div class="subject">
                <h3>多语言</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_check_access('Language@index') == '1'): ?>
                <li>
                <?php if('Language' == CONTROLLER_NAME AND in_array(ACTION_NAME, ['index','add','edit'])): ?>
                    <a href="<?php echo url("Language/index"); ?>" class="tab current"><span>语言列表</span></a>
                <?php else: ?>
                    <a href="<?php echo url("Language/index"); ?>" class="tab"><span>语言列表</span></a>
                <?php endif; ?>
                </li>
                <?php endif; if(is_check_access('Language@customvar_arctype') == '1'): ?>
                <li>
                <?php if('Language' == CONTROLLER_NAME AND in_array(ACTION_NAME, ['customvar_arctype'])): ?>
                    <a href="<?php echo url("Language/customvar_arctype"); ?>" class="tab current"><span>模板栏目变量</span></a>
                <?php else: ?>
                    <a href="<?php echo url("Language/customvar_arctype"); ?>" class="tab"><span>模板栏目变量</span></a>
                <?php endif; ?>
                </li>
                <?php endif; if(is_check_access('Language@pack_index') == '1'): ?>
                <li>
                <?php if('Language' == CONTROLLER_NAME AND in_array(ACTION_NAME, ['pack_index','pack_add','pack_batch_add','pack_edit'])): ?>
                    <a href="<?php echo url("Language/pack_index"); ?>" class="tab current"><span>模板语言变量</span></a>
                <?php else: ?>
                    <a href="<?php echo url("Language/pack_index"); ?>" class="tab"><span>模板语言变量</span></a>
                <?php endif; ?>
                </li>
                <?php endif; if(is_check_access('Language@pack_index') == '1'): ?>
                <li>
                <?php if('Language' == CONTROLLER_NAME AND in_array(ACTION_NAME, ['official_pack_index'])): ?>
                    <a href="<?php echo url("Language/official_pack_index"); ?>" class="tab current"><span>官方语言包变量</span></a>
                <?php else: ?>
                    <a href="<?php echo url("Language/official_pack_index"); ?>" class="tab"><span>官方语言包变量</span></a>
                <?php endif; ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>官方语言包变量</h3>
                <h5>(共<?php echo $pageObj->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo url('Language/official_pack_index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="标题搜索...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('Language/official_pack_index'); ?>';">
                    </div> -->
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="sign w10" axis="col0">
                            <div class="tc"></div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w150">
                            <div class="tl">变量名</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="">
                            <div style="text-align: left; padding-left: 10px;" class="">变量值</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w100">
                            <div class="tc">更新时间</div>
                        </th>
                        <th axis="col1" class="w180">
                            <div class="tc">操作</div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table style="width: 100%;">
                    <tbody>
                    <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                        <tr>
                            <td class="">
                                <div class="w10 tc">
                                </div>
                            </td>
                            <td class="">
                                <div class="w150 tl">
                                    <a href="<?php echo url('Language/pack_edit',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a>
                                </div>
                            </td>
                            <td class="" style="width: 100%;">
                                <div class="tl" style="padding-left: 10px;">
                                    <?php echo htmlentities($vo['value']); ?>
                                </div>
                            </td>
                            <td>
                                <div class="w100 tc">
                                    <?php echo date('Y-m-d',$vo['update_time']); ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w180 tc">
                                    <?php if(is_check_access('Language@pack_edit') == '1'): ?>
                                    <a href="<?php echo url('Language/pack_edit',array('id'=>$vo['id'],'official'=>1)); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    <?php endif; ?>
                                    <a href="javascript:void(0);" onclick="showtext('<?php echo $vo['name']; ?>');" class="btn blue <?php echo $vo['name']; ?>" data-clipboard-text="{<?php  echo 'eyou:lang name=\''; ?><?php echo $vo['name'];  echo '\' /'; ?>}">复制标签</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="iDiv" style="display: none;"></div>
        </div>
        <div class="tDiv">
            <div class="tDiv2">
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $pageStr; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        check_pack_syn();
        function check_pack_syn()
        {
            $.ajax({
                type : 'post',
                url : "<?php echo url('Language/check_pack_syn'); ?>",
                data : {_ajax:1},
                dataType : 'json',
                success : function(data){
                    if(data.code == 0){
                        layer.alert('官方发布新的通用语言包，确认同步？', {
                            icon: 3,
                            title:false,
                            btn: ['立即同步']
                        }, function(){
                            layer_loading('正在处理');
                            // 确定
                            $.ajax({
                                type : 'post',
                                url : "<?php echo url('Language/pack_syn'); ?>",
                                data : {_ajax:1},
                                dataType : 'json',
                                success : function(res){
                                    layer.closeAll();
                                    if(res.code == 1){
                                        layer.msg(res.msg, {icon: 1, time:500}, function(){
                                            window.location.reload();
                                        });
                                    }else{
                                        layer.alert(res.msg, {icon: 2, title:false}, function(){
                                            window.location.reload();
                                        });
                                    }
                                }
                            })
                        });
                    }
                }
            })
        }
    });

    // 复制标签
    function showtext(classname){
        var clipboard1 = new Clipboard("."+classname);clipboard1.on("success", function(e) {layer.msg("复制成功");});clipboard1.on("error", function(e) {layer.msg("复制失败！请手动复制", {icon:2});}); 
    } 
</script>

<br/>
<div id="goTop">
    <a href="JavaScript:void(0);" id="btntop">
        <i class="fa fa-angle-up"></i>
    </a>
    <a href="JavaScript:void(0);" id="btnbottom">
        <i class="fa fa-angle-down"></i>
    </a>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#think_page_trace_open').css('z-index', 99999);
    });
</script>
</body>
</html>