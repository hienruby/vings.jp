CKEDITOR.editorConfig = function( config )
{
    config.language = 'ja';
    config.extraPlugins = 'mobilepictogram,blink,marquee,bodycolor';

    config.toolbar =
    	[
         ['Source'],
         ['Preview'],
	 ['Cut','Copy','Paste','PasteText'],
         ['Undo','Redo'],
         ['Find','Replace'],
	 ['SelectAll','RemoveFormat'],

         ['Bold','Italic','Underline','Strike'],
         ['TextColor','BGColor','BodyColor','Blink','Telop','Swing'],

         '/',

         ['NumberedList','BulletedList','-','Outdent','Indent'],
         ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
         ['Link','Unlink','Anchor'],
         ['Image','MobilePictogram','SpecialChar'],
         ['Table','HorizontalRule'],
         ['Styles','Format',/*'Font',*/'FontSize'],
    	];

    config.height = '500px';
    config.disableObjectResizing = true;
    //config.resize_enabled = false;
    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_BR;
    config.fullPage = true;

    config.fontSize_sizes =
    	'8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';

    config.fontSize_style =
	{
		element		: 'span',
		styles		: { 'font-size' : '#(size)' },
		overrides	: [ { element : 'font', attributes : { 'size' : null } } ]
	};

    config.colorButton_foreStyle =
	{
		element		: 'span',
		styles		: { 'color' : '#(color)' },
		overrides	: [ { element : 'font', attributes : { 'color' : null } } ]
	};

    config.linkShowAdvancedTab = false;
    config.linkShowTargetTab = false;
    config.image_previewText = ' ';

    //config.filebrowserImageBrowseUrl = postcarrier_adminUrlPath + 'js/kcfinder/browse.php?type=images';
    //config.filebrowserImageUploadUrl = postcarrier_adminUrlPath + 'js/kcfinder/upload.php?type=images';
};
