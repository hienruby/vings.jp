<?php

/* __string_template__7bc3c6fecabde21341a19f147a337ad96b370502a15227016e82b7be60a52b07 */
class __TwigTemplate_a5aafde6fc446f0b3512a03a6ff9e357cb03862ede98f682cabfe72462fae733 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 17
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__7bc3c6fecabde21341a19f147a337ad96b370502a15227016e82b7be60a52b07", 17);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'sub_title' => array($this, 'block_sub_title'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'javascript' => array($this, 'block_javascript'),
            'main' => array($this, 'block_main'),
            'modal' => array($this, 'block_modal'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 19
        $context["menus"] = array(0 => "product", 1 => "product_edit");
        // line 24
        $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme((isset($context["form"]) ? $context["form"] : null), array(0 => "Form/bootstrap_3_horizontal_layout.html.twig"));
        // line 691
        $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme((isset($context["searchForm"]) ? $context["searchForm"] : null), array(0 => "Form/bootstrap_3_horizontal_layout.html.twig"));
        // line 17
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 21
    public function block_title($context, array $blocks = array())
    {
        echo "商品管理";
    }

    // line 22
    public function block_sub_title($context, array $blocks = array())
    {
        echo "商品登録";
    }

    // line 26
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 27
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/css/fileupload/jquery.fileupload.css\">
<link rel=\"stylesheet\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/css/fileupload/jquery.fileupload-ui.css\">
<link rel=\"stylesheet\" href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css\">
<style>
    .ui-state-highlight {
        height: 148px;
        border: dashed 1px #ccc;
        background: #fff;
    }
</style>
";
    }

    // line 39
    public function block_javascript($context, array $blocks = array())
    {
        // line 40
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/fileupload/vendor/jquery.ui.widget.js\"></script>
<script src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/fileupload/jquery.iframe-transport.js\"></script>
<script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/fileupload/jquery.fileupload.js\"></script>
<script src=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/fileupload/jquery.fileupload-process.js\"></script>
<script src=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/fileupload/jquery.fileupload-validate.js\"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js\"></script>
<script>
\$(function() {
    \$(\"#thumb\").sortable({
        cursor: 'move',
        opacity: 0.7,
        placeholder: 'ui-state-highlight',
        update: function (event, ui) {
            updateRank();
        }
    });
    ";
        // line 56
        if (((isset($context["has_class"]) ? $context["has_class"] : null) == false)) {
            // line 57
            echo "    if (\$(\"#";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock_unlimited", array()), "vars", array()), "id", array()), "html", null, true);
            echo "\").prop(\"checked\")) {
        \$(\"#";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), "vars", array()), "id", array()), "html", null, true);
            echo "\").attr(\"disabled\", \"disabled\").val('');
    } else {
        \$(\"#";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), "vars", array()), "id", array()), "html", null, true);
            echo "\").removeAttr(\"disabled\");
    }
    \$(\"#";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock_unlimited", array()), "vars", array()), "id", array()), "html", null, true);
            echo "\").on(\"click change\", function () {
        if (\$(this).prop(\"checked\")) {
            \$(\"#";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), "vars", array()), "id", array()), "html", null, true);
            echo "\").attr(\"disabled\", \"disabled\").val('');
        } else {
            \$(\"#";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), "vars", array()), "id", array()), "html", null, true);
            echo "\").removeAttr(\"disabled\");
        }
    });
    ";
        }
        // line 70
        echo "    var proto_img = ''
            + '<li class=\"ui-state-default\">'
            + '<img src=\"__path__\" />'
            + '<a class=\"delete-image\">'
            + '<svg class=\"cb cb-close\">'
            + '<use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#cb-close\"></use>'
            + '</svg>'
            + '</a>'
            + '</li>';
    var proto_add = '";
        // line 79
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "add_images", array()), "vars", array()), "prototype", array()), 'widget');
        echo "';
    var proto_del = '";
        // line 80
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "delete_images", array()), "vars", array()), "prototype", array()), 'widget');
        echo "';
    ";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "images", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 82
            echo "    var \$img = \$(proto_img.replace(/__path__/g, '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["image"], "vars", array()), "value", array()), "html", null, true);
            echo "'));
    var \$widget = \$('";
            // line 83
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["image"], 'widget');
            echo "');
    \$widget.val('";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["image"], "vars", array()), "value", array()), "html", null, true);
            echo "');
    \$(\"#thumb\").append(\$img.append(\$widget));
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "add_images", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["add_image"]) {
            // line 88
            echo "    var \$img = \$(proto_img.replace(/__path__/g, '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_temp_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["add_image"], "vars", array()), "value", array()), "html", null, true);
            echo "'));
    var \$widget = \$('";
            // line 89
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["add_image"], 'widget');
            echo "');
    \$widget.val('";
            // line 90
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["add_image"], "vars", array()), "value", array()), "html", null, true);
            echo "');
    \$(\"#thumb\").append(\$img.append(\$widget));
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['add_image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "delete_images", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["delete_image"]) {
            // line 94
            echo "    \$(\"#thumb\").append('";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["delete_image"], 'widget');
            echo "');
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['delete_image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "    var hideSvg = function () {
        if (\$(\"#thumb li\").length > 0) {
            \$(\"#icon_no_image\").css(\"display\", \"none\");
        } else {
            \$(\"#icon_no_image\").css(\"display\", \"\");
        }
    };
    var updateRank = function () {
        \$(\"#thumb li\").each(function (index) {
            \$(this).find(\".rank_images\").remove();
            filename = \$(this).find(\"input[type='hidden']\").val();
            \$rank = \$('<input type=\"hidden\" class=\"rank_images\" name=\"rank_images[]\" />');
            \$rank.val(filename + '//' + parseInt(index + 1));
            \$(this).append(\$rank);
        });
    }
    hideSvg();
    updateRank();
    // 画像削除時
    var count_del = 0;
    \$(\"#thumb\").on(\"click\", \".delete-image\", function () {
        var \$new_delete_image = \$(proto_del.replace(/__name__/g, count_del));
        var src = \$(this).prev().attr('src')
                .replace('";
        // line 119
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_temp_urlpath", array()), "html", null, true);
        echo "/', '')
                .replace('";
        // line 120
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
        echo "/', '');
        \$new_delete_image.val(src);
        \$(\"#thumb\").append(\$new_delete_image);
        \$(this).parent(\"li\").remove();
        hideSvg();
        updateRank();
        count_del++;
    });
    var count_add = ";
        // line 128
        echo twig_escape_filter($this->env, _twig_default_filter(twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "add_images", array())), 0), "html", null, true);
        echo ";
    \$('#";
        // line 129
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "product_image", array()), "vars", array()), "id", array()), "html", null, true);
        echo "').fileupload({
        url: \"";
        // line 130
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_image_add");
        echo "\",
        type: \"post\",
        dataType: 'json',
        done: function (e, data) {
            \$('#progress').hide();
            \$.each(data.result.files, function (index, file) {
                var path = '";
        // line 136
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_temp_urlpath", array()), "html", null, true);
        echo "/' + file;
                var \$img = \$(proto_img.replace(/__path__/g, path));
                var \$new_img = \$(proto_add.replace(/__name__/g, count_add));
                \$new_img.val(file);
                \$child = \$img.append(\$new_img);
                \$('#thumb').append(\$child);
                count_add++;
            });
            hideSvg();
            updateRank();
        },
        fail: function (e, data) {
            alert('アップロードに失敗しました。');
        },
        always: function (e, data) {
            \$('#progress').hide();
            \$('#progress .progress-bar').width('0%');
        },
        start: function (e, data) {
            \$('#progress').show();
        },
        acceptFileTypes: /(\\.|\\/)(gif|jpe?g|png)\$/i,
        maxFileSize: 10000000,
        maxNumberOfFiles: 10,
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            \$('#progress .progress-bar').css(
                    'width',
                    progress + '%'
            );
        },
        processalways: function (e, data) {
            if (data.files.error) {
                alert(\"画像ファイルサイズが大きいか画像ファイルではありません。\");
            }
        }
    });
    // 画像アップロード
    \$('#file_upload').on('click', function () {
        \$('#";
        // line 175
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "product_image", array()), "vars", array()), "id", array()), "html", null, true);
        echo "').click();
    });
});

function fnClass(action) {
    document.form1.action = action;
    document.form1.submit();
    return false;
}

</script>
";
    }

    // line 188
    public function block_main($context, array $blocks = array())
    {
        // line 189
        if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Category", array(), "any", true, true)) {
            // line 190
            echo "\t";
            $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Category", array()), array(0 => "CategoryCheckbox/Resource/template/admin/Form/form_layout.twig"));
        }
        // line 192
        echo "            <form role=\"form\" name=\"form1\" id=\"form1\" method=\"post\" action=\"\" novalidate enctype=\"multipart/form-data\">
            ";
        // line 193
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'widget');
        echo "
            <div class=\"row\" id=\"aside_wrap\">
                <div id=\"detail_wrap\" class=\"col-md-9\">
                    <div id=\"detail_box\" class=\"box form-horizontal\">
                        <div id=\"detail_box__header\" class=\"box-header\">
                            <h3 class=\"box-title\">基本情報</h3>
                        </div><!-- /.box-header -->
                        <div id=\"detail_box__body\" class=\"box-body\">

                            ";
        // line 203
        echo "                            ";
        if ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array())) {
            // line 204
            echo "                                <div id=\"detail_box__id\" class=\"form-group\">
                                    <label class=\"col-sm-3 col-lg-2 control-label\">商品ID</label>
                                    <div class=\"col-sm-9 col-lg-10 padT07\">";
            // line 206
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()), "html", null, true);
            echo "</div>
                                </div>
                            ";
        }
        // line 209
        echo "

                            ";
        // line 211
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), 'row');
        echo "
                            ";
        // line 212
        if (((isset($context["has_class"]) ? $context["has_class"] : null) == false)) {
            // line 213
            echo "                                ";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "product_type", array()), 'row', array("attr" => array("class" => "form-inline  padT07")));
            echo "
                            ";
        }
        // line 215
        echo "
                            <div id=\"detail_box__image\" class=\"form-group\">
                                <label class=\"col-sm-2 control-label\" for=\"admin_product_product_image\">
                                    ";
        // line 218
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "product_image", array()), "vars", array()), "label", array()), "html", null, true);
        echo "<br>
                                    <span class=\"small\">620px以上推奨</span>
                                </label>
                                <div id=\"detail_files_box\" class=\"col-sm-9 col-lg-10\">
                                    <div class=\"photo_files\" id=\"drag-drop-area\">
                                        <svg id=\"icon_no_image\" class=\"cb cb-photo no-image\"> <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#cb-photo\"></use></svg>
                                        <ul id=\"thumb\" class=\"clearfix\"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class=\"form-group marB30\">
                                <div id=\"detail_box__file_upload\" class=\"col-sm-offset-2 col-sm-9 col-lg-10 \">

                                    <div id=\"progress\" class=\"progress progress-striped active\" style=\"display:none;\">
                                        <div class=\"progress-bar progress-bar-info\"></div>
                                    </div>

                                    ";
        // line 235
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "product_image", array()), 'widget', array("attr" => array("accept" => "image/*", "style" => "display:none;")));
        echo "
                                    <a id=\"file_upload\" class=\"with-icon\">
                                        <svg class=\"cb cb-plus\"> <use xlink:href=\"#cb-plus\" /></svg>ファイルをアップロード
                                    </a>

                                </div>
                            </div>

                            <div id=\"detail_description_box\" class=\"form-group\">
                                ";
        // line 244
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "description_detail", array()), 'label');
        echo "
                                <div id=\"detail_description_box__detail\" class=\"col-sm-9 col-lg-10\">
                                    ";
        // line 246
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "description_detail", array()), 'widget');
        echo "
                                    <div id=\"detail_description_box__list\" class=\"accordion marT15 marB20\"><a id=\"detail_description_box__list_toggle\" class=\"toggle with-icon\"><svg class=\"cb cb-plus icon_plus\"> <use xlink:href=\"#cb-plus\" /></svg>一覧コメントを追加</a>
                                        <div class=\"accpanel padT08\">
                                            ";
        // line 249
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "description_list", array()), 'widget');
        echo "
                                        </div>
                                    </div>
                                </div>
                            </div>

                            ";
        // line 255
        if (((isset($context["has_class"]) ? $context["has_class"] : null) == false)) {
            // line 256
            echo "                            <div id=\"detail_box__price\" class=\"form-group\">
                                ";
            // line 257
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "price02", array()), 'label');
            echo "
                                <div id=\"detail_box__price02\" class=\"col-sm-3 col-lg-3\">
                                    ";
            // line 259
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "price02", array()), 'widget');
            echo "
                                    ";
            // line 260
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "price02", array()), 'errors');
            echo "
                                    <div id=\"detail_box__price01\" class=\"accordion marT15 marB20\"><a class=\"toggle with-icon\"><svg class=\"cb cb-plus icon_plus\"> <use xlink:href=\"#cb-plus\" /></svg>通常価格を追加</a>
                                        <div class=\"accpanel padT08\">
                                            ";
            // line 263
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "price01", array()), 'widget');
            echo "
                                            ";
            // line 264
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "price01", array()), 'errors');
            echo "
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id=\"detail_box__stock\" class=\"form-group\">
                                ";
            // line 271
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), 'label');
            echo "
                                <div class=\"col-sm-9 col-lg-10\">
                                    <div class=\"row\">
                                        <div id=\"detail_box__unlimited\" class=\"col-xs-12 form-inline\">
                                            ";
            // line 275
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), 'widget');
            echo "
                                            ";
            // line 276
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock", array()), 'errors');
            echo "
                                            ";
            // line 277
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock_unlimited", array()), 'widget');
            echo "
                                            ";
            // line 278
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "stock_unlimited", array()), 'errors');
            echo "
                                        </div>
                                    </div>

                                </div>
                            </div>
                            ";
        }
        // line 285
        echo "
                            <div id=\"detail_category_box\" class=\"form-group\">
                                ";
        // line 287
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Category", array()), 'label');
        echo "
                                <div class=\"col-sm-9 col-lg-10\">
                                    <div class=\"accordion marT05\">
                                        <a id=\"detail_category_box__toggle\" class=\"toggle with-icon\"><svg class=\"cb cb-plus icon_plus\"> <use xlink:href=\"#cb-plus\" /></svg>カテゴリを選択</a>
                                        <div id=\"detail_category_box__list\" class=\"accpanel padT08";
        // line 291
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Category", array()), "vars", array()), "valid", array()) == false)) {
            echo " has-error";
        }
        echo "\">
                                            ";
        // line 292
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Category", array()), 'widget');
        echo "
                                            ";
        // line 293
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Category", array()), 'errors');
        echo "
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id=\"detail_tag_box\" class=\"form-group\">
                                ";
        // line 300
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Tag", array()), 'label');
        echo "
                                <div class=\"col-sm-9 col-lg-10\">
                                    <div class=\"accordion marT05\">
                                        <a id=\"detail_tags_box__toggle\" class=\"toggle with-icon\"><svg class=\"cb cb-plus icon_plus\"> <use xlink:href=\"#cb-plus\" /></svg>";
        // line 303
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Tag"), "html", null, true);
        echo "を選択</a>
                                        <div id=\"detail_tags_box__list\" class=\"accpanel padT08\">
                                            ";
        // line 305
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Tag", array()), 'widget');
        echo "
                                            ";
        // line 306
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Tag", array()), 'errors');
        echo "
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"extra-form\">
                                ";
        // line 313
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 314
            echo "                                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 315
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'row');
                echo "
                                    ";
            }
            // line 317
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 318
        echo "                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                    <div id=\"sub_detail_box\" class=\"box accordion form-horizontal\">
                        <div  id=\"sub_detail_box__toggle\" class=\"box-header toggle\">
                            <h3 class=\"box-title\">詳細な設定<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></h3>
                        </div><!-- /.box-header -->
                        <div id=\"sub_detail_box__body\" class=\"box-body accpanel\">

                            ";
        // line 329
        if (((isset($context["has_class"]) ? $context["has_class"] : null) == false)) {
            // line 330
            echo "                                ";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "code", array()), 'row');
            echo "
                                ";
            // line 331
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "sale_limit", array()), 'row');
            echo "
                            ";
        }
        // line 333
        echo "
                            ";
        // line 334
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "search_word", array()), 'row');
        echo "
                            ";
        // line 335
        if (((isset($context["has_class"]) ? $context["has_class"] : null) == false)) {
            // line 336
            echo "                                ";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "delivery_date", array()), 'row');
            echo "
                                ";
            // line 337
            if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_product_delivery_fee", array())) {
                // line 338
                echo "                                <div id=\"sub_detail_box__delivery_fee\" class=\"form-group\">
                                    ";
                // line 339
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "delivery_fee", array()), 'label');
                echo "
                                    <div class=\"col-sm-3 col-lg-3\">
                                        ";
                // line 341
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "delivery_fee", array()), 'widget');
                echo "
                                    </div>
                                </div>
                                ";
            }
            // line 345
            echo "                                ";
            if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_product_tax_rule", array())) {
                // line 346
                echo "                                <div id=\"sub_detail_box__tax_rate\" class=\"form-group\">
                                    ";
                // line 347
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "tax_rate", array()), 'label');
                echo "
                                    <div class=\"col-sm-3 col-lg-3\">
                                        ";
                // line 349
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "class", array()), "tax_rate", array()), 'widget');
                echo "
                                    </div>
                                </div>
                                ";
            }
            // line 353
            echo "                            ";
        }
        // line 354
        echo "
                        </div>
                    </div>

                    <div id=\"free_box\" class=\"box accordion\">
                        <div id=\"free_box__body_toggle\" class=\"box-header toggle\">
                            <h3 class=\"box-title\">フリーエリア<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></h3>
                        </div><!-- /.box-header -->
                        <div id=\"free_box__body\" class=\"box-body accpanel\">
                            ";
        // line 363
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "free_area", array()), 'widget', array("id" => "wysiwyg-area"));
        echo "
                        </div>
                    </div>

                    ";
        // line 376
        echo "
<script>
\$(function() {
    var dataId = null;

    \$(document).on('click', '.delete', function() {
        var data = \$(this).data();
        \$('.related-view' + data.id ).addClass('hidden');
        \$('#admin_product_related_collection_' + data.id + '_ChildProduct').val('');
        \$('#admin_product_related_collection_' + data.id + '_content' ).val('');
        \$('#searchResult').children().remove();
    });

    window.onload = function () {
        \$(\"select.child-product\").each(function () {
            var html = \$(this).clone();
            var productId = \$(this).val();
            var index = \$(this).parent().find('button').attr('data-id');
            var productCode = \$('#product-code' + index).text();
            var parentDiv =  \$('#related-div-' + index);
            if (productId && !productCode) {
                \$.ajax({
                    type: \"POST\",
                    url: \"";
        // line 399
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_related_product_get_product");
        echo "\",
                    data: {
                        product_id : productId,
                        index : index
                    },
                    success: function(data){
                        parentDiv.empty().append(data);
                        parentDiv.append(html);
                    },
                    error: function() {
                        alert('get product info failed.');
                    }
                });
            }
        });
    };

    \$(document).on(\"click\", 'a[id^=\"search_\"]', function () {
        dataId = \$(this).attr(\"data-id\");
        \$(\"#relatedDataId\").val(dataId);
        \$(\"#searchResult\").children().remove();
        \$('div.box-footer a').remove();
    });

    \$(\"#searchButton\").on(\"click\", function () {
        var formIdVal = \$(\"#";
        // line 424
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "id", array()), "vars", array()), "id", array()), "html", null, true);
        echo "\").val();
        var formCatIdVal = \$(\"#";
        // line 425
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "category_id", array()), "vars", array()), "id", array()), "html", null, true);
        echo "\").val();
        var data = {
            id: formIdVal,
            category_id: formCatIdVal,
            product_id: ";
        // line 429
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array())) ? ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array())) : (0)), "html", null, true);
        echo "
        };
        \$(\"#searchResult\")
                .children()
                .remove();
        \$.ajax({
            type: \"POST\",
            url: \"";
        // line 436
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_related_product_search");
        echo "\",
            data: data,
            success: function(data){
                \$(\"#searchResult\").append(data);
            },
            error: function() {
                alert('product search failed.');
            }
        });
    });
});
</script>

<div class=\"box accordion form-horizontal\">

    <div class=\"box-header toggle\">
        <h3 class=\"box-title\">
            ";
        // line 453
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "related_collection", array()), "vars", array()), "label", array()), "html", null, true);
        echo "
            <svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg>
        </h3>
    </div><!-- /.box-header -->

    <div class=\"box-body accpanel\">
        ";
        // line 459
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "related_collection", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 460
            echo "            <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">
                    ";
            // line 462
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["child"], "ChildProduct", array()), "vars", array()), "label", array()), "html", null, true);
            echo "
                </label>
                ";
            // line 464
            $context["ChildProduct"] = $this->getAttribute($this->getAttribute((isset($context["RelatedProducts"]) ? $context["RelatedProducts"] : null), $this->getAttribute($context["loop"], "index0", array()), array(), "array"), "ChildProduct", array());
            // line 465
            echo "                <div class=\"col-sm-9 col-lg-9\" id=\"related-div-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
            echo "\">
                    ";
            // line 466
            if ((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null)) {
                // line 467
                echo "                        <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_edit", array("id" => $this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "id", array()))), "html", null, true);
                echo "\" id=\"product-image-link";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"flL related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" >
                            <img src=\"";
                // line 468
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "mainFileName", array())), "html", null, true);
                echo "\" id=\"product-image-img";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" style=\"max-width: 100px;margin-right: 10px;\" />
                        </a>
                        <span id=\"product-name";
                // line 470
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" style=\"margin-right: 10px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "name", array()), "html", null, true);
                echo "</span>
                        <a id=\"search_";
                // line 471
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"btn btn-default btn::after-block btn-sm\" data-toggle=\"modal\" data-target=\"#searchProductModal\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\">
                            商品を選択
                        </a>
                        <button type=\"button\" id=\"product-delete";
                // line 474
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"btn btn-default text-right delete related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\">削除</button>
                        ";
                // line 475
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["child"], "ChildProduct", array()), 'widget', array("attr" => array("style" => "display: none", "class" => "child-product")));
                echo "
                        <br>
                        <span class=\"related-view";
                // line 477
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" id=\"product-code";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\">
                            ";
                // line 478
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "code_min", array()), "html", null, true);
                echo "
                            ";
                // line 479
                if (($this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "code_min", array()) != $this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "code_max", array()))) {
                    echo " ～ ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ChildProduct"]) ? $context["ChildProduct"] : null), "code_max", array()), "html", null, true);
                    echo "
                            ";
                }
                // line 481
                echo "                        </span>
                    ";
            } else {
                // line 483
                echo "                        <a href=\"\" id=\"product-image-link";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"flL related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo " hidden\" >
                            <img src=\"\" id=\"product-image-img";
                // line 484
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" style=\"max-width: 100px;margin-right: 10px;\" />
                        </a>
                        <span id=\"product-name";
                // line 486
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo " hidden\" ></span>
                        <a id=\"search_";
                // line 487
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"btn btn-default btn::after-block btn-sm\" data-toggle=\"modal\" data-target=\"#searchProductModal\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\">
                            商品を選択
                        </a>
                        <button  type=\"button\" id=\"product-delete";
                // line 490
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"btn btn-default text-right delete related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo " hidden\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\">削除</button>
                        ";
                // line 491
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["child"], "ChildProduct", array()), 'widget', array("attr" => array("style" => "display: none", "class" => "child-product")));
                echo "
                        <br>
                        <span id=\"product-code";
                // line 493
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo "\" class=\"related-view";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
                echo " hidden\"></span>
                    ";
            }
            // line 495
            echo "

                </div>
            </div>
            <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">
                    ";
            // line 501
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["child"], "content", array()), "vars", array()), "label", array()), "html", null, true);
            echo "
                </label>
                <div class=\"col-sm-9 col-lg-10 related-content";
            // line 503
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index0", array()), "html", null, true);
            echo "\">
                    ";
            // line 504
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["child"], "content", array()), 'widget', array("attr" => array("class" => "col-sm-9 col-lg-10 form-control")));
            echo "
                    ";
            // line 505
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["child"], "content", array()), 'errors');
            echo "
                </div>
            </div>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 509
        echo "        <input type=\"hidden\" id=\"relatedDataId\" value=\"\">
    </div>
</div>

";
        // line 521
        echo "<div id=\"meta_box\" class=\"box accordion form-horizontal\">
    <div  id=\"meta_box__toggle\" class=\"box-header toggle\">
        <h3 class=\"box-title\">meta設定<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></h3>
    </div><!-- /.box-header -->
    <div id=\"meta_box__body\" class=\"box-body accpanel\">
        <div class=\"form-group\">
            ";
        // line 527
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "author", array()), 'label');
        echo "
            <div class=\"col-sm-10\">
                ";
        // line 529
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "author", array()), 'widget');
        echo "
            </div>
        </div>
        <div class=\"form-group\">
            ";
        // line 533
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "description", array()), 'label');
        echo "
            <div class=\"col-sm-10\">
                ";
        // line 535
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "description", array()), 'widget');
        echo "
            </div>
        </div>
        <div class=\"form-group\">
            ";
        // line 539
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "keyword", array()), 'label');
        echo "
            <div class=\"col-sm-10\">
                ";
        // line 541
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "keyword", array()), 'widget');
        echo "
            </div>
        </div>
        <div class=\"form-group\">
            ";
        // line 545
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "meta_robots", array()), 'label');
        echo "
            <div class=\"col-sm-10\">
                ";
        // line 547
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "meta_robots", array()), 'widget');
        echo "
            </div>
        </div>
        <div class=\"form-group\">
            ";
        // line 551
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "meta_tags", array()), 'label');
        echo "
            <div class=\"col-sm-10\">
                ";
        // line 553
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "meta_tags", array()), 'widget', array("attr" => array("placeholder" => "複数のmetaタグを入力可能")));
        echo "
            </div>
        </div>
    </div>
</div><div id=\"detail_box__footer\" class=\"row hidden-xs hidden-sm\">
                        <div class=\"col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 text-center btn_area\">
                            <p><a href=\"";
        // line 559
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_page", array("page_no" => (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "eccube.admin.product.search.page_no"), "method", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "eccube.admin.product.search.page_no"), "method"), "1")) : ("1")))), "html", null, true);
        echo "?resume=1\">検索画面に戻る</a></p>
                        </div>
                    </div>

                </div><!-- /.col -->

                <div id=\"common_box\" class=\"col-md-3\">
                    <div class=\"col_inner\" id=\"aside_column\">
                        <div id=\"common_button_box\" class=\"box no-header\">
                            <div id=\"common_button_box__body\" class=\"box-body\">
                                <div id=\"common_button_box__status\" class=\"row\">
                                    <div class=\"col-xs-12\">
                                        <div class=\"form-group\">
                                            ";
        // line 572
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Status", array()), 'widget');
        echo "
                                            ";
        // line 573
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "Status", array()), 'errors');
        echo "
                                        </div>
                                    </div>
                                </div>
                                <div id=\"common_button_box__insert_button\" class=\"row text-center\">
                                    <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
                                        <button type=\"submit\" class=\"btn btn-primary btn-block btn-lg prevention-btn prevention-mask\" >商品を登録</button>
                                    </div>
                                </div>
                                <div id=\"common_button_box__class_set_button\" class=\"row text-center with-border\">
                                    <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
                                        ";
        // line 584
        if ((null === (isset($context["id"]) ? $context["id"] : null))) {
            // line 585
            echo "                                            <button class=\"btn btn-default btn-block btn-sm\" disabled>
                                                規格設定
                                            </button>
                                        ";
        } else {
            // line 589
            echo "                                            <button class=\"btn btn-default btn-block btn-sm\" onclick=\"fnClass('";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_class", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
            echo "');return false;\">
                                                規格設定
                                            </button>
                                        ";
        }
        // line 593
        echo "                                    </div>
                                </div>
                                ";
        // line 604
        echo "
<div id=\"common_button_box__option_button\" class=\"row text-center with-border\">
    <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
        ";
        // line 607
        if ((null === (isset($context["id"]) ? $context["id"] : null))) {
            // line 608
            echo "            <button class=\"btn btn-default btn-block btn-sm\" disabled>
                オプション割当
            </button>
        ";
        } else {
            // line 612
            echo "            <button class=\"btn btn-default btn-block btn-sm\" onclick=\"fnClass('";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_option", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
            echo "');return false;\">
                オプション割当
            </button>
        ";
        }
        // line 616
        echo "    </div>
</div><div id=\"common_button_box__operation_button\" class=\"row text-center with-border\">
                                    <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
                                        <ul class=\"col-3\">
                                            ";
        // line 620
        if ((null === (isset($context["id"]) ? $context["id"] : null))) {
            // line 621
            echo "                                                <li>
                                                    <button class=\"btn btn-default btn-block btn-sm\" disabled>
                                                        確認
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class=\"btn btn-default btn-block btn-sm\" disabled>
                                                        複製
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class=\"btn btn-default btn-block btn-sm\" disabled>
                                                        削除
                                                    </button>
                                                </li>
                                            ";
        } else {
            // line 637
            echo "                                                <li>
                                                    <a class=\"btn btn-default btn-block btn-sm\" href=\"";
            // line 638
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_display", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
            echo "\" target=\"_blank\">
                                                        確認
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class=\"btn btn-default btn-block btn-sm\" href=\"";
            // line 643
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_copy", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
            echo "\"  ";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getCsrfTokenForAnchor();
            echo " data-method=\"post\" data-message=\"この商品情報を複製してもよろしいですか？\">
                                                        複製
                                                    </a>
                                                </li>
                                                <li>
                                                     <a class=\"btn btn-default btn-block btn-sm\" href=\"";
            // line 648
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_delete", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getCsrfTokenForAnchor();
            echo " data-method=\"delete\" data-message=\"この商品情報を削除してもよろしいですか？\">
                                                        削除
                                                    </a>
                                                </li>
                                            ";
        }
        // line 653
        echo "                                        </ul>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div id=\"common_date_info_box\" class=\"box no-header\">
                            <div id=\"common_date_info_box__body\" class=\"box-body update-area\">
                                <p><svg class=\"cb cb-clock\"> <use xlink:href=\"#cb-clock\" /></svg>登録日：";
        // line 661
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getDateFormatFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "create_date", array())), "html", null, true);
        echo "</p>
                                <p><svg class=\"cb cb-clock\"> <use xlink:href=\"#cb-clock\" /></svg>更新日：";
        // line 662
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getDateFormatFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "update_date", array())), "html", null, true);
        echo "</p>
                            </div>
                        </div><!-- /.box -->

                        <div id=\"common_shop_note_box\" class=\"box\">
                            <div id=\"common_shop_note_box__header\" class=\"box-header\">
                                <h3 class=\"box-title\">ショップ用メモ欄</h3>
                            </div><!-- /.box-header -->
                            <div id=\"common_shop_note_box__body\" class=\"box-body\">
                                ";
        // line 671
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "note", array()), 'widget');
        echo "
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->

            </div>
            </form>

";
    }

    // line 693
    public function block_modal($context, array $blocks = array())
    {
        // line 694
        echo "
<div class=\"modal\" id=\"searchProductModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span class=\"modal-close\" aria-hidden=\"true\">&times;</span></button>
                <h4 class=\"modal-title\" id=\"myModalLabel\">商品検索</h4>
            </div>
            <div class=\"modal-body\">
                <div class=\"form-group\">
                    ";
        // line 704
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "id", array()), 'widget', array("attr" => array("placeholder" => "商品名・ID・コード")));
        echo "
                </div>
                <div class=\"form-group\">
                    ";
        // line 707
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "category_id", array()), 'widget');
        echo "
                </div>
                <div class=\"form-group\">
                    <button type=\"button\" id=\"searchButton\" class=\"btn btn-primary\" >
                        検索
                    </button>
                </div>
                <div class=\"form-group\" id=\"searchResult\">
                </div>
            </div>
        </div>
    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "__string_template__7bc3c6fecabde21341a19f147a337ad96b370502a15227016e82b7be60a52b07";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1243 => 707,  1237 => 704,  1225 => 694,  1222 => 693,  1208 => 671,  1196 => 662,  1192 => 661,  1182 => 653,  1172 => 648,  1162 => 643,  1154 => 638,  1151 => 637,  1133 => 621,  1131 => 620,  1125 => 616,  1117 => 612,  1111 => 608,  1109 => 607,  1104 => 604,  1100 => 593,  1092 => 589,  1086 => 585,  1084 => 584,  1070 => 573,  1066 => 572,  1050 => 559,  1041 => 553,  1036 => 551,  1029 => 547,  1024 => 545,  1017 => 541,  1012 => 539,  1005 => 535,  1000 => 533,  993 => 529,  988 => 527,  980 => 521,  974 => 509,  956 => 505,  952 => 504,  948 => 503,  943 => 501,  935 => 495,  928 => 493,  923 => 491,  915 => 490,  907 => 487,  901 => 486,  896 => 484,  889 => 483,  885 => 481,  878 => 479,  874 => 478,  868 => 477,  863 => 475,  855 => 474,  847 => 471,  839 => 470,  830 => 468,  821 => 467,  819 => 466,  814 => 465,  812 => 464,  807 => 462,  803 => 460,  786 => 459,  777 => 453,  757 => 436,  747 => 429,  740 => 425,  736 => 424,  708 => 399,  683 => 376,  676 => 363,  665 => 354,  662 => 353,  655 => 349,  650 => 347,  647 => 346,  644 => 345,  637 => 341,  632 => 339,  629 => 338,  627 => 337,  622 => 336,  620 => 335,  616 => 334,  613 => 333,  608 => 331,  603 => 330,  601 => 329,  588 => 318,  582 => 317,  576 => 315,  573 => 314,  569 => 313,  559 => 306,  555 => 305,  550 => 303,  544 => 300,  534 => 293,  530 => 292,  524 => 291,  517 => 287,  513 => 285,  503 => 278,  499 => 277,  495 => 276,  491 => 275,  484 => 271,  474 => 264,  470 => 263,  464 => 260,  460 => 259,  455 => 257,  452 => 256,  450 => 255,  441 => 249,  435 => 246,  430 => 244,  418 => 235,  398 => 218,  393 => 215,  387 => 213,  385 => 212,  381 => 211,  377 => 209,  371 => 206,  367 => 204,  364 => 203,  352 => 193,  349 => 192,  345 => 190,  343 => 189,  340 => 188,  324 => 175,  282 => 136,  273 => 130,  269 => 129,  265 => 128,  254 => 120,  250 => 119,  225 => 96,  216 => 94,  211 => 93,  202 => 90,  198 => 89,  191 => 88,  186 => 87,  177 => 84,  173 => 83,  166 => 82,  162 => 81,  158 => 80,  154 => 79,  143 => 70,  136 => 66,  131 => 64,  126 => 62,  121 => 60,  116 => 58,  111 => 57,  109 => 56,  94 => 44,  90 => 43,  86 => 42,  82 => 41,  77 => 40,  74 => 39,  60 => 28,  55 => 27,  52 => 26,  46 => 22,  40 => 21,  36 => 17,  34 => 691,  32 => 24,  30 => 19,  11 => 17,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__7bc3c6fecabde21341a19f147a337ad96b370502a15227016e82b7be60a52b07", "");
    }
}
