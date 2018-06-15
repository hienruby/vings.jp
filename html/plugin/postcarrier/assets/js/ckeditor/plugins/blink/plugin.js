/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){(function(){function a(b,c){this.style=new CKEDITOR.style(c);};a.prototype={exec:function(b){b.focus();b.fire('saveSnapshot');this.style.apply(b.document);b.fire('saveSnapshot');}};CKEDITOR.plugins.add('blink',{init:function(b){var c=new a(b,CKEDITOR.config.blink_style);b.addCommand('blink',c);b.ui.addButton('Blink',{label:'点滅',command:'blink',icon:this.path+'images/blink.png'});}});})();CKEDITOR.config.blink_style={element:'blink'};})();
