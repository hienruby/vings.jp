/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){(function(){function a(b,c,d){this.name=c;this.style=new CKEDITOR.style(d);};a.prototype={exec:function(b){b.focus();b.fire('saveSnapshot');this.style.apply(b.document);b.fire('saveSnapshot');}};CKEDITOR.plugins.add('marquee',{init:function(b){var c=b.config,d=new a(b,'telop',c.telop_style),e=new a(b,'swing',c.swing_style);b.addCommand('telop',d);b.addCommand('swing',e);b.ui.addButton('Telop',{label:'テロップ',command:'telop',icon:this.path+'images/telop.png'});b.ui.addButton('Swing',{label:'スウィング',command:'swing',icon:this.path+'images/swing.png'});}});})();CKEDITOR.config.telop_style={element:'marquee'};CKEDITOR.config.swing_style={element:'marquee',attributes:{behavior:'alternate'}};})();
