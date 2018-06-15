/*
 * This file is part of PostCarrier for EC-CUBE
 *
 * Copyright(c) 2010-2013 IPLOGIC CO.,LTD. All Rights Reserved.
 *
 * http://www.iplogic.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

var imgCount = 0;
function countImgTag(node) {
    for (var i = 0; i < node.childNodes.length; i++) {
        if (node.childNodes[i].nodeType == 1) {
            var tagName = node.childNodes[i].nodeName;
            if(tagName=='IMG'){
                imgCount++;
            }
            countImgTag(node.childNodes[i]);
        }
    }
}

function insertListValue(){
    var value = $('#postcarrier_template_edit_subject_item').val();
    if (value) {
	var item = '${' + value + '}';
	if (getMailMethodVal() == 2) {
	    $('#postcarrier_template_edit_body').insertAtCaret(item);
	} else {
            editor.insertText(item);
	}
    }
}

function insertListValueSubBody(){
    var value = $('#postcarrier_template_edit_sub_body_item').val();
    if (value) {
	var item = '${' + value + '}';
        $('#postcarrier_template_edit_sub_body').insertAtCaret(item);
    }
}

function insertToSubject(){
    var value = $('#postcarrier_template_edit_subject_item').val();
    if (value) {
	var item = '${' + value + '}';
	$('#postcarrier_template_edit_subject').insertAtCaret(item);
    }
}


function insertListValue2(){
    var value = $('#postcarrier_subject_item').val();
    if (value) {
	var item = '${' + value + '}';
	if (getMailMethodVal() == 2) {
	    $('#postcarrier_body').insertAtCaret(item);
	} else {
            editor.insertText(item);
	}
    }
}

function insertListValueSubBody2(){
    var value = $('#postcarrier_sub_body_item').val();
    if (value) {
	var item = '${' + value + '}';
        $('#postcarrier_sub_body').insertAtCaret(item);
    }
}

function insertToSubject2(){
    var value = $('#postcarrier_subject_item').val();
    if (value) {
	var item = '${' + value + '}';
	$('#postcarrier_subject').insertAtCaret(item);
    }
}

var postcarrier_insert_target_node = false;
function showPallet(target_node){
    postcarrier_insert_target_node = target_node;

    palletObj = document.getElementById("emoji_pallet");
    if(palletObj.style.display == ""){
        palletObj.style.display = "none";
    }else{
        palletObj.style.display = "";
    }
}

function deleteLink(linkNumber, mail_method){
    var linkUrl = document.getElementById('linkUrl'+linkNumber+"_id").value;

    if(mail_method==1 && postcarrier_enableHtmlEditor){
        var body = editor.getData();
        editor.setData(body.replace("${リンク#"+linkNumber+"}", linkUrl));
    }else{
        var body = document.getElementById("body_id").value;
        document.getElementById("body_id").value = body.replace("${リンク#"+linkNumber+"}", linkUrl);
    }

    postcarrier_deleteLinkInfo(linkNumber);
}

function postcarrier_deleteLinkInfo(linkNumber){
    //alert('postcarrier_deleteLinkInfo'+linkNumber);
    var element = document.getElementById('linkUrl'+linkNumber+"_id");
    if (element) {
        element.value = "";
        document.getElementById('linkValue'+linkNumber+"_id").value = "";
        return true;
    } else {
        return false;
    }
}

function postcarrier_clearLinkInfo() {
    var element = document.form1.link_count
    var link_count = element.value;
    if (isNaN(link_count)) return;

    for (var i = 1; i <= parseInt(link_count); i++) {
        if (!postcarrier_deleteLinkInfo(i))
            break;
    }
    element.value = '0';
}

var postcarrier_enableHtmlEditor = true;

function getSendForVal() {
    var node;
    if (document.getElementById('postcarrier_template_edit_body'))
	node = $('input[name=postcarrier_template_edit\\[sendFor\\]]:checked')
    else
	node = $('input[name=postcarrier\\[sendFor\\]]:checked');
    return node.val();
}

function getMailMethodVal() {
    var node;
    if (document.getElementById('postcarrier_template_edit_body'))
	node = $('input[name=postcarrier_template_edit\\[mail_method\\]]:checked')
    else
	node = $('input[name=postcarrier\\[mail_method\\]]:checked');
    return node.val();
}

function getEditorBodyNode() {
    if (document.getElementById('postcarrier_template_edit_body'))
	return $('#postcarrier_template_edit_body')
    else
	return $('#postcarrier_body');
}

function getEditorBodyId() {
    if (document.getElementById('postcarrier_template_edit_body'))
	return 'postcarrier_template_edit_body';
    else
	return 'postcarrier_body';
}

function showSubBody() {
    if (document.getElementById('postcarrier_template_edit_body')) {
	$('#postcarrier_template_edit_sub_body').parents('.form-group').show();
	$('#postcarrier_template_edit_sub_body_item').parents('.form-group').show();
	$('#postcarrier_insert_to_subbody').parents('.form-group').show();
    } else {
	$('#postcarrier_sub_body').parents('.form-group').show();
	$('#postcarrier_sub_body_item').parents('.form-group').show();
	$('#postcarrier_insert_to_subbody').parents('.form-group').show();
    }
}

function hideSubBody() {
    if (document.getElementById('postcarrier_template_edit_body')) {
	$('#postcarrier_template_edit_sub_body').parents('.form-group').hide();
	$('#postcarrier_template_edit_sub_body_item').parents('.form-group').hide();
	$('#postcarrier_insert_to_subbody').parents('.form-group').hide();
    } else {
	$('#postcarrier_sub_body').parents('.form-group').hide();
	$('#postcarrier_sub_body_item').parents('.form-group').hide();
	$('#postcarrier_insert_to_subbody').parents('.form-group').hide();
    }
}

function selectMailMethod(firstFlag){
    var sendFor = getSendForVal();
    var mail_method = getMailMethodVal();
    // mail_typeは配信内容設定では存在するが、テンプレート設定には無い。
    var mail_type = 1; 
    /*
    if (document.content_page_form.mail_type) {
       mail_type = document.content_page_form.mail_type.value;
    }
    */

    if (!postcarrier_enableHtmlEditor) {
        if(mail_method==1){
            // 既に携帯が選択されていたら、PCを選択させる。
            if (document.content_page_form.sendFor[1].checked) {
                document.content_page_form.sendFor[0].checked = true;
            }
            document.content_page_form.sendFor[0].disabled = false;
            document.content_page_form.sendFor[1].disabled = true; // 携帯選択不可
            document.content_page_form.sendFor[2].disabled = false;
        }else{
            document.content_page_form.sendFor[0].disabled = false;
            document.content_page_form.sendFor[1].disabled = false;
            document.content_page_form.sendFor[2].disabled = false;
        }
    }

    /*
    // 絵文字パレット(PCSPでは出さない)
    if((mail_method==2 && sendFor=='MOBILE' && mail_type!=5)
       || (!postcarrier_enableHtmlEditor && mail_method==1 && sendFor=='PC')){
        document.getElementById("span_pallet").style.display = "";
    }else{
        document.getElementById("span_pallet").style.display = "none";
    }

    if(sendFor=='MOBILE' && mail_type!=5) {
        document.getElementById("span_pallet_s").style.display = "";
    } else {
        document.getElementById("span_pallet_s").style.display = "none";
    }
    */

    if (postcarrier_enableHtmlEditor) {
        deleteEditor();
        if(mail_method==1){
            if(sendFor=='PC' || sendFor=='PCSP'){
                CKEDITOR.config.customConfig = 'postcarrier_config.js';
            }else if(sendFor=='MOBILE'){
                CKEDITOR.config.customConfig = 'postcarrier_mobile_config.js';
            }else if(sendFor=='SPHONE'){
                CKEDITOR.config.customConfig = 'postcarrier_sphone_config.js';
            }
            editor = CKEDITOR.replace(getEditorBodyId());
            if(!firstFlag) {
                // 編集内容を引き継がない
                editor.setData("");
                //$('#subject').val('');
            }

	    showSubBody();
        }else{
	    hideSubBody();
        }
    }

    if(!firstFlag && mail_method==2){
        // テキストに変換して表示できればベスト
	getEditorBodyNode().val('');
    }

    /*
    if(!firstFlag) {
        postcarrier_clearLinkInfo();
    }
    */
}

function deleteEditor(){
    var o = CKEDITOR.instances[getEditorBodyId()];
    if (o) {
        editor.destroy();
    }
}

var editor = null;
function loadEditor(flag){
    if(flag=='PC'){
        CKEDITOR.config.customConfig = 'postcarrier_config.js';
    }else if(flag=='MOBILE'){
        CKEDITOR.config.customConfig = 'postcarrier_mobile_config.js';
    }else if(flag=='SPHONE'){
        CKEDITOR.config.customConfig = 'postcarrier_sphone_config.js';
    }
    editor = CKEDITOR.replace(getEditorBodyId());
}

function postcarrier_isMobile(){
    //alert('postcarrier_isMobile'+getSendForVal());
    return getSendForVal() == 'MOBILE';
}

function postcarrier_preview(mode){
    var init_target = document.form1.target;
    var init_action = document.form1.action;
    var size_x, size_y;
    var action = './preview.php';

    if (mode == 'edit') {
        action += '?previewMode=edit';
    }

    var sendFor = getSendForVal();
    if (sendFor == 'PC' || sendFor == 'PCSP') {
        size_x = '650'; size_y = '900';
    } else if (sendFor == 'SPHONE') {
        size_x = '360'; size_y = '700';
    } else {
        //size_x = '240'; size_y = '400';
        size_x = '270'; size_y = '500';
    }
    win03('','preview',size_x,size_y);
    document.form1.target = 'preview';
    document.form1.action = action;
    document.form1.submit();
    document.form1.target = init_target;
    document.form1.action = init_action;
}

function postcarrier_win03(URL,Winname,Wwidth,Wheight){
    var WIN;
    WIN = window.open(URL,Winname,"width="+Wwidth+",height="+Wheight+",scrollbars=yes,resizable=yes,toolbar=no,location=no,directories=no,status=no,menubar=no");
    WIN.focus();
}

function postcarrier_preview(mode){
    var init_target = document.form1.target;
    var init_action = document.form1.action;
    var size_x, size_y;
    var action = postcarrier_preview_url;

    if (mode == 'edit') {
        action += '?previewMode=edit';
    }

    var sendFor = getSendForVal();
    if (sendFor == 'PC' || sendFor == 'PCSP') {
        size_x = '650'; size_y = '900';
    } else if (sendFor == 'SPHONE') {
        size_x = '360'; size_y = '700';
    } else {
        size_x = '270'; size_y = '500';
    }
    postcarrier_win03('','preview',size_x,size_y);
    document.form1.target = 'preview';
    document.form1.action = action;
    document.form1.submit();
    document.form1.target = init_target;
    document.form1.action = init_action;
}

function postcarrier_resize(prev_mode){
    var editor = CKEDITOR.instances[getEditorBodyId()];
    var size_x, size_y;
    var sendFor = getSendForVal();

    if (sendFor == 'PC' || sendFor == 'PCSP') {
        return;
    }

    // PC以外のエディタサイズ調整を行う。
    if (prev_mode == 'wysiwyg') {
        // wysiwyg -> source
        if (sendFor == 'SPHONE') {
            size_x = 380; size_y = 440;
        } else {
            size_x = 288; size_y = 338;
        }
    } else {
        // source -> wysiwyg
        size_x = 660; size_y = 900;
    }
    //alert('resize:'+size_x+':'+size_y+':'+getSendForVal());
    editor.resize( size_x, size_y, true );
}

function postcarrier_fnModeSubmit(mode, keyname, keyid, confirm) {
    if (confirm) {
        if(!window.confirm(confirm)){
            return;
        }
    }
    document.form1['mode'].value = mode;
    if(keyname != "" && keyid != "") {
        document.form1[keyname].value = keyid;
    }
    document.form1.submit();
}

function submitLinkCheck(fm, strBody, mail_method){
    var boolMatch = strBody.match(/https?:\/\/([\w-]+\.)+[\w-]+(\/[\w-.\/?%&=]*)?/);
    if(mail_method==1){
        if(postcarrier_enableHtmlEditor) strBody = editor.getData();
	strBody = strBody.replace(/<!--[\s\S]*?-->/g, '');
	boolMatch = strBody.match(/<a\s.*?href\s*=\s*('|")https?:\/\/(?:[\w-]+\.)+[\w-]+[^>]*?\1/i);
    }

    if (boolMatch) {
        if(window.confirm('リンク抽出されていないリンク文字列が本文中に存在します。\nリンク抽出を行いますか？')){
            fm["mode"].value="link";
            fm.submit();
            return true;
        }
    }
    return false;
}

function copyBodyText(){
	if(window.confirm('HTML本文からテキスト部分をコピーした場合、現在の代替テキストは上書きされます。\nコピーを実行してよろしいでしょうか？')){
		var str = $(editor.getData()).text();
		document.form1["sub_body"].value = str.replace(/^[ \t]+/gm,"").replace(/^((\r\n)|\r|\n)+/,"").replace(/((\r\n)|\r|\n)+$/,"\r\n").replace(/((\r\n)|\r|\n){3,}/g,"\r\n\r\n");
	}

}

$.fn.extend({
    insertAtCaret: function(v) {
        var o = this.get(0);
        o.focus();

	if (!jQuery.browser) {
	    jQuery.browser={ msie: ( navigator.appName == 'Microsoft Internet Explorer') ? true : false }
	}

        if (jQuery.browser.msie) {
            var r = document.selection.createRange();
            r.text = v;
            r.select();
        } else {
            var s = o.value;
            var p = o.selectionStart;
            var np = p + v.length;
            o.value = s.substr(0, p) + v + s.substr(p);
            o.setSelectionRange(np, np);
        }
    }
});

// 受注明細行を追加する.
// 受注明細行のレコード数カウンタ(order_details_count)は, edit.twig側で定義している.
function fnAddOrderDetail($row, product_id) {
    // 規格1の要素を取得
    var $sele1 = $row.find('select[name=classcategory_id1]');
    // 規格2の要素を取得
    var $sele2 = $row.find('select[name=classcategory_id2]');

    var product_class_id = null;
    var price = null;
    var quantity = 1;
    var product_code = null;
    var tax_rate = null;

    // 規格なし商品の場合
    if (!$sele1.length && !$sele2.length) {
        var product = productsClassCategories[product_id]['__unselected2']['#'];
        product_class_id = product['product_class_id'];
        price = product['price02'];
        product_code = product['product_code'];
        // 規格が登録されている商品の場合
    } else if ($sele1.length) {
        if ($sele2.length) {
            var class_category_id1 = $sele1.val();
            var class_cateogry_id2 = $sele2.val();
            if (class_category_id1 == '__unselected' || !class_cateogry_id2) {
                alert('規格を選択してください。')
                return;
            }
            var product = productsClassCategories[product_id][class_category_id1]['#' + class_cateogry_id2];

            product_class_id = product['product_class_id'];
            price = product['price02'];
        } else {
            var class_category_id1 = $sele1.val();
            if (class_category_id1 == '__unselected') {
                alert('規格を選択してください。')
                return;
            }
            var product = productsClassCategories[product_id][class_category_id1]['#'];

            product_class_id = product['product_class_id'];
            price = product['price02'];
        }
    }

    // 追加対象は配信条件か除外条件のどちらか
    var button = $("#searchProductModalButton");
    var postcarrierTarget = button.data('postcarrierTarget');
    var mode = 'modal';
    if (postcarrierTarget == 'delivery') {
	// 受注明細行を取得.
	var list = $('#order_detail_list');

	// prototype templateを取得.
	var newWidget = list.attr('data-prototype');
	// レコード数カウンタで置換.
	newWidget = newWidget.replace(/__name__/g, order_details_count);
	// フォーム入力値をセットm
	$newWidget = $(newWidget);
	$newWidget.find('#postcarrier_OrderDetails_' + order_details_count + '_Product').val(product_id);
	$newWidget.find('#postcarrier_OrderDetails_' + order_details_count + '_ProductClass').val(product_class_id);
	$newWidget.find('#postcarrier_OrderDetails_' + order_details_count + '_quantity').val(1); // コントローラ側で再取得するため、仮の値をセット

	// 明細行に追加.
	list.append($newWidget);

	// カウンタを更新.
	order_details_count++;
    } else {
	// 受注明細行を取得.
	var list = $('#stop_order_detail_list');

	// prototype templateを取得.
	var newWidget = list.attr('data-prototype');
	// レコード数カウンタで置換.
	newWidget = newWidget.replace(/__name__/g, stop_order_details_count);
	// フォーム入力値をセット
	$newWidget = $(newWidget);
	$newWidget.find('#postcarrier_StopOrderDetails_' + stop_order_details_count + '_Product').val(product_id);
	$newWidget.find('#postcarrier_StopOrderDetails_' + stop_order_details_count + '_ProductClass').val(product_class_id);
	$newWidget.find('#postcarrier_StopOrderDetails_' + stop_order_details_count + '_quantity').val(1); // コントローラ側で再取得するため、仮の値をセット

	// 明細行に追加.
	list.append($newWidget);

	// カウンタを更新.
	stop_order_details_count++;

	mode = 'add_stop_product';
    }

    $("#searchProductModal").modal("hide");

    // 再計算のためsubmit.
    setModeAndSubmit(mode);

    return false;
}
