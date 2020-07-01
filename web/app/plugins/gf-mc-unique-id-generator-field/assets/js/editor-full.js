var mc_cur_field_id = 0;

function mcgfuidgen_generate_id(len,t,sep,freq,seq_start,seq_step){
	var separator = "",abc="",abc_len,x, i, c,s="";
	if (seq_start >= 0) {
		abc = "" +  (seq_start + seq_step);
	} else {
		if (t == "digits")
		 abc = MCGFUIDGEN_DIGITS;
		else
		if (t == "upper")
		 abc = MCGFUIDGEN_ABC.toUpperCase();
		else
		if (t == "lower")
		 abc = MCGFUIDGEN_ABC.toLowerCase();
		else
		if (t == "mixed")
		 abc = MCGFUIDGEN_ABC.toUpperCase()+MCGFUIDGEN_ABC.toLowerCase();
		else
		if (t == "upper_digits")
		 abc = MCGFUIDGEN_DIGITS+MCGFUIDGEN_ABC.toUpperCase();
		else
		if (t == "lower_digits")
		 abc = MCGFUIDGEN_DIGITS+MCGFUIDGEN_ABC.toLowerCase();
		else
		if (t == "mixed_digits")
		 abc = MCGFUIDGEN_DIGITS+MCGFUIDGEN_ABC.toUpperCase()+MCGFUIDGEN_ABC.toLowerCase();
		else
		 abc = MCGFUIDGEN_DIGITS+MCGFUIDGEN_ABC.toUpperCase()+MCGFUIDGEN_ABC.toLowerCase()+MCGFUIDGEN_SYMBOLS;
	}
	if (sep == "space") separator = " ";
	else
	if (sep == "dash") separator = "-";
	else
	if (sep == "comma") separator = ",";
	else
	if (sep == "dot") separator = ".";
	else
	if (sep == "quote") separator = "&#39;";
	else
	if (sep == "quote2") separator = "&#34;";
	else
	if (sep == "underscore") separator = "_";
	abc_len = abc.length;
	var dt = new Date();
// console.log("rand len = "+len+" separator = "+separator+" freq = "+freq);
// console.log(abc);
	for (i = 1; i <= len; i++ ) {
		if (seq_start >= 0) {
			c = abc.substr(i-1,1);
		} else {
			x = Math.round(Math.random() * 1000000 + dt.getMilliseconds() ) % abc_len;
// console.log("i = "+i+" x = "+x);
			c = abc.substr(x,1);
		}
// console.log("c = "+c);
		s += c;
		if (freq > 0)
			if ((((len-i) % freq) == 0) && (i < len))
			 s += separator;
	}
// console.log("res = "+s);
	return s;
}

function mcgfuidgen_render_preview(){
	var prefix = "#field_"+mc_cur_field_id+" ";
// console.log(prefix);
	var len = parseInt(jQuery(prefix + ".field_uidgen_length").val());
// console.log("len = "+len+" adr = "+prefix + ".field_uidgen_length");
	if (isNaN(len) || (len < 1) || (len > 100)) len = 6;
	var pr_type = jQuery(prefix + ".field_uidgen_render").val();
	var s = "";
	if (pr_type == "html")  {
		s += jQuery(prefix + ".field_uidgen_render_custom_html").val();
		if (s.indexOf(MCGFUIDGEN_UNQIUEID_TAG) < 0) s += MCGFUIDGEN_UNQIUEID_TAG;
	} else
	if (pr_type == "span")  {
		s = '<span>'+MCGFUIDGEN_UNQIUEID_TAG+'</span>';
	} else
	if (pr_type == "div")  {
		s = '<div>'+MCGFUIDGEN_UNQIUEID_TAG+'</div>';
	} else
	if (pr_type == "hidden")  {
		s = '<input type="hidden" value="'+MCGFUIDGEN_UNQIUEID_TAG+'"/>';
	} else {
		s = '<input type="text" value="'+MCGFUIDGEN_UNQIUEID_TAG+'" readonly="readonly"/>';
	}
// console.log(s);
	var t = jQuery(prefix + ".field_uidgen_chartype").val();
	var sep = jQuery(prefix + ".field_uidgen_separator").val();
	var freq = jQuery(prefix + ".field_uidgen_separatorfreq").val();
        if (jQuery(prefix + ".field_uidgen_separator").length <= 0) {
           sep = "none";
           freq = 0;
        }
	var seq_start = -1;
	var seq_step = 1;
// console.log("t = "+t+" sep = "+sep+" freq = "+freq+" seq_start = "+seq_start+" seq_step = "+seq_step);
	if (jQuery(prefix + ".field_sequence_enabled").is(":checked")) {
		seq_start = parseInt(jQuery(prefix + ".field_sequence_start").val());
		seq_step = parseInt(jQuery(prefix + ".field_sequence_step").val());
	}
	var val = mcgfuidgen_generate_id(len,t,sep,freq,seq_start,seq_step);
// console.log("val = "+val);
	s = s.replace(MCGFUIDGEN_UNQIUEID_TAG,val);
	jQuery(prefix + ".mcgfuidgen_preview").remove();
	jQuery(prefix + ".gfield_description").append('<div class="mcgfuidgen_preview"><label>Preview: </label>'+s+'</div>');
// console.log(jQuery(prefix + ".mcgfuidgen_preview").html());
}

function mcgfuidgen_save_settings(){
// console.log("save id = "+mc_cur_field_id);
	var prefix = "#field_" +mc_cur_field_id+" ";
// console.log(prefix);
	var len = parseInt(jQuery(prefix + ".field_uidgen_length").val());
	if (isNaN(len) || (len < 1) || (len > 100)) len = 6;
	jQuery(prefix + ".field_uidgen_length").val(len);
	var ct = "" + jQuery(prefix + ".field_uidgen_chartype").val();
	if ((ct == "digits") && (len <= 10)) {
		jQuery(prefix + ".field_sequence_enabled").prop("disabled",false);
		jQuery(prefix + ".field_sequence_start").prop("disabled",false);

 var v = ""+jQuery(prefix + ".field_sequence_start").val();
// console.log("v.length = "+v.length);// console.log("len = "+len);
		if (v.length != len) {
			var x = Math.pow(10,(len-1));
			if (x <= 1)
			 x = 0;
// console.log("old len = "+v.length+", len = "+len+", x = " +x);
			jQuery(prefix + ".field_sequence_start").val(x);
		}

		jQuery(prefix + ".field_sequence_step").prop("disabled",false);
	} else {
		jQuery(prefix + ".field_sequence_enabled").prop("checked",false).prop("disabled",true);
		jQuery(prefix + ".field_sequence_start").prop("disabled",true);
		jQuery(prefix + ".field_sequence_step").prop("disabled",true);
	}
	if (jQuery(prefix + ".field_sequence_enabled").is(":checked")) {
		jQuery(prefix + ".field_uidgen_chartype").val("digits");
		var step = parseInt(jQuery(prefix + ".field_sequence_step").val());
		if (isNaN(step) || (step < 1)) step = 1;
		jQuery(prefix + ".field_sequence_step").val(step);
		var start = parseInt(jQuery(prefix + ".field_sequence_start").val());
// console.log("start = "+start);
		if (isNaN(start) || (start < 1)) start = 100000;
		jQuery(prefix + ".field_sequence_start").val(start);
	}
	var data = {
		"max_length": 		jQuery(prefix + ".field_uidgen_length").val(),
		"char_type": 		jQuery(prefix + ".field_uidgen_chartype").val(),
		"separator":		jQuery(prefix + ".field_uidgen_separator").val(),
		"separator_freq":	jQuery(prefix + ".field_uidgen_separatorfreq").val(),
		"sequence_on":		(jQuery(prefix + ".field_sequence_enabled").is(":checked"))?1:0,
		"sequence_start":	jQuery(prefix + ".field_sequence_start").val(),
		"sequence_step":	jQuery(prefix + ".field_sequence_step").val(),
		"render_type":		jQuery(prefix + ".field_uidgen_render").val(),
		"render_html":		jQuery(prefix + ".field_uidgen_render_custom_html").val()
	};
	var str = jQuery.stringify(data);
	SetFieldProperty('mcgfuidgen_settings', str);
	mcgfuidgen_render_preview();
// console.log("<save "+mc_cur_field_id);// console.log(str);
}

function  mcgfuidgen_default_settings() {
// console.log("reset default settings");
	var prefix = "#field_" + mc_cur_field_id+" ";
// console.log(prefix);
	jQuery(prefix + ".field_uidgen_length").val(6);
	jQuery(prefix + ".field_uidgen_chartype").val("digits");
	jQuery(prefix + ".field_uidgen_separator").val("space");
	jQuery(prefix + ".field_uidgen_separatorfreq").val("3");
	jQuery(prefix + ".field_sequence_enabled").prop("checked",true);
	jQuery(prefix + ".field_sequence_start").val("100001");
	jQuery(prefix + ".field_sequence_step").val("1");
	jQuery(prefix + ".field_uidgen_render").val("text");
	jQuery(prefix + ".field_uidgen_render_custom_html").val("<div>"+MCGFUIDGEN_UNQIUEID_TAG+"</div>");
	mcgfuidgen_save_settings();
}

function  mcgfuidgen_load_settings(field){
	mc_cur_field_id = field.id;
// console.log(">mcgfuidgen_load_settings id = "+mc_cur_field_id);// console.log(field);
	var prefix = "#field_" + mc_cur_field_id+" ";
// console.log("prefix = "+prefix);
	try {
		var data = jQuery.parseJSON(field.mcgfuidgen_settings);
// console.log(data);// console.log("adr = "+prefix + ".field_uidgen_length");// console.log("len = "+jQuery(prefix + ".field_sequence_step").length);// console.log(data.max_length);
		if (jQuery(prefix + ".field_sequence_step").length <= 0) {
			setTimeout(function (){
				mcgfuidgen_load_settings(field);
			},32);
// console.log("<restart controls not created yet!!!");
			return;
		}
		jQuery(prefix + ".field_uidgen_length").val(data.max_length);
		jQuery(prefix + ".field_uidgen_chartype").val(data.char_type);
		jQuery(prefix + ".field_uidgen_separator").val(data.separator);
		jQuery(prefix + ".field_uidgen_separatorfreq").val(data.separator_freq);
		jQuery(prefix + ".field_sequence_enabled").prop("checked",(parseInt(data.sequence_on) > 0));
		jQuery(prefix + ".field_sequence_start").val(data.sequence_start);
		jQuery(prefix + ".field_sequence_step").val(data.sequence_step);
		jQuery(prefix + ".field_uidgen_render").val(data.render_type);
		jQuery(prefix + ".field_uidgen_render_custom_html").val(data.render_html);
// console.log("all loaded");
	} catch(e) {
		mcgfuidgen_default_settings();
// console.log(">mcgfuidgen_load_settings ERROR - DEFAULT LOADED id = "+mc_cur_field_id+"\n"+e.message);
	}
// console.log("rendering...");
	mcgfuidgen_render_preview();
// console.log("<mcgfuidgen_load_settings OK id = "+mc_cur_field_id);
}

fieldSettings["text"] += ", .field_uidgen";

//binding to the load field settings event to initialize the checkbox
jQuery(document).bind("gform_load_field_settings", function(event, field, form){
// console.log("load filed settings",field);
	if (field.type == "uidgen") {
        // unhide all udgen settings
		jQuery(".field_uidgen").show();
        // unhide common settings used in uidgen
		jQuery(".label_setting").show();
		jQuery(".description_setting").show();
        jQuery("#gform_tab_2").parent().show();
		jQuery(".admin_label_setting").show();
		jQuery(".visibility_setting").show();
		jQuery(".post_custom_field_setting").show();
		jQuery(".prepopulate_field_setting").show();
		jQuery(".conditional_logic_field_setting").show();
        jQuery("#gform_tab_3").parent().show();
		jQuery(".placeholder_setting").show();
		jQuery(".placeholder_textarea_setting").show();
		jQuery(".field_description_placement_container").show();
		jQuery(".css_class_setting").show();
		jQuery(".size_setting").show();
		// hide not needed fields
		jQuery(".placeholder_setting").hide();
		jQuery(".placeholder_textarea_setting").hide();
		jQuery(".error_message_setting").hide();
		mcgfuidgen_load_settings(field);
// console.log("mcgfuidgen settings loaded")
	} else {
		jQuery(".field_uidgen").hide();
	}
//			SetFieldDescription("my description");
});

jQuery(document).bind("gform_field_added",function(event, form, field){
	// console.log(event);// console.log(field);// console.log(form);// console.log("added");
	if (field.type == "uidgen") {
    	 jQuery("#field_"+field.id+" .gfield_label").html("Unique ID");
    }
	// console.log("fid = "+field.id);
});