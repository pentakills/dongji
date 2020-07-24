<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:50:"./application/admin/template/language\pack_add.htm";i:1589160978;s:79:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\public\layout.htm";i:1589161016;s:78:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\language\bar.htm";i:1589160978;s:79:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\public\footer.htm";i:1574240950;}*/ ?>
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
<body class="bodystyle">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;min-width:auto;"></div>
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
    <form class="form-horizontal" id="post_form" action="<?php echo url('Language/pack_add'); ?>" method="post">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="name"><em>*</em>变量名</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="name" value="" id="name" class="input-txt" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9_-]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\[^a-zA-Z0-9_-]/g,''));">
                    <span class="err"></span>
                    <p class="notic">保持唯一性，不可重复</p>
                    <p class="">仅支持字母、数字、下划线、连接符，不区分大小写</p>
                </dd>
            </dl>
            <dl class="row"><dt class="tit"><label><b>语言名称</b></label></dt><dd class="opt"><label><b>变量值</b></label></dd></dl>
            <?php if(is_array($languageRow) || $languageRow instanceof \think\Collection || $languageRow instanceof \think\Paginator): $i = 0; $__LIST__ = $languageRow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <dl class="row">
                <dt class="tit">
                    <label for="value"><?php echo $vo['title']; ?></label>
                </dt>
                <dd class="opt">
                    <input type="text" name="value[<?php echo $vo['mark']; ?>]" value="" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="bot">
                <a href="JavaScript:void(0);" onclick="checkForm();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    // 判断输入框是否为空
    function checkForm(){
        var name = $.trim($('#name').val());
        var reg = /(^sys([0-9]+)$)/;
        if(name == ''){
            showErrorMsg('变量名不能为空！');
            $('#name').focus();
            return false;
        } else if (reg.test(name)) {
            showErrorMsg('禁止使用sys+数字的变量名，请更换');
            $('#name').focus();
            return false;
        }
        layer_loading('正在处理');
        $('#post_form').submit();
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