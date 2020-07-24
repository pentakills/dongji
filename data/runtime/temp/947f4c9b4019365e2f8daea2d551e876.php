<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:47:"./application/admin/template/language\index.htm";i:1589160978;s:79:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\public\layout.htm";i:1589161016;s:78:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\language\bar.htm";i:1589160978;s:79:"D:\phpStudy\PHPTutorial\WWW\dongji\application\admin\template\public\footer.htm";i:1574240950;}*/ ?>
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
<body class="bodystyle" style="cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    
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
                <h3>语言列表</h3>
                <h5>(共<?php echo $pageObj->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo U('Language/index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="搜索相关数据...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo U('Language/index'); ?>';">
                    </div> -->
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <?php if($main_lang == $admin_lang): ?>
                        <th class="sign w40" axis="col0">
                            <div class="tc">选择</div>
                        </th>
                        <?php endif; ?>
                        <th abbr="article_show" axis="col5" class="w40">
                            <div class="tc">ID</div>
                        </th>
                        <th abbr="ac_id" axis="col4">
                            <div class="">语言名称</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="w180">
                            <div class="">中文名称</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w40">
                            <div class="tl">国旗</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w100">
                            <div class="tc">前台默认语言</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w50">
                            <div class="tc">开启</div>
                        </th>
                        <!-- <th abbr="article_time" axis="col6" class="w200">
                            <div class="tc">单独域名</div>
                        </th> -->
                        <th axis="col1" class="w120">
                            <div class="tc">操作</div>
                        </th>
                        <th abbr="article_show" axis="col5" class="w60">
                            <div class="tc">排序</div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table style="width: 100%">
                    <tbody>
                    <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                        <tr>
                            <?php if($main_lang == $admin_lang): ?>
                            <td class="sign">
                                <div class="w40 tc">
                                    <?php if(1 != $vo['is_home_default'] AND 0 < $k): ?>
                                    <input type="checkbox" name="ids[]" value="<?php echo $vo['id']; ?>">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <?php endif; ?>
                            <td class="sort">
                                <div class="w40 tc">
                                    <?php echo $vo['id']; ?>
                                </div>
                            </td>
                            <td style="width: 100%">
                                <div style="">
                                    <a href="<?php echo url('Language/edit',array('id'=>$vo['id'])); ?>">
                                    <?php echo $vo['title']; ?></a>
                                </div>
                            </td>
                            <td class="">
                                <div class="w180">
                                    <?php echo $languagemarkList[$vo['mark']]['cn_title']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w40 tc">
                                    <img src="/public/static/common/images/language/<?php echo $vo['mark']; ?>.gif" alt="<?php echo $vo['cn_title']; ?>"/>
                                </div>
                            </td>
                            <td class="">
                                <div class="w100 tc">
                                    <?php if($vo['is_home_default'] == '1'): ?>
                                        <span class="yes">是</span>
                                    <?php else: ?>
                                        <span class="no">否</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w50 tc">
                                    <?php if($vo['status'] == '1'): ?>
                                        <span class="yes" <?php if(is_check_access('Language@edit') == '1'): ?>onClick="changeTableVal('language','id','<?php echo $vo['id']; ?>','status',this);"<?php endif; ?>><i class="fa fa-check-circle"></i>是</span>
                                    <?php else: ?>
                                        <span class="no" <?php if(is_check_access('Language@edit') == '1'): ?>onClick="changeTableVal('language','id','<?php echo $vo['id']; ?>','status',this);"<?php endif; ?>><i class="fa fa-ban"></i>否</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <!-- <td class="">
                                <div class="w200 tc">
                                    <?php echo $vo['url']; ?>
                                </div>
                            </td> -->
                            <td>
                                <div class="w120 tc">
                                    <?php if(is_check_access('Language@edit') == '1'): ?>
                                    <a href="<?php echo U('Language/edit',array('id'=>$vo['id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    <?php endif; if($main_lang == $admin_lang): if(is_check_access('Language@del') == '1'): ?>
                                    <a class="btn red"  href="javascript:void(0)" data-url="<?php echo U('Language/del'); ?>" data-id="<?php echo $vo['id']; ?>" onClick="delfun(this);"><i class="fa fa-trash-o"></i>删除</a>
                                    <?php endif; endif; ?>
                                </div>
                            </td>
                            <td class="sort">
                                <div class="w60 tc">
                                    <?php if(is_check_access('Language@edit') == '1'): ?>
                                    <input style="text-align: left;" type="text" onchange="changeTableVal('language','id','<?php echo $vo['id']; ?>','sort_order',this);" size="4"  value="<?php echo $vo['sort_order']; ?>" />
                                    <?php else: ?>
                                    <?php echo $vo['sort_order']; endif; ?>
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
                <?php if($main_lang == $admin_lang): ?>
                <div class="fbutton checkboxall">
                    <input type="checkbox" onclick="javascript:$('input[name*=ids]').prop('checked',this.checked);">
                </div>
                <?php if(is_check_access('Language@del') == '1'): ?>
                <div class="fbutton">
                    <a onclick="batch_del(this, 'ids');" data-url="<?php echo U('Language/del'); ?>">
                        <div class="add" title="批量删除">
                            <span><i class="fa fa-close"></i>批量删除</span>
                        </div>
                    </a>
                </div>
                <?php endif; if(is_check_access('Language@add') == '1'): ?>
                <div class="fbutton">
                    <a href="<?php echo U('Language/add'); ?>">
                        <div class="add" title="新增语言">
                            <span class="red"><i class="fa fa-plus"></i>新增语言</span>
                        </div>
                    </a>
                </div>
                <?php endif; endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $page; ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        // 显示顶部菜单语言列表
        append_lang();
        function append_lang(){
            $(".em_lang ul li.lang", window.parent.document).remove();
            var htmlstr = '';
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                htmlstr += '<li class="ey-tool-list text-center lang"><a class="liaojie" href="?lang=<?php echo $vo['mark']; ?>"><?php echo $vo['title']; ?></a></li>';
            <?php endforeach; endif; else: echo "" ;endif; ?>
            $('#addlang', window.parent.document).before(htmlstr);
        }
    });

    function pack_iframe(obj)
    {
        var url = $(obj).data('url');
        //iframe窗
        layer.open({
            type: 2,
            title: '模板语言变量',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: false, //开启最大化最小化按钮
            area: ['90%', '90%'],
            content: url,
            end: function(){ //结束弹窗之后的处理

            }
        });
    }
  
    function delfun(obj){
      var title = $(obj).attr('data-typename');
      layer.confirm('<font color="#ff0000">将同步清空该语言的全部数据</font>，确认删除？', {
          title: false,
          btn: ['确定','取消'] //按钮
        }, function(){
          layer_loading('正在处理');
        // 确定
          $.ajax({
            type : 'post',
            url : $(obj).attr('data-url'),
            data : {del_id:$(obj).attr('data-id'), _ajax:1},
            dataType : 'json',
            success : function(data){
              layer.closeAll();
              if(data.code == 1){
                layer.msg(data.msg, {icon: 1});
                window.location.reload();
                // $('tr[data-id="'+$(obj).attr('data-id')+'"]').remove();
              }else{
                layer.alert(data.msg, {icon: 2, title:false});
              }
            }
          })
        }, function(index){
          layer.close(index);
        }
      );
      return false;
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