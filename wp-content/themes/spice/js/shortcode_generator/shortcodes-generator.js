(function() {

    //console.log('hello');
    tinymce.create('tinymce.plugins.accomodation', {
        init : function(ed, url) {
            ed.addButton('accomodation', {
                title : 'Add an accomodation',
                image : url+'/shortcode.png',
                onclick : function() {
                    //ed.selection.setContent('[quote]' + ed.selection.getContent() + '[/quote]');
                    //console.log(ed.settings);
                    
                    ed.windowManager.open({
                        title  : 'Add Accomodation',
                        file : url + '/dialog.accomodation.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
					//	Windows Parameters/Arguments
					{
						editor: ed,
						jQuery: jQuery // PASS JQUERY
					}
                    );
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('accomodation', tinymce.plugins.accomodation);
    
    tinymce.create('tinymce.plugins.spicebutton', {
        init : function(ed, url) {
            ed.addButton('spicebutton', {
                title : 'Create "Button" Shortcode',
                image : url+'/button.png',
                onclick : function() {
                    //ed.selection.setContent('[quote]' + ed.selection.getContent() + '[/quote]');
                    //console.log(ed.settings);
                    
                    ed.windowManager.open({
                        title  : 'Create "Button" Shortcode',
                        file : url + '/dialog.button.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
					//	Windows Parameters/Arguments
					{
						editor: ed,
						jQuery: jQuery // PASS JQUERY
					}
                    );
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('spicebutton', tinymce.plugins.spicebutton);

    
    var my_shortcodes = ['spicebutton','accomodation','hours','dividers','social'];
    my_shortcodes=my_shortcodes.concat(my_plugin_shortcode);  
    var rs_val = [];
    
    for(var i in my_shortcodes)
    {
        rs_val[i] = { text: my_shortcodes[i], onclick : function() {
          
        }};
    }
   
    tinymce.PluginManager.add( 'spiceshortcode', function( editor, url ) {

        editor.addButton( 'spiceshortcode', {
            type: 'listbox',
            title: 'Spice Shortcode',         
            text: 'Spice Shortcodes',
            icon: false,
            onselect: function(e) 
            {
                plugin_url=url+'../../../../../plugins/spice-cpt/shortcode-view';
                shortcode_plugin_url=url+'../../../../../plugins/spice-shortcode/shortcode-view';
                
                if(e.control['_text']=='spicebutton')
                {
                        editor.windowManager.open({
                        title  : 'Create "Button" Shortcode',
                        file : shortcode_plugin_url + '/dialog.button.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
                    //  Windows Parameters/Arguments
                    {
                        editor: editor,
                        jQuery: jQuery // PASS JQUERY
                    }
                    );
                }
                if(e.control['_text']=='accomodation')
                {
                    editor.windowManager.open({
                        title  : 'Create "Accomodation" Shortcode',
                        file : shortcode_plugin_url + '/dialog.accomodation.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
                    //  Windows Parameters/Arguments
                    {
                        editor: editor,
                        jQuery: jQuery // PASS JQUERY
                    }
                    );
                }
                if(e.control['_text']=='hours')
                {
                        editor.windowManager.open({
                        title  : 'Create "Hour" Shortcode',
                        file : shortcode_plugin_url + '/dialog.hours.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
                    //  Windows Parameters/Arguments
                    {
                        editor: editor,
                        jQuery: jQuery // PASS JQUERY
                    }
                    );
                }
                 if(e.control['_text']=='dividers')
                {
                        editor.windowManager.open({
                        title  : 'Create "Devider" Shortcode',
                        file : shortcode_plugin_url + '/dialog.devider.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
                    //  Windows Parameters/Arguments
                    {
                        editor: editor,
                        jQuery: jQuery // PASS JQUERY
                    }
                    );
                }
                if(e.control['_text']=='social')
                {
                        editor.windowManager.open({
                        title  : 'Create "Social" Shortcode',
                        file : shortcode_plugin_url + '/dialog.social.html',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
                    //  Windows Parameters/Arguments
                    {
                        editor: editor,
                        jQuery: jQuery // PASS JQUERY
                    }
                    );
                }

                if(e.control['_text']=='chef')
                {                    
                    editor.windowManager.open({
                        title  : 'Create "Chef" Shortcode',
                        file : plugin_url + '/dialog.chef.php',
                        width  : 600,
                        height : 400,
                        inline : 1,                                       
                    },
                    //  Windows Parameters/Arguments
                    {
                        editor: editor,                        
                        jQuery: jQuery // PASS JQUERY
                    }
                    );
                }
                //tinymce.execCommand('mceInsertContent', false, e.control['_text']);
            }, 
            values: rs_val
 
        });
    });
    setTimeout(function() {
        jQuery('.mce-widget.mce-btn').each(function() {
            var btn = jQuery(this);
            if (btn.attr('aria-label')=="Spice Shortcode")
            {                
                btn.find('span').css({padding:"10px 20px 10px 10px"});

            }
        });
    },1000);
    
})();
