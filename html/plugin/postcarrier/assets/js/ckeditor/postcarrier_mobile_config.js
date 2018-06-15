CKEDITOR.editorConfig = function( config )
{
    config.language = 'ja';
    config.removePlugins = 'justify,image';
    config.extraPlugins = 'mobilepictogram,mbjustify,blink,marquee,bodycolor';
    config.toolbar =
    [
        ['Source'],
        ['Preview'],
	['Cut','Copy','Paste','PasteText'],
        ['Undo','Redo'],
        ['Find','Replace'],
        ['SelectAll','RemoveFormat'],
        ['HorizontalRule'],
        '/',
        ['FontSize','TextColor','BodyColor','Blink','Telop','Swing'],
        '/',
        ['JustifyLeft','JustifyCenter','JustifyRight'],
        ['Link','Unlink'],
        ['Image','MobilePictogram'/*,'SpecialChar'*/]
    ];

    // postcarrier_resize関数(postcarrier.js)でサイズ設定を行う
    config.width = '288px';
    config.height = '338px';
    config.disableObjectResizing = true;
    //config.resize_enabled = false;
    config.enterMode = CKEDITOR.ENTER_DIV;
    config.shiftEnterMode = CKEDITOR.ENTER_DIV;
    config.fullPage = true;

    config.fontSize_sizes =
    	'小/1;中/3;大/5';

    config.fontSize_style =
	{
		element		: 'font',
		attributes	: { 'size' : '#(size)' },
		overrides	: [ { element : 'span', styles : { 'font-size' : null } } ]
	};

    config.colorButton_foreStyle =
	{
		element		: 'font',
		attributes	: { 'color' : '#(color)' },
		overrides	: [ { element : 'span', styles : { 'color' : null } } ]
	};

    config.linkShowAdvancedTab = false;
    config.linkShowTargetTab = false;
    config.image_previewText = ' ';
    config.removeFormatTags = 'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var' 
    				+',blink,marquee';

    //config.filebrowserImageBrowseUrl = postcarrier_adminUrlPath + 'js/kcfinder/browse.php?type=images';
    //config.filebrowserImageUploadUrl = postcarrier_adminUrlPath + 'js/kcfinder/upload.php?type=images';
};
