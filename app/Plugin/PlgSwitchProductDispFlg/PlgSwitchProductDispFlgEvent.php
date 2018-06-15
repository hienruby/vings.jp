<?php
/**
 * Copyright (c) 2016-present, Refine, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the code directory.
 */

namespace Plugin\PlgSwitchProductDispFlg;

use Eccube\Event\TemplateEvent;
use Eccube\Event\EventArgs;

class PlgSwitchProductDispFlgEvent
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param TemplateEvent $event
     * @return mixed
     */
    public function onRenderProductInitialize(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        $pagination = $parameters['pagination'];

        if (!$pagination || count($pagination) === 0) {
            return;
        }

        $snippet1 = '';
        $search1 = '<form name="search_form" id="search_form" method="post" action="{{ url(\'admin_product\') }}">';
        $replace1 = $snippet1;
        $source = str_replace($search1, $replace1, $event->getSource());

        $snippet2 = '<form name="search_form" id="search_form" method="post" action="{{ url(\'admin_product\') }}">';
        $search2 = '{% block main %}';
        $replace2 = $search2.$snippet2;
        $source = str_replace($search2, $replace2, $source);

        $snippet3 = '</div>';
        $search3 = '</form>';
        $replace3 = $snippet3;
        $source = str_replace($search3, $replace3, $source);

        $snippet4 = '</form>';
        $search4 = '{% endblock %}';
        $replace4 = $snippet4.$search4;
        $source = str_replace($search4, $replace4, $source);

        $snippet5 = '<li><input type="checkbox" id="all-check">全チェック</li>';
        $search5 = '<ul id="result_list__status_menu" class="link-with-bar">';
        $replace5 = $search5.$snippet5;
        $source = str_replace($search5, $replace5, $source);

        $snippet6 = '
            <div id="result_list__checkbox--{{ Product.id }}" class="td">
                <input type="checkbox" name="product_id[]" value="{{ Product.id }}" class="product_id">
            </div>
        ';
        $search6 = '<div id="result_list__item--{{ Product.id }}" class="item_box tr">';
        $replace6 = $search6.$snippet6;
        $source = str_replace($search6, $replace6, $source);

        $snippet7 = '
            <div class="col-xs-12" style="margin-top:20px;">
                <select name="operation" class="form-control" onchange="do_operation(this.value)">
                    <option value=""></option>
                    <option value="show">チェックした商品を公開</option>
                    <option value="hide">チェックした商品を非公開</option>
                </select>
            </div>
        ';
        $search7 = '</div><!-- /.box-body -->';
        $replace7 = $snippet7.$search7;
        $source = str_replace($search7, $replace7, $source);

        $snippet8 = '
            <script>
                $(function() {
                    $(\'#all-check\').on(\'click\', function(){
                    $(\'.product_id\').prop(\'checked\', $(this).is(\':checked\'))
                    });
                });

                function get_checked_count(form, elem_name)
                {
                    check_count = 0;
                    if ( form.elements[elem_name].length ){
                        for ( i = 0; i < form.elements[elem_name].length; i ++ ){
                            if ( form.elements[elem_name][i].checked ){
                                check_count ++;
                            }
                        }
                    }
                    else if ( form.elements[elem_name].checked ){
                        check_count ++;
                    }
                    return check_count;
                }

                function something_checked(form, elem_name, err_message, conf_message)
                {
                    ret = get_checked_count(form, elem_name);
                    if ( 0 == ret ){
                        alert(err_message);
                        return false;
                    }
                    if ( "" != conf_message ){
                        return confirm(conf_message);
                    }
                    return true;
                }

                function all_check(form, elem_name, checked)
                {
                    if ( form.elements[elem_name].length ){
                        for ( i = 0; i < form.elements[elem_name].length; i ++ ){
                            if ( !form.elements[elem_name][i].disabled ){
                                form.elements[elem_name][i].checked = checked;
                            }
                        }
                    }
                    else{
                        form.elements[elem_name].checked = checked;
                    }
                }
                function do_operation(operation){
                    var objMsg = {
                        show: \'チェックした商品を公開してもよろしいですか？\',
                        hide: \'チェックした商品を非公開にしてもよろしいですか？\'
                    };
                    msg = objMsg[operation];
                    if (msg && something_checked(document.search_form, "product_id[]", "一つ以上チェックして下さい", msg)) {
                        document.search_form.submit();
                    }
                    document.search_form.operation.selectedIndex = -1;
                }
            </script>
        ';
        $search8 = '{% endblock javascript %}';
        $replace8 = $snippet8.$search8;
        $source = str_replace($search8, $replace8, $source);

        $event->setSource($source);

    }

    public function onRenderProductIndex(EventArgs $event)
    {
        $app = $this->app;
        $request = $event->getRequest();

        $EventName =  "Admin/Product/Index.initialize";

        if ('POST' === $request->getMethod() && isset($_POST['operation'])) {
            if ( $_POST['operation'] == 'show' || $_POST['operation'] == 'hide' ){
                if ( $_POST['operation'] == 'show' ) {
                    $Disp = $app['eccube.repository.master.disp']->find( \Eccube\Entity\Master\Disp::DISPLAY_SHOW );
                }
                else{
                    $Disp = $app['eccube.repository.master.disp']->find( \Eccube\Entity\Master\Disp::DISPLAY_HIDE );
                }
                foreach ( $_POST['product_id'] as $product_id ) {
                    $Product = $app['eccube.repository.product']->find( $product_id );
                    if ( ! $Product ) {
                        throw new NotFoundHttpException();
                    }
                    $Product->setStatus($Disp);
                    $app['orm.em']->persist($Product);
                    $app['orm.em']->flush();
                }
            }
        }
    }
}
