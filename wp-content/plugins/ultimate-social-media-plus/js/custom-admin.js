function sfsi_plus_update_index() {
    var s = 1;
    SFSI("ul.plus_icn_listing li.plus_custom").each(function () {
        SFSI(this).children("span.sfsiplus_custom-txt").html("Custom " + s), s++;
    }), cntt = 1, SFSI("div.cm_lnk").each(function () {
        SFSI(this).find("h2.custom").find("span.sfsiCtxt").html("Custom " + cntt + ":"),
            cntt++;
    }), cntt = 1, SFSI("div.plus_custom_m").find("div.sfsiplus_custom_section").each(function () {
        SFSI(this).find("label").html("Custom " + cntt + ":"), cntt++;
    });
}
openWpMedia = function (btnUploadID, inputImageId, previewDivId, funcNameSuccessHandler) {

    var btnElem, inputImgElem, previewDivElem, iconName;

    var clickHandler = function (event) {

        var send_attachment_bkp = wp.media.editor.send.attachment;

        var frame = wp.media({
            title: 'Select or Upload image',
            button: {
                text: 'Use this image'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            var url = attachment.url.split("/");
            var fileName = url[url.length - 1];
            var fileArr = fileName.split(".");
            var fileType = fileArr[fileArr.length - 1];

            if (fileType != undefined && (fileType == 'gif' || fileType == 'jpeg' || fileType == 'jpg' || fileType == 'png')) {

                //inputImgElem.val(attachment.url);
                //previewDivElem.attr('src',attachment.url);

                btnElem.val("Change Picture");

                wp.media.editor.send.attachment = send_attachment_bkp;

                if (null !== funcNameSuccessHandler && funcNameSuccessHandler.length > 0) {

                    var iconData = {
                        "imgUrl": attachment.url
                    };

                    context[funcNameSuccessHandler](iconData, btnElem);
                }
            } else {
                alert("Only Images are allowed to upload");
                frame.open();
            }
        });

        // Finally, open the modal on click
        frame.open();
        return false;
    };

    if ("object" === typeof btnUploadID && null !== btnUploadID) {

        btnElem = SFSI(btnUploadID);
        inputImgElem = btnElem.parent().find('input[type="hidden"]');
        previewDivElem = btnElem.parent().find('img');
        iconName = btnElem.attr('data-iconname');
        clickHandler();
    } else {

        btnElem = $('#' + btnUploadID);
        inputImgElem = $('#' + inputImageId);
        previewDivElem = $('#' + previewDivId);

        btnElem.on("click", clickHandler);
    }

};
//MZ CODE END
function sfsipluscollapse(s) {
    var i = !0,
        e = SFSI(s).closest("div.ui-accordion-content").prev("h3.ui-accordion-header"),
        t = SFSI(s).closest("div.ui-accordion-content").first();
    e.toggleClass("ui-corner-all", i).toggleClass("accordion-header-active ui-state-active ui-corner-top", !i).attr("aria-selected", (!i).toString()),
        e.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", i).toggleClass("ui-icon-triangle-1-s", !i),
        t.toggleClass("accordion-content-active", !i), i ? t.slideUp() : t.slideDown();
}

function sfsi_plus_delete_CusIcon(s, i) {
    sfsiplus_beForeLoad();
    var e = {
        action: "plus_deleteIcons",
        icon_name: i.attr("name"),
        nonce: SFSI(i).parents('.plus_custom').find('input[name="nonce"]').val()
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: e,
        dataType: "json",
        success: function (e) {
            if ("success" == e.res) {
                sfsiplus_showErrorSuc("success", "Saved !", 1);
                var t = e.last_index + 1;
                var attr = i.attr("name");
                attr = attr.replace('plus', '');
                SFSI("#plus_total_cusotm_icons").val(e.total_up), SFSI(s).closest(".plus_custom").remove(),
                    SFSI("li.plus_custom:last-child").addClass("bdr_btm_non"), SFSI(".plus_custom-links").find("div." + attr).remove(),
                    SFSI(".plus_custom_m").find("div." + attr).remove(),
                    SFSI("ul.plus_sfsi_sample_icons").children("li." + attr).remove();

                if (e.total_up == 0) {
                    SFSI(".banner_custom_icon").hide();
                }

                var n = e.total_up + 1;
                4 == e.total_up && SFSI(".plus_icn_listing").append('<li id="plus_c' + t + '" class="plus_custom bdr_btm_non"><div class="radio_section tb_4_ck"><span class="checkbox" dynamic_ele="yes" style="background-position: 0px 0px;"></span><input name="plussfsiICON_' + t + '_display"  type="checkbox" value="yes" class="styled" style="display:none;" element-type="sfsiplus-cusotm-icon" isNew="yes" /></div> <span class="plus_custom-img"><img src="' + SFSI("#plugin_url").val() + 'images/custom.png" id="plus_CImg_' + t + '"  /> </span> <span class="custom sfsiplus_custom-txt">Custom' + n + ' </span> <div class="sfsiplus_right_info"> <p><span>' + object_name1.It_depends + ':</span> ' + object_name1.Upload_a + '</p><div class="inputWrapper"></div></li>');
            } else sfsiplus_showErrorSuc("error", "Unkown error , please try again", 1);
            return sfsi_plus_update_index(), plus_update_Sec5Iconorder(), sfsi_plus_update_step1(), sfsi_plus_update_step5(),
                sfsiplus_afterLoad(), "suc";
        }
    });
}

function plus_update_Sec5Iconorder() {
    SFSI("ul.plus_share_icon_order").children("li").each(function () {
        SFSI(this).attr("data-index", SFSI(this).index() + 1);
    });
}

function sfsi_plus_section_Display(s, i) {
    "hide" == i ? (SFSI("." + s + " :input").prop("disabled", !0), SFSI("." + s + " :button").prop("disabled", !0),
        SFSI("." + s).hide()) : (SFSI("." + s + " :input").removeAttr("disabled", !0), SFSI("." + s + " :button").removeAttr("disabled", !0),
        SFSI("." + s).show());
}

function sfsi_plus_depened_sections() {
    if ("sfsi" == SFSI("input[name='sfsi_plus_rss_icons']:checked").val()) {
        for (i = 0; 16 > i; i++) {
            var s = i + 1,
                e = 74 * i;
            SFSI(".sfsiplus_row_" + s + "_2").css("background-position", "-588px -" + e + "px");
        }
        var t = SFSI(".icon_img").attr("src");
        if (t) {
            if (t.indexOf("subscribe") != -1) {
                var n = t.replace("subscribe.png", "sf_arow_icn.png");
            } else {
                var n = t.replace("email.png", "sf_arow_icn.png");
            }
            SFSI(".icon_img").attr("src", n);
        }
    } else {
        if ("email" == SFSI("input[name='sfsi_plus_rss_icons']:checked").val()) {
            for (SFSI(".sfsiplus_row_1_2").css("background-position", "-58px 0"), i = 0; 16 > i; i++) {
                var s = i + 1,
                    e = 74 * i;
                SFSI(".sfsiplus_row_" + s + "_2").css("background-position", "-58px -" + e + "px");
            }
            var t = SFSI(".icon_img").attr("src");
            if (t) {
                if (t.indexOf("sf_arow_icn") != -1) {
                    var n = t.replace("sf_arow_icn.png", "email.png");
                } else {
                    var n = t.replace("subscribe.png", "email.png");
                }
                SFSI(".icon_img").attr("src", n);
            }
        } else {
            for (SFSI(".sfsiplus_row_1_2").css("background-position", "-649px 0"), i = 0; 16 > i; i++) {
                var s = i + 1,
                    e = 74 * i;
                SFSI(".sfsiplus_row_" + s + "_2").css("background-position", "-649px -" + e + "px");
            }
            var t = SFSI(".icon_img").attr("src");
            if (t) {
                if (t.indexOf("email") != -1) {
                    var n = t.replace("email.png", "subscribe.png");
                } else {
                    var n = t.replace("sf_arow_icn.png", "subscribe.png");
                }
                SFSI(".icon_img").attr("src", n);
            }
        }
    }
    SFSI("input[name='sfsi_plus_rss_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_rss_section", "show") : sfsi_plus_section_Display("sfsiplus_rss_section", "hide"),
        SFSI("input[name='sfsi_plus_email_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_email_section", "show") : sfsi_plus_section_Display("sfsiplus_email_section", "hide"),
        SFSI("input[name='sfsi_plus_facebook_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_facebook_section", "show") : sfsi_plus_section_Display("sfsiplus_facebook_section", "hide"),
        SFSI("input[name='sfsi_plus_twitter_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_twitter_section", "show") : sfsi_plus_section_Display("sfsiplus_twitter_section", "hide"),
        SFSI("input[name='sfsi_plus_youtube_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_youtube_section", "show") : sfsi_plus_section_Display("sfsiplus_youtube_section", "hide"),
        SFSI("input[name='sfsi_plus_pinterest_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_pinterest_section", "show") : sfsi_plus_section_Display("sfsiplus_pinterest_section", "hide"),
        SFSI("input[name='sfsi_plus_instagram_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_instagram_section", "show") : sfsi_plus_section_Display("sfsiplus_instagram_section", "hide"),
        SFSI("input[name='sfsi_plus_houzz_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_houzz_section", "show") : sfsi_plus_section_Display("sfsiplus_houzz_section", "hide"),
        SFSI("input[name='sfsi_plus_linkedin_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_linkedin_section", "show") : sfsi_plus_section_Display("sfsiplus_linkedin_section", "hide"),
        SFSI("input[name='sfsi_plus_telegram_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_telegram_section", "show") : sfsi_plus_section_Display("sfsiplus_telegram_section", "hide"),
        SFSI("input[name='sfsi_plus_vk_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_vk_section", "show") : sfsi_plus_section_Display("sfsiplus_vk_section", "hide"),
        SFSI("input[name='sfsi_plus_ok_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_ok_section", "show") : sfsi_plus_section_Display("sfsiplus_ok_section", "hide"),
        SFSI("input[name='sfsi_plus_wechat_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_wechat_section", "show") : sfsi_plus_section_Display("sfsiplus_wechat_section", "hide"),
        SFSI("input[name='sfsi_plus_wechat_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_wechat_section", "show") : sfsi_plus_section_Display("sfsiplus_wechat_section", "hide"),
        SFSI("input[name='sfsi_plus_weibo_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_weibo_section", "show") : sfsi_plus_section_Display("sfsiplus_weibo_section", "hide"),
        SFSI("input[element-type='sfsiplus-cusotm-icon']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_custom_section", "show") : sfsi_plus_section_Display("sfsiplus_custom_section", "hide");
}

function PlusCustomIConSectionsUpdate() {
    sfsi_plus_section_Display("counter".ele, show);
}
// Upload Custom Skin {Monad}
function plus_sfsi_customskin_upload(s, ref, nonce) {
    var ttl = jQuery(ref).attr("title");
    var i = s,
        e = {
            action: "plus_UploadSkins",
            custom_imgurl: i,
            nonce: nonce
        };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: e,
        success: function (msg) {
            if (msg.res = "success") {
                var arr = s.split('=');
                jQuery(ref).prev('.imgskin').attr('src', arr[1]);
                jQuery(ref).prev('.imgskin').css("display", "block");
                jQuery(ref).text("Update");
                jQuery(ref).next('.dlt_btn').css("display", "block");
            }
        }
    });
}
// Delete Custom Skin {Monad}
function sfsiplus_deleteskin_icon(s) {
    var iconname = jQuery(s).attr("title");
    var nonce = jQuery(s).attr("data-nonce");
    var i = iconname,
        e = {
            action: "plus_DeleteSkin",
            iconname: i,
            nonce: nonce
        };

    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: e,
        dataType: "json",
        success: function (msg) {
            if (msg.res === "success") {
                SFSI(s).prev("a").text("Upload");
                SFSI(s).prev("a").prev("img").attr("src", '');
                SFSI(s).prev("a").prev("img").css("display", "none");
                SFSI(s).css("display", "none");
            } else {
                alert("Whoops! something went wrong.")
            }
        }
    });
}
// Save Custom Skin {Monad}
function SFSI_plus_done(nonce) {
    e = {
        action: "plus_Iamdone",
        nonce: nonce
    };

    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: e,
        success: function (msg) {
            jQuery("li.cstomskins_upload").children(".sfsiplus_icns_tab_3").html(msg);
            SFSI("input[name='sfsi_plus_rss_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_rss_section", "show") : sfsi_plus_section_Display("sfsiplus_rss_section", "hide"), SFSI("input[name='sfsi_plus_email_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_email_section", "show") : sfsi_plus_section_Display("sfsiplus_email_section", "hide"), SFSI("input[name='sfsi_plus_facebook_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_facebook_section", "show") : sfsi_plus_section_Display("sfsiplus_facebook_section", "hide"), SFSI("input[name='sfsi_plus_twitter_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_twitter_section", "show") : sfsi_plus_section_Display("sfsiplus_twitter_section", "hide"), SFSI("input[name='sfsi_plus_youtube_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_youtube_section", "show") : sfsi_plus_section_Display("sfsiplus_youtube_section", "hide"), SFSI("input[name='sfsi_plus_pinterest_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_pinterest_section", "show") : sfsi_plus_section_Display("sfsiplus_pinterest_section", "hide"), SFSI("input[name='sfsi_plus_instagram_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_instagram_section", "show") : sfsi_plus_section_Display("sfsiplus_instagram_section", "hide"), SFSI("input[name='sfsi_plus_houzz_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_houzz_section", "show") : sfsi_plus_section_Display("sfsiplus_houzz_section", "hide"), SFSI("input[name='sfsi_plus_linkedin_display']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_linkedin_section", "show") : sfsi_plus_section_Display("sfsiplus_linkedin_section", "hide"), SFSI("input[element-type='sfsiplus-cusotm-icon']").prop("checked") ? sfsi_plus_section_Display("sfsiplus_custom_section", "show") : sfsi_plus_section_Display("sfsiplus_custom_section", "hide");
            SFSI(".cstmskins-overlay").hide("slow");
            sfsi_plus_update_step3() && sfsipluscollapse(this);
        }
    });
}
// Upload Custom Icons {Monad}
function plus_sfsi_newcustomicon_upload(s, nonce, nonce2) {
    var i = s,
        e = {
            action: "plus_UploadIcons",
            custom_imgurl: i,
            nonce: nonce
        };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: e,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s.res == 'success') {
                sfsiplus_afterIconSuccess(s, nonce2);
            } else {
                SFSI(".upload-overlay").hide("slow");
                SFSI(".uperror").html(s.res);
                sfsiplus_showErrorSuc("Error", "Some Error Occured During Upload Custom Icon", 1)
            }
        }
    });
}

function sfsi_plus_update_step1() {
    var nonce = SFSI("#sfsi_plus_save1").attr("data-nonce");
    global_error = 0, sfsiplus_beForeLoad(), sfsi_plus_depened_sections();
    var s = !1,
        i = SFSI("input[name='sfsi_plus_rss_display']:checked").val(),
        e = SFSI("input[name='sfsi_plus_email_display']:checked").val(),
        t = SFSI("input[name='sfsi_plus_facebook_display']:checked").val(),
        n = SFSI("input[name='sfsi_plus_twitter_display']:checked").val(),
        r = SFSI("input[name='sfsi_plus_youtube_display']:checked").val(),
        c = SFSI("input[name='sfsi_plus_pinterest_display']:checked").val(),
        p = SFSI("input[name='sfsi_plus_linkedin_display']:checked").val(),
        _ = SFSI("input[name='sfsi_plus_instagram_display']:checked").val(),
        telegram = SFSI("input[name='sfsi_plus_telegram_display']:checked").val(),
        vk = SFSI("input[name='sfsi_plus_vk_display']:checked").val(),
        ok = SFSI("input[name='sfsi_plus_ok_display']:checked").val(),
        weibo = SFSI("input[name='sfsi_plus_weibo_display']:checked").val(),
        wechat = SFSI("input[name='sfsi_plus_wechat_display']:checked").val(),
        houzz = SFSI("input[name='sfsi_plus_houzz_display']:checked").val(),
        l = SFSI("input[name='sfsi_custom1_display']:checked").val(),
        S = SFSI("input[name='sfsi_custom2_display']:checked").val(),
        u = SFSI("input[name='sfsi_custom3_display']:checked").val(),
        f = SFSI("input[name='sfsi_custom4_display']:checked").val(),
        d = SFSI("input[name='plussfsiICON_5']:checked").val(),
        I = {
            action: "plus_updateSrcn1",
            sfsi_plus_rss_display: i,
            sfsi_plus_email_display: e,
            sfsi_plus_facebook_display: t,
            sfsi_plus_twitter_display: n,
            sfsi_plus_youtube_display: r,
            sfsi_plus_pinterest_display: c,
            sfsi_plus_linkedin_display: p,
            sfsi_plus_instagram_display: _,
            sfsi_plus_telegram_display: telegram,
            sfsi_plus_vk_display: vk,
            sfsi_plus_ok_display: ok,
            sfsi_plus_weibo_display: weibo,
            sfsi_plus_wechat_display: wechat,
            sfsi_plus_houzz_display: houzz,
            sfsi_custom1_display: l,
            sfsi_custom2_display: S,
            sfsi_custom3_display: u,
            sfsi_custom4_display: f,

            sfsi_custom5_display: d,
            nonce: nonce
        };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: I,
        async: !0,
        dataType: "json",
        success: function (i) {
            if (i == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 1);
                s = !1;
                sfsiplus_afterLoad();
            } else {
                "success" == i ? (sfsiplus_showErrorSuc("success", "Saved !", 1), sfsipluscollapse("#sfsi_plus_save1"),
                    sfsi_plus_make_popBox()) : (global_error = 1, sfsiplus_showErrorSuc("error", "Unkown error , please try again", 1),
                    s = !1), sfsiplus_afterLoad();
            }
        }
    });
}

function sfsi_plus_update_step2() {
    var nonce = SFSI("#sfsi_plus_save2").attr("data-nonce");
    var s = sfsi_plus_validationStep2();
    if (!s) return global_error = 1, !1;
    sfsiplus_beForeLoad();
    var i = 1 == SFSI("input[name='sfsi_plus_rss_url']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_rss_url']").val(),
        e = 1 == SFSI("input[name='sfsi_plus_rss_icons']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_rss_icons']:checked").val(),
        t = 1 == SFSI("input[name='sfsi_plus_facebookPage_option']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_facebookPage_option']:checked").val(),
        n = 1 == SFSI("input[name='sfsi_plus_facebookLike_option']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_facebookLike_option']:checked").val(),
        o = 1 == SFSI("input[name='sfsi_plus_facebookShare_option']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_facebookShare_option']:checked").val(),
        a = SFSI("input[name='sfsi_plus_facebookPage_url']").val(),
        r = 1 == SFSI("input[name='sfsi_plus_twitter_followme']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_followme']:checked").val(),
        c = 1 == SFSI("input[name='sfsi_plus_twitter_followUserName']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_followUserName']").val(),
        p = 1 == SFSI("input[name='sfsi_plus_twitter_aboutPage']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_aboutPage']:checked").val(),
        _ = 1 == SFSI("input[name='sfsi_plus_twitter_page']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_page']:checked").val(),
        l = SFSI("input[name='sfsi_plus_twitter_pageURL']").val(),
        S = SFSI("textarea[name='sfsi_plus_twitter_aboutPageText']").val(),
        m = 1 == SFSI("input[name='sfsi_plus_youtube_page']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_youtube_page']:checked").val(),
        F = 1 == SFSI("input[name='sfsi_plus_youtube_pageUrl']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_youtube_pageUrl']").val(),
        h = 1 == SFSI("input[name='sfsi_plus_youtube_follow']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_youtube_follow']:checked").val(),
        cls = SFSI("input[name='sfsi_plus_youtubeusernameorid']:checked").val(),
        v = SFSI("input[name='sfsi_plus_ytube_user']").val(),
        vchid = SFSI("input[name='sfsi_plus_ytube_chnlid']").val(),
        g = 1 == SFSI("input[name='sfsi_plus_pinterest_page']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_pinterest_page']:checked").val(),
        k = 1 == SFSI("input[name='sfsi_plus_pinterest_pageUrl']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_pinterest_pageUrl']").val(),
        y = 1 == SFSI("input[name='sfsi_plus_pinterest_pingBlog']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_pinterest_pingBlog']:checked").val(),
        b = 1 == SFSI("input[name='sfsi_plus_instagram_pageUrl']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_instagram_pageUrl']").val(),
        houzz = 1 == SFSI("input[name='sfsi_plus_houzz_pageUrl']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_houzz_pageUrl']").val(),
        w = 1 == SFSI("input[name='sfsi_plus_linkedin_page']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedin_page']:checked").val(),
        x = 1 == SFSI("input[name='sfsi_plus_linkedin_pageURL']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedin_pageURL']").val(),
        C = 1 == SFSI("input[name='sfsi_plus_linkedin_follow']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedin_follow']:checked").val(),
        D = SFSI("input[name='sfsi_plus_linkedin_followCompany']").val(),
        U = 1 == SFSI("input[name='sfsi_plus_linkedin_SharePage']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedin_SharePage']:checked").val(),
        O = SFSI("input[name='sfsi_plus_linkedin_recommendBusines']:checked").val(),
        T = SFSI("input[name='sfsi_plus_linkedin_recommendProductId']").val(),
        j = SFSI("input[name='sfsi_plus_linkedin_recommendCompany']").val(),
        tgShareChk = SFSI("input[name='sfsi_plus_telegramShare_option']:checked").val(),
        tgShareChk = "undefined" !== typeof tgShareChk ? tgShareChk : "no",
        tgMsgChk = SFSI("input[name='sfsi_plus_telegramMessage_option']:checked").val(),
        tgMsgChk = "undefined" !== typeof tgMsgChk ? tgMsgChk : "no",
        tgMessageTxt = SFSI("input[name='sfsi_plus_telegram_message']").val(),
        tgMsgUserName = SFSI("input[name='sfsi_plus_telegram_username']").val(),
        P = {};
    vkVisitChk = SFSI("input[name='sfsi_plus_vkVisit_option']:checked").val(),
        vkVisitChk = "undefined" !== typeof vkVisitChk ? vkVisitChk : "no",
        vkShareChk = SFSI("input[name='sfsi_plus_vkShare_option']:checked").val(),
        vkShareChk = "undefined" !== typeof vkShareChk ? vkShareChk : "no",
        vkLikeChk = SFSI("input[name='sfsi_plus_vkLike_option']:checked").val(),
        vkLikeChk = "undefined" !== typeof vkLikeChk ? vkLikeChk : "no",

        vkFollowChk = SFSI("input[name='sfsi_plus_vkFollow_option']:checked").val(),
        vkFollowChk = "undefined" !== typeof vkFollowChk ? vkFollowChk : "no",

        vkVisitUrl = "no" == vkVisitChk ? "" : SFSI("input[name='sfsi_plus_vkVisit_url']").val(),
        vkFollowUrl = "no" == vkFollowChk ? "" : SFSI("input[name='sfsi_plus_vkFollow_url']").val(),

        okVisitChk = SFSI("input[name='sfsi_plus_okVisit_option']:checked").val(),
        okVisitChk = "undefined" !== typeof okVisitChk ? okVisitChk : "no",
        okVisitUrl = "no" == okVisitChk ? "" : SFSI("input[name='sfsi_plus_okVisit_url']").val(),
        okSubscribeChk = SFSI("input[name='sfsi_plus_okSubscribe_option']:checked").val(),
        okSubscribeChk = "undefined" !== typeof okSubscribeChk ? okSubscribeChk : "no",
        okSubscribeUrl = "no" == okSubscribeChk ? "" : SFSI("input[name='sfsi_plus_okSubscribe_userid']").val(),
        okShareChk = SFSI("input[name='sfsi_plus_okLike_option']:checked").val(),
        okShareChk = "undefined" !== typeof okShareChk ? okShareChk : "no",

        weiboVisitChk = SFSI("input[name='sfsi_plus_weiboVisit_option']:checked").val(),
        weiboVisitChk = "undefined" !== typeof weiboVisitChk ? weiboVisitChk : "no",
        weiboShareChk = SFSI("input[name='sfsi_plus_weiboShare_option']:checked").val(),
        weiboShareChk = "undefined" !== typeof weiboShareChk ? weiboShareChk : "no",
        weiboLikeChk = SFSI("input[name='sfsi_plus_weiboLike_option']:checked").val(),
        weiboLikeChk = "undefined" !== typeof weiboLikeChk ? weiboLikeChk : "no",
        weiboVisitUrl = "no" == weiboVisitChk ? "" : SFSI("input[name='sfsi_plus_weiboVisit_url']").val(),


        wechatFollowChk = SFSI("input[name='sfsi_plus_wechatFollow_option']:checked").val(),
        wechatFollowChk = "undefined" !== typeof wechatFollowChk ? wechatFollowChk : "no",
        wechatShareChk = SFSI("input[name='sfsi_plus_wechatShare_option']:checked").val(),
        wechatShareChk = "undefined" !== typeof wechatShareChk ? wechatShareChk : "no",
        wechatScanImage = SFSI("input[name='sfsi_plus_wechat_scan_image']").val(),

        SFSI("input[name='sfsi_plus_CustomIcon_links[]']").each(function () {
            P[SFSI(this).attr("file-id")] = this.value;
        });
    var M = {
        action: "plus_updateSrcn2",
        sfsi_plus_rss_url: i,
        sfsi_plus_rss_icons: e,
        sfsi_plus_facebookPage_option: t,
        sfsi_plus_facebookLike_option: n,
        sfsi_plus_facebookShare_option: o,
        sfsi_plus_facebookPage_url: a,
        sfsi_plus_twitter_followme: r,
        sfsi_plus_twitter_followUserName: c,
        sfsi_plus_twitter_aboutPage: p,
        sfsi_plus_twitter_page: _,
        sfsi_plus_twitter_pageURL: l,
        sfsi_plus_twitter_aboutPageText: S,
        sfsi_plus_youtube_page: m,
        sfsi_plus_youtube_pageUrl: F,
        sfsi_plus_youtube_follow: h,
        sfsi_plus_youtubeusernameorid: cls,
        sfsi_plus_ytube_user: v,
        sfsi_plus_ytube_chnlid: vchid,
        sfsi_plus_pinterest_page: g,
        sfsi_plus_pinterest_pageUrl: k,
        sfsi_plus_instagram_pageUrl: b,
        sfsi_plus_houzz_pageUrl: houzz,
        sfsi_plus_pinterest_pingBlog: y,
        sfsi_plus_linkedin_page: w,
        sfsi_plus_linkedin_pageURL: x,
        sfsi_plus_linkedin_follow: C,
        sfsi_plus_linkedin_followCompany: D,
        sfsi_plus_linkedin_SharePage: U,
        sfsi_plus_linkedin_recommendBusines: O,
        sfsi_plus_linkedin_recommendCompany: j,
        sfsi_plus_linkedin_recommendProductId: T,
        sfsi_plus_telegramShare_option: tgShareChk,
        sfsi_plus_telegramMessage_option: tgMsgChk,
        sfsi_plus_telegram_message: tgMessageTxt,
        sfsi_plus_telegram_username: tgMsgUserName,
        sfsi_plus_vkVisit_option: vkVisitChk,
        sfsi_plus_vkShare_option: vkShareChk,
        sfsi_plus_vkLike_option: vkLikeChk,
        sfsi_plus_vkFollow_option: vkFollowChk,
        sfsi_plus_vkFollow_url: vkFollowUrl,
        sfsi_plus_vkVisit_url: vkVisitUrl,
        sfsi_plus_okVisit_option: okVisitChk,
        sfsi_plus_okVisit_url: okVisitUrl,
        sfsi_plus_okSubscribe_option: okSubscribeChk,
        sfsi_plus_okSubscribe_userid: okSubscribeUrl,
        sfsi_plus_okLike_option: okShareChk,

        sfsi_plus_weiboVisit_option: weiboVisitChk,
        sfsi_plus_weiboShare_option: weiboShareChk,
        sfsi_plus_weiboLike_option: weiboLikeChk,
        sfsi_plus_weiboVisit_url: weiboVisitUrl,

        sfsi_plus_wechatFollow_option: wechatFollowChk,
        sfsi_plus_wechat_scan_image: wechatScanImage,
        sfsi_plus_wechatShare_option: wechatShareChk,
        sfsi_plus_custom_links: P,
        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: M,
        async: !0,
        dataType: "json",
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 2);
                return_value = !1;
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 2), sfsipluscollapse("#sfsi_plus_save2"),
                    sfsi_plus_depened_sections()) : (global_error = 1, sfsiplus_showErrorSuc("error", "Unkown error , please try again", 2),
                    return_value = !1), sfsiplus_afterLoad();
            }
        }
    });
}

function sfsi_plus_update_step3() {
    var nonce = SFSI("#sfsi_plus_save3").attr("data-nonce");
    var s = sfsi_plus_validationStep3();

    if (!s) return global_error = 1, !1;
    sfsiplus_beForeLoad();

    var i = SFSI("input[name='sfsi_plus_actvite_theme']:checked").val(),
        e = SFSI("input[name='sfsi_plus_mouseOver']:checked").val(),
        t = SFSI("input[name='sfsi_plus_shuffle_icons']:checked").val(),
        n = SFSI("input[name='sfsi_plus_shuffle_Firstload']:checked").val(),
        a = SFSI("input[name='sfsi_plus_shuffle_interval']:checked").val(),
        r = SFSI("input[name='sfsi_plus_shuffle_intervalTime']").val(),
        c = SFSI("input[name='sfsi_plus_specialIcon_animation']:checked").val(),
        p = SFSI("input[name='sfsi_plus_specialIcon_MouseOver']:checked").val(),
        _ = SFSI("input[name='sfsi_plus_specialIcon_Firstload']:checked").val(),
        l = SFSI("#sfsi_plus_specialIcon_Firstload_Icons option:selected").val(),
        S = SFSI("input[name='sfsi_plus_specialIcon_interval']:checked").val(),
        u = SFSI("input[name='sfsi_plus_specialIcon_intervalTime']").val(),
        f = SFSI("#sfsi_plus_specialIcon_intervalIcons option:selected").val(),
        o = SFSI("input[name='sfsi_plus_same_icons_mouseOver_effect']:checked").val();

    var mouseover_effect_type = 'same_icons'; //SFSI("input[name='sfsi_plus_mouseOver_effect_type']:checked").val();

    var d = {
        action: "plus_updateSrcn3",
        sfsi_plus_actvite_theme: i,
        sfsi_plus_mouseOver: e,
        sfsi_plus_shuffle_icons: t,
        sfsi_plus_shuffle_Firstload: n,
        sfsi_plus_mouseOver_effect: o,
        sfsi_plus_mouseover_effect_type: mouseover_effect_type,
        sfsi_plus_shuffle_interval: a,
        sfsi_plus_shuffle_intervalTime: r,
        sfsi_plus_specialIcon_animation: c,
        sfsi_plus_specialIcon_MouseOver: p,
        sfsi_plus_specialIcon_Firstload: _,
        sfsi_plus_specialIcon_Firstload_Icons: l,
        sfsi_plus_specialIcon_interval: S,
        sfsi_plus_specialIcon_intervalTime: u,
        sfsi_plus_specialIcon_intervalIcons: f,
        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: d,
        async: !0,
        dataType: "json",
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 3);
                return_value = !1;
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 3), sfsipluscollapse("#sfsi_plus_save3")) : (sfsiplus_showErrorSuc("error", "Unkown error , please try again", 3),
                    return_value = !1), sfsiplus_afterLoad();
            }
        }
    });
}

function sfsi_plus_show_counts() {
    "yes" == SFSI("input[name='sfsi_plus_display_counts']:checked").val() ? (SFSI(".sfsiplus_count_sections").slideDown(),
        sfsi_plus_showPreviewCounts()) : (SFSI(".sfsiplus_count_sections").slideUp(), sfsi_plus_showPreviewCounts());
}

function sfsi_plus_showPreviewCounts() {
    var s = 0;
    1 == SFSI("input[name='sfsi_plus_rss_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_rss_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_rss_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_email_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_email_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_email_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_facebook_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_facebook_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_facebook_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_twitter_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_twitter_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_twitter_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_linkedIn_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_linkedIn_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_linkedIn_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_youtube_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_youtube_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_youtube_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_pinterest_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_pinterest_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_pinterest_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_instagram_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_instagram_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_instagram_countsDisplay").css("opacity", 0), 1 == SFSI("input[name='sfsi_plus_houzz_countsDisplay']").prop("checked") ? (SFSI("#sfsi_plus_houzz_countsDisplay").css("opacity", 1),
        s = 1) : SFSI("#sfsi_plus_houzz_countsDisplay").css("opacity", 0), 0 == s || "no" == SFSI("input[name='sfsi_plus_display_counts']:checked").val() ? SFSI(".sfsi_Cdisplay").hide() : SFSI(".sfsi_Cdisplay").show();
}

function sfsi_plus_show_OnpostsDisplay() {
    //"yes" == SFSI("input[name='sfsi_plus_show_Onposts']:checked").val() ? SFSI(".sfsiplus_PostsSettings_section").slideDown() :SFSI(".sfsiplus_PostsSettings_section").slideUp();
}

function sfsi_plus_update_step4() {
    var nonce = SFSI("#sfsi_plus_save4").attr("data-nonce");
    var s = !1,
        i = sfsi_plus_validationStep4();
    if (!i) return global_error = 1, !1;
    sfsiplus_beForeLoad();
    var e = SFSI("input[name='sfsi_plus_display_counts']:checked").val(),
        t = 1 == SFSI("input[name='sfsi_plus_email_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_email_countsDisplay']:checked").val(),
        n = 1 == SFSI("input[name='sfsi_plus_email_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_email_countsFrom']:checked").val(),
        o = SFSI("input[name='sfsi_plus_email_manualCounts']").val(),
        r = 1 == SFSI("input[name='sfsi_plus_rss_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_rss_countsDisplay']:checked").val(),
        c = SFSI("input[name='sfsi_plus_rss_manualCounts']").val(),
        p = 1 == SFSI("input[name='sfsi_plus_facebook_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_facebook_countsDisplay']:checked").val(),
        _ = 1 == SFSI("input[name='sfsi_plus_facebook_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_facebook_countsFrom']:checked").val(),
        mp = SFSI("input[name='sfsi_plus_facebook_mypageCounts']").val(),
        l = SFSI("input[name='sfsi_plus_facebook_manualCounts']").val(),
        S = 1 == SFSI("input[name='sfsi_plus_twitter_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_countsDisplay']:checked").val(),
        u = 1 == SFSI("input[name='sfsi_plus_twitter_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_countsFrom']:checked").val(),
        f = SFSI("input[name='sfsi_plus_twitter_manualCounts']").val(),
        d = SFSI("input[name='sfsiplus_tw_consumer_key']").val(),
        I = SFSI("input[name='sfsiplus_tw_consumer_secret']").val(),
        m = SFSI("input[name='sfsiplus_tw_oauth_access_token']").val(),
        F = SFSI("input[name='sfsiplus_tw_oauth_access_token_secret']").val(),
        k = 1 == SFSI("input[name='sfsi_plus_linkedIn_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedIn_countsFrom']:checked").val(),
        y = SFSI("input[name='sfsi_plus_linkedIn_manualCounts']").val(),
        b = SFSI("input[name='sfsi_plus_ln_company']").val(),
        w = SFSI("input[name='sfsi_plus_ln_api_key']").val(),
        x = SFSI("input[name='sfsi_plus_ln_secret_key']").val(),
        C = SFSI("input[name='sfsi_plus_ln_oAuth_user_token']").val(),
        D = 1 == SFSI("input[name='sfsi_plus_linkedIn_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedIn_countsDisplay']:checked").val(),
        k = 1 == SFSI("input[name='sfsi_plus_linkedIn_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedIn_countsFrom']:checked").val(),
        y = SFSI("input[name='sfsi_plus_linkedIn_manualCounts']").val(),
        U = 1 == SFSI("input[name='sfsi_plus_youtube_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_youtube_countsDisplay']:checked").val(),
        O = 1 == SFSI("input[name='sfsi_plus_youtube_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_youtube_countsFrom']:checked").val(),
        T = SFSI("input[name='sfsi_plus_youtube_manualCounts']").val(),
        j = SFSI("input[name='sfsi_plus_youtube_user']").val(),
        P = 1 == SFSI("input[name='sfsi_plus_pinterest_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_pinterest_countsDisplay']:checked").val(),
        M = 1 == SFSI("input[name='sfsi_plus_pinterest_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_pinterest_countsFrom']:checked").val(),
        L = SFSI("input[name='sfsi_plus_pinterest_manualCounts']").val(),
        B = SFSI("input[name='sfsi_plus_pinterest_user']").val(),
        E = SFSI("input[name='sfsi_plus_pinterest_board']").val(),
        z = 1 == SFSI("input[name='sfsi_plus_instagram_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_instagram_countsDisplay']:checked").val(),
        A = 1 == SFSI("input[name='sfsi_plus_instagram_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_instagram_countsFrom']:checked").val(),
        N = SFSI("input[name='sfsi_plus_instagram_manualCounts']").val(),
        H = SFSI("input[name='sfsi_plus_instagram_User']").val(),
        houzzDisplay = 1 == SFSI("input[name='sfsi_plus_houzz_countsDisplay']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_houzz_countsDisplay']:checked").val(),
        houzzFrom = 1 == SFSI("input[name='sfsi_plus_houzz_countsFrom']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_houzz_countsFrom']:checked").val(),
        houzzCount = SFSI("input[name='sfsi_plus_houzz_manualCounts']").val(),
        vkc = SFSI("input[name='sfsi_plus_vk_countsDisplay']:checked").val() || 'no',
        vkm = SFSI("input[name='sfsi_plus_vk_manualCounts']").val(),
        tc = SFSI("input[name='sfsi_plus_telegram_countsDisplay']:checked").val() || 'no',
        tm = SFSI("input[name='sfsi_plus_telegram_manualCounts']").val(),
        wcc = SFSI("input[name='sfsi_plus_wechat_countsDisplay']:checked").val() || 'no',
        wcm = SFSI("input[name='sfsi_plus_wechat_manualCounts']").val(),
        okc = SFSI("input[name='sfsi_plus_ok_countsDisplay']:checked").val() || 'no',
        okm = SFSI("input[name='sfsi_plus_ok_manualCounts']").val(),
        wbc = SFSI("input[name='sfsi_plus_weibo_countsDisplay']:checked").val() || 'no',
        wbm = SFSI("input[name='sfsi_plus_weibo_manualCounts']").val(),
        ric = SFSI("input[name='sfsi_plus_round_counts']:checked").val() || 'no',
        oic = SFSI("input[name='sfsi_plus_original_counts']:checked").val() || 'no',
        rpic = SFSI("input[name='sfsi_plus_responsive_share_count']:checked").val() || 'no',

        $ = {
            action: "plus_updateSrcn4",
            sfsi_plus_display_counts: e,
            sfsi_plus_email_countsDisplay: t,
            sfsi_plus_email_countsFrom: n,
            sfsi_plus_email_manualCounts: o,
            sfsi_plus_rss_countsDisplay: r,
            sfsi_plus_rss_manualCounts: c,
            sfsi_plus_facebook_countsDisplay: p,
            sfsi_plus_facebook_countsFrom: _,
            sfsi_plus_facebook_mypageCounts: mp,
            sfsi_plus_facebook_manualCounts: l,
            sfsi_plus_twitter_countsDisplay: S,
            sfsi_plus_twitter_countsFrom: u,
            sfsi_plus_twitter_manualCounts: f,
            sfsiplus_tw_consumer_key: d,
            sfsiplus_tw_consumer_secret: I,
            sfsiplus_tw_oauth_access_token: m,
            sfsiplus_tw_oauth_access_token_secret: F,
            sfsi_plus_linkedIn_countsDisplay: D,
            sfsi_plus_linkedIn_countsFrom: k,
            sfsi_plus_linkedIn_manualCounts: y,
            sfsi_plus_ln_company: b,
            sfsi_plus_ln_api_key: w,
            sfsi_plus_ln_secret_key: x,
            sfsi_plus_ln_oAuth_user_token: C,
            sfsi_plus_youtube_countsDisplay: U,
            sfsi_plus_youtube_countsFrom: O,
            sfsi_plus_youtube_manualCounts: T,
            sfsi_plus_youtube_user: j,
            sfsi_plus_youtube_channelId: SFSI("input[name='sfsi_plus_youtube_channelId']").val(),
            sfsi_plus_pinterest_countsDisplay: P,
            sfsi_plus_pinterest_countsFrom: M,
            sfsi_plus_pinterest_manualCounts: L,
            sfsi_plus_pinterest_user: B,
            sfsi_plus_pinterest_board: E,
            sfsi_plus_instagram_countsDisplay: z,
            sfsi_plus_instagram_countsFrom: A,
            sfsi_plus_instagram_manualCounts: N,
            sfsi_plus_instagram_User: H,
            sfsi_plus_instagram_clientid: SFSI("input[name='sfsi_plus_instagram_clientid']").val(),
            sfsi_plus_instagram_appurl: SFSI("input[name='sfsi_plus_instagram_appurl']").val(),
            sfsi_plus_instagram_token: SFSI("input[name='sfsi_plus_instagram_token']").val(),
            sfsi_plus_houzz_countsDisplay: houzzDisplay,
            sfsi_plus_houzz_countsFrom: houzzFrom,
            sfsi_plus_houzz_manualCounts: houzzCount,
            sfsi_plus_telegram_countsDisplay: tc,
            sfsi_plus_telegram_manualCounts: tm,

            sfsi_plus_ok_countsDisplay: okc,
            sfsi_plus_ok_manualCounts: okm,

            sfsi_plus_vk_countsDisplay: vkc,
            sfsi_plus_vk_manualCounts: vkm,

            sfsi_plus_weibo_countsDisplay: wbc,
            sfsi_plus_weibo_manualCounts: wbm,

            sfsi_plus_wechat_countsDisplay: wcc,
            sfsi_plus_wechat_manualCounts: wcm,
            sfsi_plus_round_counts:ric,
            sfsi_plus_original_counts: oic,
            sfsi_plus_responsive_share_count: rpic,
            nonce: nonce
        };
        console.log( $,'sc');
    return SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: $,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 4);
                global_error = 1;
                sfsiplus_afterLoad();
            } else {
                "success" == s.res ? (sfsiplus_showErrorSuc("success", "Saved !", 4), sfsipluscollapse("#sfsi_plus_save4"),
                    sfsi_plus_showPreviewCounts()) : (sfsiplus_showErrorSuc("error", "Unkown error , please try again", 4),
                    global_error = 1), sfsiplus_afterLoad();
            }
        }
    }), s;
}

function sfsi_plus_update_step5() {
    var nonce = SFSI("#sfsi_plus_save5").attr("data-nonce");
    sfsi_plus_update_step3();
    var s = sfsi_plus_validationStep5();
    if (!s) return global_error = 1, !1;
    sfsiplus_beForeLoad();
    var i = SFSI("input[name='sfsi_plus_icons_size']").val(),
        e = SFSI("input[name='sfsi_plus_icons_perRow']").val(),
        t = SFSI("input[name='sfsi_plus_icons_spacing']").val(),
        n = SFSI("#sfsi_plus_icons_Alignment").val(),
        followicon = SFSI("#sfsi_plus_follow_icons_language").val(),
        facebookicon = SFSI("#sfsi_plus_facebook_icons_language").val(),
        twittericon = SFSI("#sfsi_plus_twitter_icons_language").val(),

        lang = SFSI("#sfsi_plus_icons_language").val(),
        o = SFSI("input[name='sfsi_plus_icons_ClickPageOpen']:checked").val(),
        a = SFSI("input[name='sfsi_plus_icons_float']:checked").val(),
        dsb = SFSI("input[name='sfsi_plus_disable_floaticons']:checked").val(),
        dsbv = SFSI("input[name='sfsi_plus_disable_viewport']:checked").val(),
        r = SFSI("#sfsi_plus_icons_floatPosition").val(),
        c = SFSI("input[name='sfsi_plus_icons_stick']:checked").val(),
        p = SFSI("#sfsi_plus_rssIcon_order").attr("data-index"),
        _ = SFSI("#sfsi_plus_emailIcon_order").attr("data-index"),
        S = SFSI("#sfsi_plus_facebookIcon_order").attr("data-index"),
        u = SFSI("#sfsi_plus_twitterIcon_order").attr("data-index"),
        f = SFSI("#sfsi_plus_youtubeIcon_order").attr("data-index"),
        d = SFSI("#sfsi_plus_pinterestIcon_order").attr("data-index"),
        I = SFSI("#sfsi_plus_instagramIcon_order").attr("data-index"),
        tl = SFSI("#sfsi_plus_telegramIcon_order").attr("data-index"),
        vki = SFSI("#sfsi_plus_vkIcon_order").attr("data-index"),
        ok = SFSI("#sfsi_plus_okIcon_order").attr("data-index"),
        weibo = SFSI("#sfsi_plus_weiboIcon_order").attr("data-index"),
        wechat = SFSI("#sfsi_plus_wechatIcon_order").attr("data-index"),
        F = SFSI("#sfsi_plus_linkedinIcon_order").attr("data-index"),
        houzzOrder = SFSI("#sfsi_plus_houzzIcon_order").attr("data-index"),
        h = new Array();

    SFSI(".sfsiplus_custom_iconOrder").each(function () {
        h.push({
            order: SFSI(this).attr("data-index"),
            ele: SFSI(this).attr("element-id")
        });
    });
    var v = 1 == SFSI("input[name='sfsi_plus_rss_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_rss_MouseOverText']").val(),
        g = 1 == SFSI("input[name='sfsi_plus_email_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_email_MouseOverText']").val(),
        k = 1 == SFSI("input[name='sfsi_plus_twitter_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_twitter_MouseOverText']").val(),
        y = 1 == SFSI("input[name='sfsi_plus_facebook_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_facebook_MouseOverText']").val(),
        w = 1 == SFSI("input[name='sfsi_plus_linkedIn_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_linkedIn_MouseOverText']").val(),
        x = 1 == SFSI("input[name='sfsi_plus_youtube_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_youtube_MouseOverText']").val(),
        C = 1 == SFSI("input[name='sfsi_plus_pinterest_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_pinterest_MouseOverText']").val(),
        insD = 1 == SFSI("input[name='sfsi_plus_instagram_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_instagram_MouseOverText']").val(),
        tl = 1 == SFSI("input[name='sfsi_plus_telegram_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_telegram_MouseOverText']").val(),
        vk = 1 == SFSI("input[name='sfsi_plus_vk_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_vk_MouseOverText']").val(),
        D = 1 == SFSI("input[name='sfsi_plus_houzz_MouseOverText']").prop("disabled") ? "" : SFSI("input[name='sfsi_plus_houzz_MouseOverText']").val(),
        O = {};
    SFSI("input[name='sfsi_plus_custom_MouseOverTexts[]']").each(function () {
        O[SFSI(this).attr("file-id")] = this.value;
    });

    var sfsi_plus_custom_social_hide = SFSI("input[name='sfsi_plus_custom_social_hide']").val();
    var se = SFSI("input[name='sfsi_pplus_icons_suppress_errors']:checked").val();
    st = SFSI("input[name='sfsi_plus_icons_sharing_and_traffic_tips']:checked").val();

    var T = {
        action: "plus_updateSrcn5",
        sfsi_plus_icons_size: i,
        sfsi_plus_icons_Alignment: n,
        sfsi_plus_icons_perRow: e,
        sfsi_plus_follow_icons_language: followicon,
        sfsi_plus_facebook_icons_language: facebookicon,
        sfsi_plus_twitter_icons_language: twittericon,
        sfsi_plus_icons_language: lang,
        sfsi_plus_icons_spacing: t,
        sfsi_plus_icons_ClickPageOpen: o,
        sfsi_plus_icons_float: a,
        sfsi_plus_disable_floaticons: dsb,
        sfsi_plus_disable_viewport: dsbv,
        sfsi_plus_icons_floatPosition: r,
        sfsi_plus_icons_stick: c,
        sfsi_plus_rss_MouseOverText: v,
        sfsi_plus_email_MouseOverText: g,
        sfsi_plus_twitter_MouseOverText: k,
        sfsi_plus_facebook_MouseOverText: y,
        sfsi_plus_youtube_MouseOverText: x,
        sfsi_plus_linkedIn_MouseOverText: w,
        sfsi_plus_pinterest_MouseOverText: C,
        sfsi_plus_instagram_MouseOverText: insD,
        sfsi_plus_telegram_MouseOverText: tl,
        sfsi_plus_vk_MouseOverText: vki,
        sfsi_plus_houzz_MouseOverText: D,
        sfsi_plus_custom_MouseOverTexts: O,
        sfsi_plus_rssIcon_order: p,
        sfsi_plus_emailIcon_order: _,
        sfsi_plus_facebookIcon_order: S,
        sfsi_plus_twitterIcon_order: u,
        sfsi_plus_youtubeIcon_order: f,
        sfsi_plus_pinterestIcon_order: d,
        sfsi_plus_instagramIcon_order: I,
        sfsi_plus_telegramIcon_order: tl,
        sfsi_plus_vkIcon_order: vki,
        sfsi_plus_okIcon_order: ok,
        sfsi_plus_weiboIcon_order: weibo,
        sfsi_plus_wechatIcon_order: wechat,
        sfsi_plus_houzzIcon_order: houzzOrder,
        sfsi_plus_linkedinIcon_order: F,
        sfsi_plus_custom_orders: h,
        sfsi_plus_custom_social_hide: sfsi_plus_custom_social_hide,
        sfsi_pplus_icons_suppress_errors: se,
        sfsi_plus_icons_sharing_and_traffic_tips:st,
        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: T,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 5);
                global_error = 1;
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 5), sfsipluscollapse("#sfsi_plus_save5")) : (global_error = 1,
                    sfsiplus_showErrorSuc("error", "Unkown error , please try again", 5)), sfsiplus_afterLoad();
            }
        }
    });
}

function sfsi_plus_update_step6() {
    var nonce = SFSI("#sfsi_plus_save6").attr("data-nonce");
    sfsiplus_beForeLoad();
    var s = SFSI("input[name='sfsi_plus_show_Onposts']:checked").val(),
        i = SFSI("input[name='sfsi_plus_textBefor_icons']").val(),
        e = SFSI("#sfsi_plus_icons_alignment").val(),
        t = SFSI("#sfsi_plus_icons_DisplayCounts").val(),
        n = {
            action: "plus_updateSrcn6",
            sfsi_plus_show_Onposts: s,
            sfsi_plus_icons_DisplayCounts: t,
            sfsi_plus_icons_alignment: e,
            sfsi_plus_textBefor_icons: i,
            nonce: nonce
        };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: n,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
                global_error = 1;
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 6), sfsipluscollapse("#sfsi_plus_save6")) : (global_error = 1,
                    sfsiplus_showErrorSuc("error", "Unkown error , please try again", 6)), sfsiplus_afterLoad();
            }
        }
    });
}

function sfsi_plus_save_export() {
    var nonce = SFSI("#sfsi_plus_save_export").attr("data-nonce");
    var data = {
        action: "save_export",
        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: data,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
                global_error = 1;
            } else {
                var date = new Date();
                var timestamp = date.getTime();
                var blob = new Blob([JSON.stringify(s, null, 2)], {
                    type: 'application/json'
                });
                var url = URL.createObjectURL(blob);
                let link = document.createElement("a");
                link.href = url;
                link.download = "sfsi_plus_export_options" + timestamp + ".json"
                link.innerText = "Open the array URL";
                document.body.appendChild(link);
                link.click();
                (sfsiplus_showErrorSuc("Settings Exported !", "Settings Exported !", 10))
            }
        }
    });
}

function sfsi_plus_update_step7() {
    var nonce = SFSI("#sfsi_plus_save7").attr("data-nonce");
    var s = sfsi_plus_validationStep7();
    if (!s) return global_error = 1, !1;
    sfsiplus_beForeLoad();
    var i = SFSI("input[name='sfsi_plus_popup_text']").val(),
        e = SFSI("#sfsi_plus_popup_font option:selected").val(),
        t = (SFSI("#sfsi_plus_popup_fontStyle option:selected").val(),
            SFSI("input[name='sfsi_plus_popup_fontColor']").val()),
        n = SFSI("input[name='sfsi_plus_popup_fontSize']").val(),
        o = SFSI("input[name='sfsi_plus_popup_background_color']").val(),
        a = SFSI("input[name='sfsi_plus_popup_border_color']").val(),
        r = SFSI("input[name='sfsi_plus_popup_border_thickness']").val(),
        c = SFSI("input[name='sfsi_plus_popup_border_shadow']:checked").val(),
        p = SFSI("input[name='sfsi_plus_Show_popupOn']:checked").val(),
        _ = [];
    SFSI("#sfsi_plus_Show_popupOn_PageIDs :selected").each(function (s, i) {
        _[s] = SFSI(i).val();
    });
    var l = SFSI("input[name='sfsi_plus_Shown_pop']:checked").val(),
        S = SFSI("input[name='sfsi_plus_Shown_popupOnceTime']").val(),
        u = SFSI("#sfsi_plus_Shown_popuplimitPerUserTime").val(),
        f = {
            action: "plus_updateSrcn7",
            sfsi_plus_popup_text: i,
            sfsi_plus_popup_font: e,
            sfsi_plus_popup_fontColor: t,
            sfsi_plus_popup_fontSize: n,
            sfsi_plus_popup_background_color: o,
            sfsi_plus_popup_border_color: a,
            sfsi_plus_popup_border_thickness: r,
            sfsi_plus_popup_border_shadow: c,
            sfsi_plus_Show_popupOn: p,
            sfsi_plus_Show_popupOn_PageIDs: _,
            sfsi_plus_Shown_pop: l,
            sfsi_plus_Shown_popupOnceTime: S,
            sfsi_plus_Shown_popuplimitPerUserTime: u,
            nonce: nonce
        };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: f,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 7);
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 7), sfsipluscollapse("#sfsi_plus_save7")) : sfsiplus_showErrorSuc("error", "Unkown error , please try again", 7),
                    sfsiplus_afterLoad();
            }
        }
    });
}

function sfsi_plus_update_step8() {
    var nonce = SFSI("#sfsi_plus_save8").attr("data-nonce");
    var s = sfsi_plus_validationStep7();
    s = true;
    if (!s) return global_error = 1, !1;
    sfsiplus_beForeLoad();
    var i = SFSI("input[name='sfsi_plus_show_via_widget']:checked").val(),
        e = SFSI("input[name='sfsi_plus_float_on_page']:checked").val(),
        t = SFSI("input[name='sfsi_plus_float_page_position']:checked").val(),
        n = SFSI("input[name='sfsi_plus_place_item_manually']:checked").val(),
        o = SFSI("input[name='sfsi_plus_show_item_onposts']:checked").val(),
        a = SFSI("input[name='sfsi_plus_display_button_type']:checked").val(),
        r = SFSI("input[name='sfsi_plus_post_icons_size']").val(),
        c = SFSI("input[name='sfsi_plus_post_icons_spacing']").val(),
        p = SFSI("input[name='sfsi_plus_show_Onposts']:checked").val(),
        v = SFSI("input[name='sfsi_plus_textBefor_icons']").val(),
        x = SFSI("#sfsi_plus_icons_alignment").val(),
        z = SFSI("#sfsi_plus_icons_DisplayCounts").val(),
        b = SFSI("input[name='sfsi_plus_display_before_posts']:checked").val(),
        d = SFSI("input[name='sfsi_plus_display_after_posts']:checked").val(),
        /*f = SFSI("input[name='sfsi_plus_display_on_postspage']:checked").val(),
        g = SFSI("input[name='sfsi_plus_display_on_homepage']:checked").val(),*/
        f = SFSI("input[name='sfsi_plus_display_before_blogposts']:checked").val(),
        g = SFSI("input[name='sfsi_plus_display_after_blogposts']:checked").val(),
        rsub = SFSI("input[name='sfsi_plus_rectsub']:checked").val(),
        rfb = SFSI("input[name='sfsi_plus_rectfb']:checked").val(),
        rtwr = SFSI("input[name='sfsi_plus_recttwtr']:checked").val(),
        rpin = SFSI("input[name='sfsi_plus_rectpinit']:checked").val(),
        rfbshare = SFSI("input[name='sfsi_plus_rectfbshare']:checked").val(),
        _ = [];
    var sfsi_plus_responsive_icons_end_post = SFSI('input[name="sfsi_plus_responsive_icons_end_post"]:checked').val() || 'no'

    var responsive_icons = {
        "default_icons": {},
        "settings": {}
    };
    SFSI('.sfsi_plus_responsive_default_icon_container input[type="checkbox"]').each(function (index, obj) {
        var data_obj = {};
        data_obj.active = ('checked' == SFSI(obj).attr('checked')) ? 'yes' : 'no';
        var iconname = SFSI(obj).attr('data-icon');
        var next_section = SFSI(obj).parent().parent();
        data_obj.text = next_section.find('input[name="sfsi_plus_responsive_' + iconname + '_input"]').val();
        data_obj.url = next_section.find('input[name="sfsi_plus_responsive_' + iconname + '_url_input"]').val();
        responsive_icons.default_icons[iconname] = data_obj;
    });
    SFSI('.sfsi_plus_responsive_custom_icon_container input[type="checkbox"]').each(function (index, obj) {
        if (SFSI(obj).attr('id') != "sfsi_plus_responsive_custom_new_display") {
            var data_obj = {};
            data_obj.active = 'checked' == SFSI(obj).attr('checked') ? 'yes' : 'no';
            var icon_index = SFSI(obj).attr('data-custom-index');
            var next_section = SFSI(obj).parent().parent();
            data_obj['added'] = SFSI('input[name="sfsi_plus_responsive_custom_' + index + '_added"]').val();
            data_obj.icon = next_section.find('img').attr('src');
            data_obj["bg-color"] = next_section.find('.sfsi_plus_bg-color-picker').val();

            data_obj.text = next_section.find('input[name="sfsi_plus_responsive_custom_' + icon_index + '_input"]').val();
            data_obj.url = next_section.find('input[name="sfsi_plus_responsive_custom_' + icon_index + '_url_input"]').val();
            responsive_icons.custom_icons[index] = data_obj;
        }
    });
    responsive_icons.settings.icon_size = SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_size"]').val();
    responsive_icons.settings.icon_width_type = SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val();
    responsive_icons.settings.icon_width_size = SFSI('input[name="sfsi_plus_responsive_icons_sttings_icon_width_size"]').val();
    responsive_icons.settings.edge_type = SFSI('select[name="sfsi_plus_responsive_icons_settings_edge_type"]').val();
    responsive_icons.settings.edge_radius = SFSI('select[name="sfsi_plus_responsive_icons_settings_edge_radius"]').val();
    responsive_icons.settings.style = SFSI('select[name="sfsi_plus_responsive_icons_settings_style"]').val();
    responsive_icons.settings.margin = SFSI('input[name="sfsi_plus_responsive_icons_settings_margin"]').val();
    responsive_icons.settings.text_align = SFSI('select[name="sfsi_plus_responsive_icons_settings_text_align"]').val();
    responsive_icons.settings.show_count = SFSI('input[name="sfsi_plus_responsive_icon_show_count"]:checked').val();
    responsive_icons.settings.counter_color = SFSI('input[name="sfsi_plus_responsive_counter_color"]').val();
    responsive_icons.settings.counter_bg_color = SFSI('input[name="sfsi_plus_responsive_counter_bg_color"]').val();
    responsive_icons.settings.share_count_text = SFSI('input[name="sfsi_plus_responsive_counter_share_count_text"]').val();
    responsive_icons.settings.margin_above = SFSI('input[name="sfsi_plus_responsive_icons_settings_margin_above"]').val();
    responsive_icons.settings.margin_below = SFSI('input[name="sfsi_plus_responsive_icons_settings_margin_below"]').val();

    var mst = SFSI("input[name='sfsi_plus_icons_floatMargin_top']").val(),
        msb = SFSI("input[name='sfsi_plus_icons_floatMargin_bottom']").val(),
        msl = SFSI("input[name='sfsi_plus_icons_floatMargin_left']").val(),
        msr = SFSI("input[name='sfsi_plus_icons_floatMargin_right']").val();

    var f = {
        action: "plus_updateSrcn8",
        sfsi_plus_show_via_widget: i,
        sfsi_plus_float_on_page: e,
        sfsi_plus_float_page_position: t,
        sfsi_plus_icons_floatMargin_top: mst,
        sfsi_plus_icons_floatMargin_bottom: msb,
        sfsi_plus_icons_floatMargin_left: msl,
        sfsi_plus_icons_floatMargin_right: msr,
        sfsi_plus_place_item_manually: n,
        sfsi_plus_place_item_gutenberg: SFSI("input[name='sfsi_plus_place_item_gutenberg']:checked").val(),
        sfsi_plus_show_item_onposts: o,
        sfsi_plus_display_button_type: a,
        sfsi_plus_post_icons_size: r,
        sfsi_plus_post_icons_spacing: c,
        sfsi_plus_show_Onposts: p,
        sfsi_plus_textBefor_icons: v,
        sfsi_plus_icons_alignment: x,
        sfsi_plus_icons_DisplayCounts: z,
        sfsi_plus_display_before_posts: b,
        sfsi_plus_display_after_posts: d,
        /*sfsi_plus_display_on_postspage: f,
        sfsi_plus_display_on_homepage: g*/
        sfsi_plus_display_before_blogposts: f,
        sfsi_plus_display_after_blogposts: g,
        sfsi_plus_rectsub: rsub,
        sfsi_plus_rectfb: rfb,
        sfsi_plus_recttwtr: rtwr,
        sfsi_plus_rectpinit: rpin,
        sfsi_plus_rectfbshare: rfbshare,
        sfsi_plus_responsive_icons: responsive_icons,
        sfsi_plus_responsive_icons_end_post: sfsi_plus_responsive_icons_end_post,

        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: f,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 8);
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 8), sfsipluscollapse("#sfsi_plus_save8")) : sfsiplus_showErrorSuc("error", "Unkown error , please try again", 8), sfsiplus_afterLoad()
            }
        }
    })
}

function sfsi_plus_update_step9() {
    var nonce = SFSI("#sfsi_plus_save9").attr("data-nonce");
    sfsiplus_beForeLoad();
    var ie = SFSI("input[name='sfsi_plus_form_adjustment']:checked").val(),
        je = SFSI("input[name='sfsi_plus_form_height']").val(),
        ke = SFSI("input[name='sfsi_plus_form_width']").val(),
        le = SFSI("input[name='sfsi_plus_form_border']:checked").val(),
        me = SFSI("input[name='sfsi_plus_form_border_thickness']").val(),
        ne = SFSI("input[name='sfsi_plus_form_border_color']").val(),
        oe = SFSI("input[name='sfsi_plus_form_background']").val(),

        ae = SFSI("input[name='sfsi_plus_form_heading_text']").val(),
        be = SFSI("#sfsi_plus_form_heading_font option:selected").val(),
        ce = SFSI("#sfsi_plus_form_heading_fontstyle option:selected").val(),
        de = SFSI("input[name='sfsi_plus_form_heading_fontcolor']").val(),
        ee = SFSI("input[name='sfsi_plus_form_heading_fontsize']").val(),
        fe = SFSI("#sfsi_plus_form_heading_fontalign option:selected").val(),

        ue = SFSI("input[name='sfsi_plus_form_field_text']").val(),
        ve = SFSI("#sfsi_plus_form_field_font option:selected").val(),
        we = SFSI("#sfsi_plus_form_field_fontstyle option:selected").val(),
        xe = SFSI("input[name='sfsi_plus_form_field_fontcolor']").val(),
        ye = SFSI("input[name='sfsi_plus_form_field_fontsize']").val(),
        ze = SFSI("#sfsi_plus_form_field_fontalign option:selected").val(),

        i = SFSI("input[name='sfsi_plus_form_button_text']").val(),
        j = SFSI("#sfsi_plus_form_button_font option:selected").val(),
        k = SFSI("#sfsi_plus_form_button_fontstyle option:selected").val(),
        l = SFSI("input[name='sfsi_plus_form_button_fontcolor']").val(),
        m = SFSI("input[name='sfsi_plus_form_button_fontsize']").val(),
        n = SFSI("#sfsi_plus_form_button_fontalign option:selected").val(),
        o = SFSI("input[name='sfsi_plus_form_button_background']").val();

    var f = {
        action: "plus_updateSrcn9",
        sfsi_plus_form_adjustment: ie,
        sfsi_plus_form_height: je,
        sfsi_plus_form_width: ke,
        sfsi_plus_form_border: le,
        sfsi_plus_form_border_thickness: me,
        sfsi_plus_form_border_color: ne,
        sfsi_plus_form_background: oe,

        sfsi_plus_form_heading_text: ae,
        sfsi_plus_form_heading_font: be,
        sfsi_plus_form_heading_fontstyle: ce,
        sfsi_plus_form_heading_fontcolor: de,
        sfsi_plus_form_heading_fontsize: ee,
        sfsi_plus_form_heading_fontalign: fe,

        sfsi_plus_form_field_text: ue,
        sfsi_plus_form_field_font: ve,
        sfsi_plus_form_field_fontstyle: we,
        sfsi_plus_form_field_fontcolor: xe,
        sfsi_plus_form_field_fontsize: ye,
        sfsi_plus_form_field_fontalign: ze,

        sfsi_plus_form_button_text: i,
        sfsi_plus_form_button_font: j,
        sfsi_plus_form_button_fontstyle: k,
        sfsi_plus_form_button_fontcolor: l,
        sfsi_plus_form_button_fontsize: m,
        sfsi_plus_form_button_fontalign: n,
        sfsi_plus_form_button_background: o,

        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: f,
        dataType: "json",
        async: !0,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 9);
                sfsiplus_afterLoad();
            } else {
                "success" == s ? (sfsiplus_showErrorSuc("success", "Saved !", 9), sfsipluscollapse("#sfsi_plus_save9"), sfsi_plus_create_suscriber_form()) : sfsiplus_showErrorSuc("error", "Unkown error , please try again", 9),
                    sfsiplus_afterLoad();
            }
        }
    });
}

function sfsiplus_afterIconSuccess(s, nonce) {
    if (s.res = "success") {
        var i = s.key + 1,
            e = s.element,
            t = e + 1;
        SFSI("#plus_total_cusotm_icons").val(s.element);
        SFSI(".upload-overlay").hide("slow");
        SFSI(".uperror").html("");
        sfsiplus_showErrorSuc("success", "Custom Icon updated successfully", 1);
        d = new Date();

        SFSI("li.plus_custom:last-child").removeClass("bdr_btm_non");
        SFSI("li.plus_custom:last-child").children("span.plus_custom-img").children("img").attr("src", s.img_path + "?" + d.getTime());
        SFSI("input[name=plussfsiICON_" + s.key + "]").removeAttr("ele-type");
        SFSI("input[name=plussfsiICON_" + s.key + "]").removeAttr("isnew");
        icons_name = SFSI("li.plus_custom:last-child").find("input.styled").attr("name");
        var n = icons_name.split("_");
        s.key = s.key, s.img_path += "?" + d.getTime(), 5 > e && SFSI(".plus_icn_listing").append('<li id="plus_c' + i + '" class="plus_custom bdr_btm_non"><div class="radio_section tb_4_ck"><span class="checkbox" dynamic_ele="yes" style="background-position: 0px 0px;"></span><input name="plussfsiICON_' + i + '"  type="checkbox" value="yes" class="styled" style="display:none;" element-type="sfsiplus-cusotm-icon" isNew="yes" /></div> <span class="plus_custom-img"><img src="' + SFSI("#plugin_url").val() + 'images/custom.png" id="plus_CImg_' + i + '"  /> </span> <span class="custom sfsiplus_custom-txt">Custom' + t + ' </span> <div class="sfsiplus_right_info"> <p><span>' + object_name1.It_depends + ':</span> ' + object_name1.Upload_a + '</p><div class="inputWrapper"></div></li>'),
            SFSI(".sfsiplus_custom_section").show(), SFSI(".plus_custom-links").append(' <div class="row  sfsiICON_' + s.key + ' cm_lnk"> <h2 class="custom"> <span class="customstep2-img"> <img   src="' + s.img_path + "?" + d.getTime() + '" style="border-radius:48%" /> </span> <span class="sfsiCtxt">Custom ' + e + '</span> </h2> <div class="inr_cont "><p>Where do you want this icon to link to?</p> <p class="radio_section fb_url sfsiplus_custom_section  sfsiICON_' + s.key + '" ><label>Link :</label><input file-id="' + s.key + '" name="sfsi_plus_CustomIcon_links[]" type="text" value="" placeholder="http://" class="add" /></p></div></div>');
        var o = SFSI("div.plus_custom_m").find("div.mouseover_field").length;
        SFSI("div.plus_custom_m").append(0 == o % 2 ? '<div class="clear"> </div> <div class="mouseover_field sfsiplus_custom_section sfsiICON_' + s.key + '"><label>Custom ' + e + ':</label><input name="sfsi_plus_custom_MouseOverTexts[]" value="" type="text" file-id="' + s.key + '" /></div>' : '<div class="cHover " ><div class="mouseover_field sfsiplus_custom_section sfsiICON_' + s.key + '"><label>Custom ' + e + ':</label><input name="sfsi_plus_custom_MouseOverTexts[]" value="" type="text" file-id="' + s.key + '" /></div>'),
            SFSI("ul.plus_share_icon_order").append('<li class="sfsiplus_custom_iconOrder sfsiICON_' + s.key + '" data-index="" element-id="' + s.key + '" id=""><a href="#" title="Custom Icon" ><img src="' + s.img_path + '" alt="Linked In" class="sfcm"/></a></li>'),
            SFSI("ul.plus_sfsi_sample_icons").append('<li class="sfsiICON_' + s.key + '" element-id="' + s.key + '" ><div><img src="' + s.img_path + '" alt="Linked In" class="sfcm"/><span class="sfsi_Cdisplay">12k</span></div></li>'),

            SFSI('.banner_custom_icon').show();
        SFSI("#plus_c" + s.key).append('<input type="hidden" name="nonce" value="' + nonce + '">');
        sfsi_plus_update_index(), plus_update_Sec5Iconorder(), sfsi_plus_update_step1(), sfsi_plus_update_step2(),
            sfsi_plus_update_step5(), SFSI(".upload-overlay").css("pointer-events", "auto"), sfsi_plus_showPreviewCounts(),
            sfsiplus_afterLoad();
    }
}

function sfsiplus_beforeIconSubmit(s) {
    if (SFSI(".uperror").html("Uploading....."), window.File && window.FileReader && window.FileList && window.Blob) {
        SFSI(s).val() || SFSI(".uperror").html("File is empty");
        var i = s.files[0].size,
            e = s.files[0].type;
        switch (e) {
            case "image/png":
            case "image/gif":
            case "image/jpeg":
            case "image/pjpeg":
                break;

            default:
                return SFSI(".uperror").html("Unsupported file"), !1;
        }
        return i > 1048576 ? (SFSI(".uperror").html("Image should be less than 1 MB"), !1) : !0;
    }
    return !0;
}

function sfsiplus_bytesToSize(s) {
    var i = ["Bytes", "KB", "MB", "GB", "TB"];
    if (0 == s) return "0 Bytes";
    var e = parseInt(Math.floor(Math.log(s) / Math.log(1024)));
    return Math.round(s / Math.pow(1024, e), 2) + " " + i[e];
}

function sfsiplus_showErrorSuc(s, i, e) {
    if ("error" == s) var t = "errorMsg";
    else var t = "sucMsg";
    return SFSI(".tab" + e + ">." + t).html(i), SFSI(".tab" + e + ">." + t).show(),
        SFSI(".tab" + e + ">." + t).effect("highlight", {}, 5e3), setTimeout(function () {
            SFSI("." + t).slideUp("slow");
        }, 5e3), !1;
}

function sfsiplus_beForeLoad() {
    SFSI(".loader-img").show(), SFSI(".save_button >a").html("Saving..."), SFSI(".save_button >a").css("pointer-events", "none");
}

function sfsiplus_afterLoad() {
    SFSI("input").removeClass("inputError"), SFSI(".save_button >a").html(object_name.Sa_ve),
        SFSI(".tab10>div.save_button >a").html(object_name1.Save_All_Settings),
        SFSI(".save_button >a").css("pointer-events", "auto"), SFSI(".save_button >a").removeAttr("onclick"),
        SFSI(".loader-img").hide();
}

function sfsi_plus_make_popBox() {
    var s = 0;
    SFSI(".plus_sfsi_sample_icons >li").each(function () {
            "none" != SFSI(this).css("display") && (s = 1);
        }), 0 == s ? SFSI(".sfsi_plus_Popinner").hide() : SFSI(".sfsi_plus_Popinner").show(), "" != SFSI('input[name="sfsi_plus_popup_text"]').val() ? (SFSI(".sfsi_plus_Popinner >h2").html(SFSI('input[name="sfsi_plus_popup_text"]').val()),
            SFSI(".sfsi_plus_Popinner >h2").show()) : SFSI(".sfsi_plus_Popinner >h2").hide(), SFSI(".sfsi_plus_Popinner").css({
            "border-color": SFSI('input[name="sfsi_plus_popup_border_color"]').val(),
            "border-width": SFSI('input[name="sfsi_plus_popup_border_thickness"]').val(),
            "border-style": "solid"
        }), SFSI(".sfsi_plus_Popinner").css("background-color", SFSI('input[name="sfsi_plus_popup_background_color"]').val()),
        SFSI(".sfsi_plus_Popinner h2").css("font-family", SFSI("#sfsi_plus_popup_font").val()), SFSI(".sfsi_plus_Popinner h2").css("font-style", SFSI("#sfsi_plus_popup_fontStyle").val()),
        SFSI(".sfsi_plus_Popinner >h2").css("font-size", parseInt(SFSI('input[name="sfsi_plus_popup_fontSize"]').val())),
        SFSI(".sfsi_plus_Popinner >h2").css("color", SFSI('input[name="sfsi_plus_popup_fontColor"]').val() + " !important"),
        "yes" == SFSI('input[name="sfsi_plus_popup_border_shadow"]:checked').val() ? SFSI(".sfsi_plus_Popinner").css("box-shadow", "12px 30px 18px #CCCCCC") : SFSI(".sfsi_plus_Popinner").css("box-shadow", "none");
}

function sfsi_plus_stick_widget(s) {
    0 == sfsiplus_initTop.length && (SFSI(".sfsi_plus_widget").each(function (s) {
        sfsiplus_initTop[s] = SFSI(this).position().top;
    }));
    var i = SFSI(window).scrollTop(),
        e = [],
        t = [];
    SFSI(".sfsi_plus_widget").each(function (s) {
        e[s] = SFSI(this).position().top, t[s] = SFSI(this);
    });
    var n = !1;
    for (var o in e) {
        var a = parseInt(o) + 1;
        e[o] < i && e[a] > i && a < e.length ? (SFSI(t[o]).css({
            position: "fixed",
            top: s
        }), SFSI(t[a]).css({
            position: "",
            top: sfsiplus_initTop[a]
        }), n = !0) : SFSI(t[o]).css({
            position: "",
            top: sfsiplus_initTop[o]
        });
    }
    if (!n) {
        var r = e.length - 1,
            c = -1;
        e.length > 1 && (c = e.length - 2), sfsiplus_initTop[r] < i ? (SFSI(t[r]).css({
            position: "fixed",
            top: s
        }), c >= 0 && SFSI(t[c]).css({
            position: "",
            top: sfsiplus_initTop[c]
        })) : (SFSI(t[r]).css({
            position: "",
            top: sfsiplus_initTop[r]
        }), c >= 0 && e[c] < i);
    }
}

function sfsi_plus_setCookie(s, i, e) {
    var t = new Date();
    t.setTime(t.getTime() + 1e3 * 60 * 60 * 24 * e);
    var n = "expires=" + t.toGMTString();
    document.cookie = s + "=" + i + "; " + n;
}

function sfsfi_plus_getCookie(s) {
    for (var i = s + "=", e = document.cookie.split(";"), t = 0; t < e.length; t++) {
        var n = e[t].trim();
        if (0 == n.indexOf(i)) return n.substring(i.length, n.length);
    }
    return "";
}

function sfsi_plus_hideFooter() {}

window.onerror = function () {}, SFSI = jQuery.noConflict(), SFSI(window).on('load', function () {
    SFSI("#sfpluspageLoad").fadeOut(2e3);
});

//changes done {Monad}
function sfsi_plus_selectText(containerid) {
    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
    } else if (window.getSelection()) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
    }
}

function sfsi_plus_create_suscriber_form() {
    //Popbox customization
    "no" == SFSI('input[name="sfsi_plus_form_adjustment"]:checked').val() ? SFSI(".sfsi_plus_subscribe_Popinner").css({
        "width": parseInt(SFSI('input[name="sfsi_plus_form_width"]').val()),
        "height": parseInt(SFSI('input[name="sfsi_plus_form_height"]').val())
    }) : SFSI(".sfsi_plus_subscribe_Popinner").css({
        "width": '',
        "height": ''
    });

    "yes" == SFSI('input[name="sfsi_plus_form_adjustment"]:checked').val() ? SFSI(".sfsi_plus_html > .sfsi_plus_subscribe_Popinner").css({
        "width": "100%"
    }) : '';

    "yes" == SFSI('input[name="sfsi_plus_form_border"]:checked').val() ? SFSI(".sfsi_plus_subscribe_Popinner").css({
        "border": SFSI('input[name="sfsi_plus_form_border_thickness"]').val() + "px solid " + SFSI('input[name="sfsi_plus_form_border_color"]').val()
    }) : SFSI(".sfsi_plus_subscribe_Popinner").css("border", "none");

    SFSI('input[name="sfsi_plus_form_background"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").css("background-color", SFSI('input[name="sfsi_plus_form_background"]').val())) : '';

    //Heading customization
    SFSI('input[name="sfsi_plus_form_heading_text"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").html(SFSI('input[name="sfsi_plus_form_heading_text"]').val())) : SFSI(".sfsi_plus_subscribe_Popinner > form > h5").html('');

    SFSI('#sfsi_plus_form_heading_font').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("font-family", SFSI("#sfsi_plus_form_heading_font").val())) : '';

    if (SFSI('#sfsi_plus_form_heading_fontstyle').val() != 'bold') {
        SFSI('#sfsi_plus_form_heading_fontstyle').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("font-style", SFSI("#sfsi_plus_form_heading_fontstyle").val())) : '';
        SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("font-weight", '');
    } else {
        SFSI('#sfsi_plus_form_heading_fontstyle').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("font-weight", "bold")) : '';
        SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("font-style", '');
    }

    SFSI('input[name="sfsi_plus_form_heading_fontcolor"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("color", SFSI('input[name="sfsi_plus_form_heading_fontcolor"]').val())) : '';

    SFSI('input[name="sfsi_plus_form_heading_fontsize"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css({
        "font-size": parseInt(SFSI('input[name="sfsi_plus_form_heading_fontsize"]').val())
    })) : '';

    SFSI('#sfsi_plus_form_heading_fontalign').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner > form > h5").css("text-align", SFSI("#sfsi_plus_form_heading_fontalign").val())) : '';

    //Field customization
    SFSI('input[name="sfsi_plus_form_field_text"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').attr("placeholder", SFSI('input[name="sfsi_plus_form_field_text"]').val())) : SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').attr("placeholder", '');

    SFSI('input[name="sfsi_plus_form_field_text"]').val() != "" ? (SFSI(".sfsi_plus_left_container > .sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').val(SFSI('input[name="sfsi_plus_form_field_text"]').val())) : SFSI(".sfsi_plus_left_container > .sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').val('');

    SFSI('input[name="sfsi_plus_form_field_text"]').val() != "" ? (SFSI(".like_pop_box > .sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').val(SFSI('input[name="sfsi_plus_form_field_text"]').val())) : SFSI(".like_pop_box > .sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').val('');

    SFSI('#sfsi_plus_form_field_font').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-family", SFSI("#sfsi_plus_form_field_font").val())) : '';

    if (SFSI('#sfsi_plus_form_field_fontstyle').val() != "bold") {
        SFSI('#sfsi_plus_form_field_fontstyle').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-style", SFSI("#sfsi_plus_form_field_fontstyle").val())) : '';
        SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-weight", '');
    } else {
        SFSI('#sfsi_plus_form_field_fontstyle').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-weight", 'bold')) : '';
        SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("font-style", '');
    }

    SFSI('input[name="sfsi_plus_form_field_fontcolor"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("color", SFSI('input[name="sfsi_plus_form_field_fontcolor"]').val())) : '';

    SFSI('input[name="sfsi_plus_form_field_fontsize"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css({
        "font-size": parseInt(SFSI('input[name="sfsi_plus_form_field_fontsize"]').val())
    })) : '';

    SFSI('#sfsi_plus_form_field_fontalign').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="data[Widget][email]"]').css("text-align", SFSI("#sfsi_plus_form_field_fontalign").val())) : '';

    //Button customization
    SFSI('input[name="sfsi_plus_form_button_text"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').attr("value", SFSI('input[name="sfsi_plus_form_button_text"]').val())) : '';

    SFSI('#sfsi_plus_form_button_font').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("font-family", SFSI("#sfsi_plus_form_button_font").val())) : '';

    if (SFSI('#sfsi_plus_form_button_fontstyle').val() != "bold") {
        SFSI('#sfsi_plus_form_button_fontstyle').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("font-style", SFSI("#sfsi_plus_form_button_fontstyle").val())) : '';
        SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("font-weight", '');
    } else {
        SFSI('#sfsi_plus_form_button_fontstyle').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("font-weight", 'bold')) : '';
        SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("font-style", '');
    }

    SFSI('input[name="sfsi_plus_form_button_fontcolor"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("color", SFSI('input[name="sfsi_plus_form_button_fontcolor"]').val())) : '';

    SFSI('input[name="sfsi_plus_form_button_fontsize"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css({
        "font-size": parseInt(SFSI('input[name="sfsi_plus_form_button_fontsize"]').val())
    })) : '';

    SFSI('#sfsi_plus_form_button_fontalign').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("text-align", SFSI("#sfsi_plus_form_button_fontalign").val())) : '';

    SFSI('input[name="sfsi_plus_form_button_background"]').val() != "" ? (SFSI(".sfsi_plus_subscribe_Popinner").find('input[name="subscribe"]').css("background-color", SFSI('input[name="sfsi_plus_form_button_background"]').val())) : '';

    var innerHTML = SFSI(".sfsi_plus_html > .sfsi_plus_subscribe_Popinner").html();
    var styleCss = SFSI(".sfsi_plus_html > .sfsi_plus_subscribe_Popinner").attr("style");
    innerHTML = '<div style="' + styleCss + '">' + innerHTML + '</div>';
    SFSI(".sfsi_plus_subscription_html > xmp").html(innerHTML);

    /*var data = {
		action:"getForm",
		heading: SFSI('input[name="sfsi_plus_form_heading_text"]').val(),
		placeholder:SFSI('input[name="sfsi_plus_form_field_text"]').val(),
		button:SFSI('input[name="sfsi_plus_form_button_text"]').val()
	};
	SFSI.ajax({
        url:sfsi_plus_ajax_object.ajax_url,
        type:"post",
        data:data,
        success:function(s) {
			SFSI(".sfsi_plus_subscription_html").html(s);
		}
    });*/
}

var global_error = 0;
SFSI(document).ready(function (s) {
    //changes done {Monad}
    function sfsi_plus_open_admin_section(id) {
        SFSI("#ui-id-" + (id + 1)).show();
        SFSI("#ui-id-" + id).removeClass("ui-corner-all");
        SFSI("#ui-id-" + id).addClass("ui-corner-top");
        SFSI("#ui-id-" + id).addClass("accordion-header-active");
        SFSI("#ui-id-" + id).addClass("ui-state-active");
        SFSI("#ui-id-" + id).attr("aria-expanded", "false");
        SFSI("#ui-id-" + id).attr("aria-selected", "true");

    }
    var sfsi_plus_show_option1 = SFSI('input[name="sfsi_plus_show_via_widget"]:checked').val() || 'no';
    var sfsi_plus_show_option2 = SFSI('input[name="sfsi_plus_float_on_page"]:checked').val() || 'no';
    var sfsi_plus_show_option3 = SFSI('input[name="sfsi_plus_place_item_manually"]:checked').val() || 'no';
    var sfsi_plus_show_option4 = SFSI('input[name="sfsi_plus_show_item_onposts"]:checked').val() || 'no';
    var sfsi_plus_show_option5 = SFSI('input[name="sfsi_plus_place_item_gutenberg"]:checked').val() || 'no';

    var sfsi_plus_analyst_popup = SFSI('#sfsi_plus_analyst_pop').attr('data-status');

    SFSI(document).on("click", "#sfsi_dummy_chat_icon", function () {
        SFSI(".sfsi_plus_wait_container").show();
    });
    SFSI(document).on("click", ".sfsi-notice-dismiss", function () {

        SFSI.ajax({
            url: sfsi_plus_ajax_object.ajax_url,
            type: "post",
            data: {
                action: "sfsi_plus_dismiss_lang_notice"
            },
            success: function (e) {
                if (false != e) {
                    SFSI(".sfsi-notice-dismiss").parent().remove();
                }
            }
        });
    });


    SFSI(".lanOnchange").change(function () {
        var currentDrpdown = SFSI(this).parents(".icons_size");
        var nonce = currentDrpdown.find('select').attr('data-nonce');
        var data = {
            action: "getIconPreview",
            iconValue: SFSI(this).val(),
            nonce: nonce,
            iconname: SFSI(this).attr("data-iconUrl")
        };
        SFSI.ajax({
            url: sfsi_plus_ajax_object.ajax_url,
            type: "post",
            data: data,
            success: function (s) {
                currentDrpdown.children(".social-img-link").html(s);
            }
        });
    });

    SFSI(".sfsiplus_tab_3_icns").on("click", ".cstomskins_upload", function () {
        SFSI(".cstmskins-overlay").show("slow", function () {
            e = 0;
        });
    });
    /*SFSI("#custmskin_clspop").live("click", function() {*/
    SFSI(document).on("click", '#custmskin_clspop', function () {
        var nonce = SFSI(this).attr('data-nonce');
        SFSI_plus_done(nonce);
        SFSI(".cstmskins-overlay").hide("slow");
    });

    sfsi_plus_create_suscriber_form();

    SFSI('input[name="sfsi_plus_form_heading_text"], input[name="sfsi_plus_form_border_thickness"], input[name="sfsi_plus_form_height"], input[name="sfsi_plus_form_width"], input[name="sfsi_plus_form_heading_fontsize"], input[name="sfsi_plus_form_field_text"], input[name="sfsi_plus_form_field_fontsize"], input[name="sfsi_plus_form_button_text"], input[name="sfsi_plus_form_button_fontsize"]').on("keyup", sfsi_plus_create_suscriber_form);

    SFSI('input[name="sfsi_plus_form_border_color"], input[name="sfsi_plus_form_background"] ,input[name="sfsi_plus_form_heading_fontcolor"], input[name="sfsi_plus_form_field_fontcolor"] ,input[name="sfsi_plus_form_button_fontcolor"],input[name="sfsi_plus_form_button_background"]').on("focus", sfsi_plus_create_suscriber_form);

    SFSI("#sfsi_plus_form_heading_font, #sfsi_plus_form_heading_fontstyle, #sfsi_plus_form_heading_fontalign, #sfsi_plus_form_field_font, #sfsi_plus_form_field_fontstyle, #sfsi_plus_form_field_fontalign, #sfsi_plus_form_button_font, #sfsi_plus_form_button_fontstyle, #sfsi_plus_form_button_fontalign").on("change", sfsi_plus_create_suscriber_form);

    /*SFSI(".radio").live("click", function() {*/
    SFSI(document).on("click", '.radio', function () {
        var s = SFSI(this).parent().find("input:radio:first");
        switch (s.attr("name")) {
            case 'sfsi_plus_form_adjustment':
                if (s.val() == 'no')
                    s.parents(".row_tab").next(".row_tab").show("fast");
                else
                    s.parents(".row_tab").next(".row_tab").hide("fast");
                sfsi_plus_create_suscriber_form()
                break;
            case 'sfsi_plus_form_border':
                if (s.val() == 'yes')
                    s.parents(".row_tab").next(".row_tab").show("fast");
                else
                    s.parents(".row_tab").next(".row_tab").hide("fast");
                sfsi_plus_create_suscriber_form()
                break;
            case 'sfsi_pplus_icons_suppress_errors':

                SFSI('input[name="sfsi_pplus_icons_suppress_errors"]').removeAttr('checked');

                if (s.val() == 'yes')
                    SFSI('input[name="sfsi_pplus_icons_suppress_errors"][value="yes"]').prop('checked', 'true');
                else
                    SFSI('input[name="sfsi_pplus_icons_suppress_errors"][value="no"]').prop('checked', 'true');
                break;
            case 'sfsi_plus_responsive_icon_show_count':
                if ("yes" == s.val()) {
                    jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').show();
                } else {
                    jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').hide();
                }
                default:
        }
    });
    //pooja 28-12-2015
    SFSI('#sfsi_plus_form_border_color').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_create_suscriber_form()
            },
            clear: function () {
                sfsi_plus_create_suscriber_form()
            },
            hide: true,
            palettes: true
        }),
        SFSI('#sfsi_plus_form_background').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_create_suscriber_form()
            },
            clear: function () {
                sfsi_plus_create_suscriber_form()
            },
            hide: true,
            palettes: true
        }),
        SFSI('#sfsi_plus_form_heading_fontcolor').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_create_suscriber_form()
            },
            clear: function () {
                sfsi_plus_create_suscriber_form()
            },
            hide: true,
            palettes: true
        }),
        SFSI('#sfsi_plus_form_button_fontcolor').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_create_suscriber_form()
            },
            clear: function () {
                sfsi_plus_create_suscriber_form()
            },
            hide: true,
            palettes: true
        }),
        SFSI('#sfsi_plus_form_button_background').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_create_suscriber_form()
            },
            clear: function () {
                sfsi_plus_create_suscriber_form()
            },
            hide: true,
            palettes: true
        });
    /*SFSI("#sfsiPlusFormBorderColor").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_form_border_color").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_form_border_color").val("#" + i), SFSI("#sfsiPlusFormBorderColor").css("background", "#" + i);
			sfsi_plus_create_suscriber_form();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_popup_background_color").val("#" + i), SFSI("#sfsiPlusFormBorderColor").css("background", "#" + i);
			sfsi_plus_create_suscriber_form();
        }
    }),
	SFSI("#sfsiPlusFormBackground").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_form_background").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_form_background").val("#" + i), SFSI("#sfsiPlusFormBackground").css("background", "#" + i);
			sfsi_plus_create_suscriber_form();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_form_background").val("#" + i), SFSI("#sfsiPlusFormBackground").css("background", "#" + i);
			sfsi_plus_create_suscriber_form();
        }
    }),
	SFSI("#sfsiPlusFormHeadingFontcolor").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_form_heading_fontcolor").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_form_heading_fontcolor").val("#"+i), SFSI("#sfsiPlusFormHeadingFontcolor").css("background","#"+i);
			sfsi_plus_create_suscriber_form();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_form_heading_fontcolor").val("#"+i), SFSI("#sfsiPlusFormHeadingFontcolor").css("background","#"+i);
			sfsi_plus_create_suscriber_form();
        }
    }),
	SFSI("#sfsiPlusFormFieldFontcolor").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_form_field_fontcolor").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_form_field_fontcolor").val("#" + i), SFSI("#sfsiPlusFormFieldFontcolor").css("background", "#" +i);
			sfsi_plus_create_suscriber_form();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_form_field_fontcolor").val("#" + i), SFSI("#sfsiPlusFormFieldFontcolor").css("background", "#" +i);
			sfsi_plus_create_suscriber_form();
        }
    }),
	SFSI("#sfsiPlusFormButtonFontcolor").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_form_button_fontcolor").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_form_button_fontcolor").val("#"+i), SFSI("#sfsiPlusFormButtonFontcolor").css("background", "#"+i);
			sfsi_plus_create_suscriber_form();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_form_button_fontcolor").val("#"+i), SFSI("#sfsiPlusFormButtonFontcolor").css("background", "#"+i);
			sfsi_plus_create_suscriber_form();
        }
    }),
	SFSI("#sfsiPlusFormButtonBackground").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_form_button_background").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_form_button_background").val("#"+i), SFSI("#sfsiPlusFormButtonBackground").css("background","#"+i);
			sfsi_plus_create_suscriber_form();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_form_button_background").val("#"+i), SFSI("#sfsiPlusFormButtonBackground").css("background","#"+i);
			sfsi_plus_create_suscriber_form();
        }
    });*/
    //changes done {Monad}

    function i() {
        SFSI(".uperror").html(""), sfsiplus_afterLoad();
        var s = SFSI('input[name="' + SFSI("#upload_id").val() + '"]');
        s.removeAttr("checked");
        var i = SFSI(s).parent().find("span:first");
        return SFSI(i).css("background-position", "0px 0px"), SFSI(".upload-overlay").hide("slow"),
            !1;
    }
    SFSI("#accordion").accordion({
            collapsible: !0,
            active: !1,
            heightStyle: "content",
            event: "click",
            beforeActivate: function (s, i) {
                if (i.newHeader[0]) var e = i.newHeader,
                    t = e.next(".ui-accordion-content");
                else var e = i.oldHeader,
                    t = e.next(".ui-accordion-content");
                var n = "true" == e.attr("aria-selected");
                return e.toggleClass("ui-corner-all", n).toggleClass("accordion-header-active ui-state-active ui-corner-top", !n).attr("aria-selected", (!n).toString()),
                    e.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", n).toggleClass("ui-icon-triangle-1-s", !n),
                    t.toggleClass("accordion-content-active", !n), n ? t.slideUp() : t.slideDown(), !1;
            }
        }),
        SFSI("#accordion1").accordion({
            collapsible: !0,
            active: !1,
            heightStyle: "content",
            event: "click",
            beforeActivate: function (s, i) {
                if (i.newHeader[0]) var e = i.newHeader,
                    t = e.next(".ui-accordion-content");
                else var e = i.oldHeader,
                    t = e.next(".ui-accordion-content");
                var n = "true" == e.attr("aria-selected");
                return e.toggleClass("ui-corner-all", n).toggleClass("accordion-header-active ui-state-active ui-corner-top", !n).attr("aria-selected", (!n).toString()),
                    e.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", n).toggleClass("ui-icon-triangle-1-s", !n),
                    t.toggleClass("accordion-content-active", !n), n ? t.slideUp() : t.slideDown(), !1;
            }
        }),

        SFSI("#accordion2").accordion({
            collapsible: !0,
            active: !1,
            heightStyle: "content",
            event: "click",
            beforeActivate: function (s, i) {
                if (i.newHeader[0]) var e = i.newHeader,
                    t = e.next(".ui-accordion-content");
                else var e = i.oldHeader,
                    t = e.next(".ui-accordion-content");
                var n = "true" == e.attr("aria-selected");
                return e.toggleClass("ui-corner-all", n).toggleClass("accordion-header-active ui-state-active ui-corner-top", !n).attr("aria-selected", (!n).toString()),
                    e.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", n).toggleClass("ui-icon-triangle-1-s", !n),
                    t.toggleClass("accordion-content-active", !n), n ? t.slideUp() : t.slideDown(), !1;
            }
        }),
        SFSI(".closeSec").on("click", function () {
            var s = !0,
                i = SFSI(this).closest("div.ui-accordion-content").prev("h3.ui-accordion-header").first(),
                e = SFSI(this).closest("div.ui-accordion-content").first();
            i.toggleClass("ui-corner-all", s).toggleClass("accordion-header-active ui-state-active ui-corner-top", !s).attr("aria-selected", (!s).toString()),
                i.children(".ui-icon").toggleClass("ui-icon-triangle-1-e", s).toggleClass("ui-icon-triangle-1-s", !s),
                e.toggleClass("accordion-content-active", !s), s ? e.slideUp() : e.slideDown();
        }),
        SFSI(document).click(function (s) {
            var i = SFSI(".sfsi_plus_FrntInner"),
                e = SFSI(".sfsi_plus_wDiv"),
                t = SFSI("#at15s");
            i.is(s.target) || 0 !== i.has(s.target).length || e.is(s.target) || 0 !== e.has(s.target).length || t.is(s.target) || 0 !== t.has(s.target).length || i.fadeOut();
        }),

        //pooja 28-12-2015
        SFSI('#sfsi_plus_popup_background_color').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_make_popBox()
            },
            clear: function () {
                sfsi_plus_make_popBox()
            },
            hide: true,
            palettes: true
        }),
        SFSI('#sfsi_plus_popup_border_color').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_make_popBox()
            },
            clear: function () {
                sfsi_plus_make_popBox()
            },
            hide: true,
            palettes: true
        }),
        SFSI('#sfsi_plus_popup_fontColor').wpColorPicker({
            defaultColor: false,
            change: function (event, ui) {
                sfsi_plus_make_popBox()
            },
            clear: function () {
                sfsi_plus_make_popBox()
            },
            hide: true,
            palettes: true
        }),

        /*SFSI("#sfsifontCloroPicker").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_popup_fontColor").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), sfsi_plus_make_popBox(), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_popup_fontColor").val("#" + i), SFSI("#sfsifontCloroPicker").css("background", "#" + i), 
            sfsi_plus_make_popBox();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_popup_fontColor").val("#" + i), SFSI("#sfsifontCloroPicker").css("background", "#" + i), 
            sfsi_plus_make_popBox();
        }
    }),*/
        SFSI("div.sfsiplusid_linkedin").find(".icon4").find("a").find("img").mouseover(function () {
            SFSI(this).attr("src", sfsi_plus_ajax_object.plugin_url + "images/visit_icons/linkedIn_hover.svg");
        }),
        SFSI("div.sfsiplusid_linkedin").find(".icon4").find("a").find("img").mouseleave(function () {
            SFSI(this).attr("src", sfsi_plus_ajax_object.plugin_url + "images/visit_icons/linkedIn.svg");
        }),
        SFSI("div.sfsiplusid_youtube").find(".icon1").find("a").find("img").mouseover(function () {
            SFSI(this).attr("src", sfsi_plus_ajax_object.plugin_url + "images/visit_icons/youtube_hover.svg");
        }),
        SFSI("div.sfsiplusid_youtube").find(".icon1").find("a").find("img").mouseleave(function () {
            SFSI(this).attr("src", sfsi_plus_ajax_object.plugin_url + "images/visit_icons/youtube.svg");
        }),
        SFSI("div.sfsiplusid_facebook").find(".icon1").find("a").find("img").mouseover(function () {
            SFSI(this).css("opacity", "0.9");
        }),
        SFSI("div.sfsiplusid_facebook").find(".icon1").find("a").find("img").mouseleave(function () {
            SFSI(this).css("opacity", "1");
            /*{Monad}*/
        }),
        SFSI("div.sfsiplusid_twitter").find(".cstmicon1").find("a").find("img").mouseover(function () {
            SFSI(this).css("opacity", "0.9");
        }),
        SFSI("div.sfsiplusid_twitter").find(".cstmicon1").find("a").find("img").mouseleave(function () {
            SFSI(this).css("opacity", "1");
        }),

        //pooja 28-12-2015

        /*SFSI("#sfsiBackgroundColorPicker").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_popup_background_color").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_popup_background_color").val("#" + i), SFSI("#sfsiBackgroundColorPicker").css("background","#"+i), 
            sfsi_plus_make_popBox();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_popup_background_color").val("#" + i), SFSI("#sfsiBackgroundColorPicker").css("background","#"+i), 
            sfsi_plus_make_popBox();
        }
    }),
	SFSI("#sfsiBorderColorPicker").ColorPicker({
        color:"#f80000",
        onBeforeShow:function() {
            s(this).ColorPickerSetColor(SFSI("#sfsi_plus_popup_border_color").val());
        },
        onShow:function(s) {
            return SFSI(s).fadeIn(500), !1;
        },
        onHide:function(s) {
            return SFSI(s).fadeOut(500), !1;
        },
        onChange:function(s, i) {
            SFSI("#sfsi_plus_popup_border_color").val("#" + i), SFSI("#sfsiBorderColorPicker").css("background", "#" + i), 
            sfsi_plus_make_popBox();
        },
        onClick:function(s, i) {
            SFSI("#sfsi_plus_popup_border_color").val("#" + i), SFSI("#sfsiBorderColorPicker").css("background", "#" + i), 
            sfsi_plus_make_popBox();
        }
    }),*/
        SFSI("#sfsi_plus_save1").on("click", function () {
            sfsi_plus_update_step1() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save2").on("click", function () {
            sfsi_plus_update_step2() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save3").on("click", function () {
            sfsi_plus_update_step3() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save4").on("click", function () {
            sfsi_plus_update_step4() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save5").on("click", function () {
            sfsi_plus_update_step5() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save6").on("click", function () {
            sfsi_plus_update_step6() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save7").on("click", function () {
            sfsi_plus_update_step7() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save8").on("click", function () {
            sfsi_plus_update_step8() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_save9").on("click", function () {
            sfsi_plus_update_step9() && sfsipluscollapse(this);
        }),
        SFSI("#sfsi_plus_worker_plugin").on("click", function () {
            sfsi_plus_worker_plugin();
        }),
        SFSI("#sfsi_plus_save_export").on("click", function () {
            sfsi_plus_save_export();
        }),
        SFSI("#sfsi_plus_install_newsletter").on("click", function () {
            sfsi_plus_install_newsletter();
        }),
         SFSI("#sfsi_plus_installDate").on("click", function () {
            sfsi_plus_installDate_save();
        }),
        SFSI("#sfsi_plus_currentDate").on("click", function () {
            sfsi_plus_currentDate_save();
        }),
        SFSI("#sfsi_plus_showNextBannerDate").on("click", function () {
            sfsi_plus_showNextBannerDate_save();
        }),
        SFSI("#sfsi_plus_cycleDate").on("click", function () {
            sfsi_plus_cycleDate_save();
        }),
        SFSI("#sfsi_plus_loyaltyDate").on("click", function () {
            sfsi_plus_loyaltyDate_save();
        }),
        SFSI("#sfsi_plus_banner_global_firsttime_offer").on("click", function () {
            sfsi_plus_banner_global_firsttime_offer_save();
        }),
        SFSI("#sfsi_plus_banner_global_pinterest").on("click", function () {
            sfsi_plus_banner_global_pinterest_save();
        }),
        SFSI("#sfsi_plus_banner_global_social").on("click", function () {
            sfsi_plus_banner_global_social_save();
        }),
        SFSI("#sfsi_plus_banner_global_load_faster").on("click", function () {
            sfsi_plus_banner_global_load_faster_save();
        }),
        SFSI("#sfsi_plus_banner_global_shares").on("click", function () {
            sfsi_plus_banner_global_shares_save();
        }),
        SFSI("#sfsi_plus_banner_global_gdpr").on("click", function () {
            sfsi_plus_banner_global_gdpr_save();
        }),
        SFSI("#sfsi_plus_banner_global_http").on("click", function () {
            sfsi_plus_banner_global_http_save();
        }),
        SFSI("#sfsi_plus_banner_global_upgrade").on("click", function () {
            sfsi_plus_banner_global_upgrade_save();
        }),
        SFSI("#save_plus_all_settings").on("click", function () {
            return SFSI("#save_plus_all_settings").text("Saving.."), SFSI(".save_button >a").css("pointer-events", "none"),
                sfsi_plus_update_step1(), sfsi_plus_update_step9(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "Which icons do you want to show on your site?" tab.', 8),
                    global_error = 0, !1) : (sfsi_plus_update_step2(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "What do you want the icons to do?" tab.', 8),
                    global_error = 0, !1) : (sfsi_plus_update_step3(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "What design & animation do you want to give your icons?" tab.', 8),
                    global_error = 0, !1) : (sfsi_plus_update_step4(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "Do you want to display "counts" next to your icons?" tab.', 8),
                    global_error = 0, !1) : (sfsi_plus_update_step5(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "Any other wishes for your main icons?" tab.', 8),
                    global_error = 0, !1) : (sfsi_plus_update_step6(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "Do you want to display icons at the end of every post?" tab.', 8),
                    global_error = 0, !1) : (sfsi_plus_update_step7(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "Do you want to display a pop-up, asking people to subscribe?" tab.', 8),
                    global_error = 0, !1) : sfsi_plus_update_step8(), 1 == global_error ? (sfsiplus_showErrorSuc("error", 'Some Selection error in "Where shall they be displayed?" tab.', 8),
                    /*global_error = 0, !1) :void (0 == global_error && sfsiplus_showErrorSuc("success", 'Saved! Now go to the <a href="widgets.php">widget</a> area and place the widget into your sidebar (if not done already)', 8))))))));*/
                    global_error = 0, !1) : void(0 == global_error && sfsiplus_showErrorSuc("success", '', 8))))))));
        }),
        /*SFSI(".fileUPInput").live("change", function() {*/
        SFSI(document).on("change", '.fileUPInput', function () {
            sfsiplus_beForeLoad(), sfsiplus_beforeIconSubmit(this) && (SFSI(".upload-overlay").css("pointer-events", "none"),
                SFSI("#customIconFrm").ajaxForm({
                    dataType: "json",
                    success: sfsiplus_afterIconSuccess,
                    resetForm: !0
                }).submit());
        }),
        SFSI(".pop-up").on("click", function () {
            ("fbex-s2" == SFSI(this).attr("data-id") || "linkex-s2" == SFSI(this).attr("data-id")) && (SFSI("." + SFSI(this).attr("data-id")).hide(),
                SFSI("." + SFSI(this).attr("data-id")).css("opacity", "1"), SFSI("." + SFSI(this).attr("data-id")).css("z-index", "1000")),
            SFSI("." + SFSI(this).attr("data-id")).show("slow");
        }),
        /*SFSI("#close_popup").live("click", function() {*/
        SFSI(document).on("click", '#close_popup', function () {
            SFSI(".read-overlay").hide("slow");
        });
    var e = 0;
    SFSI(".plus_icn_listing").on("click", ".checkbox", function () {
            if (1 == e) return !1;
            "yes" == SFSI(this).attr("dynamic_ele") && (s = SFSI(this).parent().find("input:checkbox:first"),
                    s.is(":checked") ? SFSI(s).attr("checked", !1) : SFSI(s).attr("checked", !0)), s = SFSI(this).parent().find("input:checkbox:first"),
                "yes" == SFSI(s).attr("isNew") && ("0px 0px" == SFSI(this).css("background-position") ? (SFSI(s).attr("checked", !0),
                    SFSI(this).css("background-position", "0px -36px")) : (SFSI(s).removeAttr("checked", !0),
                    SFSI(this).css("background-position", "0px 0px")));
            var s = SFSI(this).parent().find("input:checkbox:first");
            if (s.is(":checked") && "sfsiplus-cusotm-icon" == s.attr("element-type")) SFSI(".fileUPInput").attr("name", "custom_icons[]"),
                SFSI(".upload-overlay").show("slow", function () {
                    e = 0;
                }),
                SFSI("#upload_id").val(s.attr("name"));
            else if (!s.is(":checked") && "sfsiplus-cusotm-icon" == s.attr("element-type")) return s.attr("ele-type") ? (SFSI(this).attr("checked", !0),
                SFSI(this).css("background-position", "0px -36px"), e = 0, !1) : confirm("Are you sure want to delete this Icon..?? ") ? "suc" == sfsi_plus_delete_CusIcon(this, s) ? (s.attr("checked", !1),
                SFSI(this).css("background-position", "0px 0px"), e = 0, !1) : (e = 0, !1) : (s.attr("checked", !0),
                SFSI(this).css("background-position", "0px -36px"), e = 0, !1);
        }),
        SFSI(".plus_icn_listing").on("click", ".checkbox", function () {
            checked = SFSI(this).parent().find("input:checkbox:first"), "sfsi_plus_email_display" != checked.attr("name") || checked.is(":checked") || SFSI(".demail-1").show("slow");
        }),
        SFSI("#deac_email2").on("click", function () {
            SFSI(".demail-1").hide("slow"), SFSI(".demail-2").show("slow");
        }),
        SFSI("#deac_email3").on("click", function () {
            SFSI(".demail-2").hide("slow"), SFSI(".demail-3").show("slow");
        }),
        SFSI(".hideemailpop").on("click", function () {
            SFSI('input[name="sfsi_plus_email_display"]').attr("checked", !0),
                SFSI('input[name="sfsi_plus_email_display"]').parent().find("span:first").css("background-position", "0px -36px"),
                SFSI(".demail-1").hide("slow"), SFSI(".demail-2").hide("slow"), SFSI(".demail-3").hide("slow");
        }),
        SFSI(".hidePop").on("click", function () {
            SFSI(".demail-1").hide("slow"), SFSI(".demail-2").hide("slow"), SFSI(".demail-3").hide("slow");
        }),
        SFSI(".sfsiplus_activate_footer").on("click", function () {
            var nonce = SFSI(this).attr("data-nonce");
            SFSI(this).text("activating....");
            var s = {
                action: "plus_activateFooter",
                nonce: nonce
            };
            SFSI.ajax({
                url: sfsi_plus_ajax_object.ajax_url,
                type: "post",
                data: s,
                dataType: "json",
                success: function (s) {
                    if (s.res == "wrong_nonce") {
                        SFSI(".sfsiplus_activate_footer").css("font-size", "18px");
                        SFSI(".sfsiplus_activate_footer").text("Unauthorised Request, Try again after refreshing page");
                    } else {
                        "success" == s.res && (SFSI(".demail-1").hide("slow"), SFSI(".demail-2").hide("slow"),
                            SFSI(".demail-3").hide("slow"), SFSI(".sfsiplus_activate_footer").text("Ok, activate link"));
                    }
                }
            });
        }),
        SFSI(".sfsiplus_removeFooter").on("click", function () {
            var nonce = SFSI(this).attr("data-nonce");
            SFSI(this).text("working....");
            var s = {
                action: "plus_removeFooter",
                nonce: nonce
            };
            SFSI.ajax({
                url: sfsi_plus_ajax_object.ajax_url,
                type: "post",
                data: s,
                dataType: "json",
                success: function (s) {
                    if (s.res == "wrong_nonce") {
                        SFSI(".sfsiplus_removeFooter").text("Unauthorised Request, Try again after refreshing page");
                    } else {
                        "success" == s.res && (SFSI(".sfsiplus_removeFooter").fadeOut("slow"), SFSI(".sfsiplus_footerLnk").fadeOut("slow"));
                    }
                }
            });
        }),
        /*SFSI(".radio").live("click", function() {*/
        SFSI(document).on("click", '.radio', function () {
            var s = SFSI(this).parent().find("input:radio:first");
            "sfsi_plus_display_counts" == s.attr("name") && sfsi_plus_show_counts();
        }),
        SFSI("#close_Uploadpopup").on("click", i), /*SFSI(".radio").live("click", function() {*/ SFSI(document).on("click", '.radio', function () {
            var s = SFSI(this).parent().find("input:radio:first");
            "sfsi_plus_show_Onposts" == s.attr("name") && sfsi_plus_show_OnpostsDisplay();
        }),
        sfsi_plus_show_OnpostsDisplay(),
        sfsi_plus_depened_sections(),
        sfsi_plus_show_counts(),
        sfsi_plus_showPreviewCounts(),
        SFSI(".plus_share_icon_order").sortable({
            update: function () {
                SFSI(".plus_share_icon_order li").each(function () {
                    SFSI(this).attr("data-index", SFSI(this).index() + 1);
                });
            },
            revert: !0
        }),

        //*------------------------------- Sharing text & pcitures checkbox for showing section in Page, Post STARTS -------------------------------------//

        SFSI(document).on("click", '.checkbox', function () {

            var s = SFSI(this).parent().find("input:checkbox:first");

            var inputName = s.attr('name');
            var inputChecked = s.attr("checked");

            switch (inputName) {

                case "sfsi_custom_social_hide":

                    var backgroundPos = jQuery(this).css('background-position').split(" ");

                    var xPos = backgroundPos[0],
                        yPos = backgroundPos[1];
                    var val = (yPos == "0px") ? "no" : "yes";
                    SFSI('input[name="sfsi_plus_custom_social_hide"]').val(val);

                    break;

                case 'sfsi_plus_mouseOver':

                    var elem = SFSI('input[name="' + inputName + '"]');

                    var togglelem = SFSI('.mouse-over-effects');

                    if (inputChecked) {
                        togglelem.removeClass('hide').addClass('show');
                    } else {
                        togglelem.removeClass('show').addClass('hide');
                    }

                    break;
            }

        });

    //*------------------------------- Sharing text & pcitures checkbox for showing section in Page, Post CLOSES -------------------------------------//

    /*SFSI(".radio").live("click", function() {*/
    SFSI(document).on("click", '.radio', function () {
            var s = SFSI(this).parent().find("input:radio:first");
            "sfsi_plus_email_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_email_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_email_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "manual" == SFSI("input[name='sfsi_plus_email_countsFrom']:checked").val() ? SFSI("input[name='sfsi_plus_email_manualCounts']").slideDown() : SFSI("input[name='sfsi_plus_email_manualCounts']").slideUp()),
                "sfsi_plus_facebook_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_facebook_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_facebook_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "mypage" == SFSI("input[name='sfsi_plus_facebook_countsFrom']:checked").val() ? (SFSI("input[name='sfsi_plus_facebook_mypageCounts']").slideDown(), SFSI(".sfsiplus_fbpgidwpr").slideDown()) : (SFSI("input[name='sfsi_plus_facebook_mypageCounts']").slideUp(), SFSI(".sfsiplus_fbpgidwpr").slideUp()),
                    "manual" == SFSI("input[name='sfsi_plus_facebook_countsFrom']:checked").val() ? SFSI("input[name='sfsi_plus_facebook_manualCounts']").slideDown() : SFSI("input[name='sfsi_plus_facebook_manualCounts']").slideUp()),
                "sfsi_plus_facebook_countsFrom" == s.attr("name") && (("mypage" == SFSI("input[name='sfsi_plus_facebook_countsFrom']:checked").val() || "likes" == SFSI("input[name='sfsi_plus_facebook_countsFrom']:checked").val()) ? (SFSI(".sfsi_plus_facebook_pagedeasc").slideDown()) : (SFSI(".sfsi_plus_facebook_pagedeasc").slideUp())),


                "sfsi_plus_twitter_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_twitter_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_twitter_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "manual" == SFSI("input[name='sfsi_plus_twitter_countsFrom']:checked").val() ? (SFSI("input[name='sfsi_plus_twitter_manualCounts']").slideDown(),
                        SFSI(".tw_follow_options").slideUp()) : (SFSI("input[name='sfsi_plus_twitter_manualCounts']").slideUp(),
                        SFSI(".tw_follow_options").slideDown())), "sfsi_plus_linkedIn_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_linkedIn_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_linkedIn_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "manual" == SFSI("input[name='sfsi_plus_linkedIn_countsFrom']:checked").val() ? (SFSI("input[name='sfsi_plus_linkedIn_manualCounts']").slideDown(),
                        SFSI(".linkedIn_options").slideUp()) : (SFSI("input[name='sfsi_plus_linkedIn_manualCounts']").slideUp(),
                        SFSI(".linkedIn_options").slideDown())), "sfsi_plus_youtube_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_youtube_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_youtube_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "manual" == SFSI("input[name='sfsi_plus_youtube_countsFrom']:checked").val() ? (SFSI("input[name='sfsi_plus_youtube_manualCounts']").slideDown(),
                        SFSI(".youtube_options").slideUp()) : (SFSI("input[name='sfsi_plus_youtube_manualCounts']").slideUp(),
                        SFSI(".youtube_options").slideDown())), "sfsi_plus_pinterest_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_pinterest_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_pinterest_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "manual" == SFSI("input[name='sfsi_plus_pinterest_countsFrom']:checked").val() ? (SFSI("input[name='sfsi_plus_pinterest_manualCounts']").slideDown(),
                        SFSI(".pin_options").slideUp()) : SFSI("input[name='sfsi_plus_pinterest_manualCounts']").slideUp()),
                "sfsi_plus_instagram_countsFrom" == s.attr("name") && (SFSI('input[name="sfsi_plus_instagram_countsDisplay"]').prop("checked", !0),
                    SFSI('input[name="sfsi_plus_instagram_countsDisplay"]').parent().find("span.checkbox").attr("style", "background-position:0px -36px;"),
                    "manual" == SFSI("input[name='sfsi_plus_instagram_countsFrom']:checked").val() ? (SFSI("input[name='sfsi_plus_instagram_manualCounts']").slideDown(),
                        SFSI(".instagram_userLi").slideUp()) : (SFSI("input[name='sfsi_plus_instagram_manualCounts']").slideUp(),
                        SFSI(".instagram_userLi").slideDown()))
        }), sfsi_plus_make_popBox(), SFSI('input[name="sfsi_plus_popup_text"] ,input[name="sfsi_plus_popup_background_color"],input[name="sfsi_plus_popup_border_color"],input[name="sfsi_plus_popup_border_thickness"],input[name="sfsi_plus_popup_fontSize"],input[name="sfsi_plus_popup_fontColor"]').on("keyup", sfsi_plus_make_popBox),
        SFSI('input[name="sfsi_plus_popup_text"] ,input[name="sfsi_plus_popup_background_color"],input[name="sfsi_plus_popup_border_color"],input[name="sfsi_plus_popup_border_thickness"],input[name="sfsi_plus_popup_fontSize"],input[name="sfsi_plus_popup_fontColor"]').on("focus", sfsi_plus_make_popBox),
        SFSI("#sfsi_plus_popup_font ,#sfsi_plus_popup_fontStyle").on("change", sfsi_plus_make_popBox),
        /*SFSI(".radio").live("click", function() {*/
        SFSI(document).on("click", '.radio', function () {
            var s = SFSI(this).parent().find("input:radio:first");
            "sfsi_plus_popup_border_shadow" == s.attr("name") && sfsi_plus_make_popBox();
        }), /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? SFSI("img.sfsi_wicon").on("click", function (s) {
            s.stopPropagation();
            var i = SFSI("#sfsi_plus_floater_sec").val();
            SFSI("div.sfsi_plus_wicons").css("z-index", "0"), SFSI(this).parent().parent().parent().siblings("div.sfsi_plus_wicons").find(".sfsiplus_inerCnt").find("div.sfsi_plus_tool_tip_2").hide(),
                SFSI(this).parent().parent().parent().parent().siblings("li").length > 0 && (SFSI(this).parent().parent().parent().parent().siblings("li").find("div.sfsi_plus_tool_tip_2").css("z-index", "0"),
                    SFSI(this).parent().parent().parent().parent().siblings("li").find("div.sfsi_plus_wicons").find(".sfsiplus_inerCnt").find("div.sfsi_plus_tool_tip_2").hide()),
                SFSI(this).parent().parent().parent().css("z-index", "1000000"), SFSI(this).parent().parent().css({
                    "z-index": "999"
                }), SFSI(this).attr("effect") && "fade_in" == SFSI(this).attr("effect") && (SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                    opacity: 1,
                    "z-index": 10
                }), SFSI(this).parent().css("opacity", "1")), SFSI(this).attr("effect") && "scale" == SFSI(this).attr("effect") && (SFSI(this).parent().addClass("scale"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    }), SFSI(this).parent().css("opacity", "1")), SFSI(this).attr("effect") && "combo" == SFSI(this).attr("effect") && (SFSI(this).parent().addClass("scale"),
                    SFSI(this).parent().css("opacity", "1"), SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    })), ("top-left" == i || "top-right" == i) && SFSI(this).parent().parent().parent().parent("#sfsi_plus_floater").length > 0 && "sfsi_plus_floater" == SFSI(this).parent().parent().parent().parent().attr("id") ? (SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").addClass("sfsi_plc_btm"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").find("span.bot_arow").addClass("top_big_arow"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    }), SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").show()) : (SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").find("span.bot_arow").removeClass("top_big_arow"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").removeClass("sfsi_plc_btm"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 1e3
                    }), SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").show());
        }) : SFSI("img.sfsi_wicon").on("mouseenter", function () {
            var s = SFSI("#sfsi_plus_floater_sec").val();
            SFSI("div.sfsi_plus_wicons").css("z-index", "0"), SFSI(this).parent().parent().parent().siblings("div.sfsi_plus_wicons").find(".sfsiplus_inerCnt").find("div.sfsi_plus_tool_tip_2").hide(),
                SFSI(this).parent().parent().parent().parent().siblings("li").length > 0 && (SFSI(this).parent().parent().parent().parent().siblings("li").find("div.sfsi_plus_tool_tip_2").css("z-index", "0"),
                    SFSI(this).parent().parent().parent().parent().siblings("li").find("div.sfsi_plus_wicons").find(".sfsiplus_inerCnt").find("div.sfsi_plus_tool_tip_2").hide()),
                SFSI(this).parent().parent().parent().css("z-index", "1000000"), SFSI(this).parent().parent().css({
                    "z-index": "999"
                }), SFSI(this).attr("effect") && "fade_in" == SFSI(this).attr("effect") && (SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                    opacity: 1,
                    "z-index": 10
                }), SFSI(this).parent().css("opacity", "1")), SFSI(this).attr("effect") && "scale" == SFSI(this).attr("effect") && (SFSI(this).parent().addClass("scale"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    }), SFSI(this).parent().css("opacity", "1")), SFSI(this).attr("effect") && "combo" == SFSI(this).attr("effect") && (SFSI(this).parent().addClass("scale"),
                    SFSI(this).parent().css("opacity", "1"), SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    })), ("top-left" == s || "top-right" == s) && SFSI(this).parent().parent().parent().parent("#sfsi_plus_floater").length > 0 && "sfsi_plus_floater" == SFSI(this).parent().parent().parent().parent().attr("id") ? (SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").addClass("sfsi_plc_btm"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").find("span.bot_arow").addClass("top_big_arow"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    }), SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").show()) : (SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").find("span.bot_arow").removeClass("top_big_arow"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").removeClass("sfsi_plc_btm"),
                    SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").css({
                        opacity: 1,
                        "z-index": 10
                    }), SFSI(this).parentsUntil("div").siblings("div.sfsi_plus_tool_tip_2").show());
        }), SFSI("div.sfsi_plus_wicons").on("mouseleave", function () {
            SFSI(this).children("div.sfsiplus_inerCnt").children("a.sficn").attr("effect") && "fade_in" == SFSI(this).children("div.sfsiplus_inerCnt").children("a.sficn").attr("effect") && SFSI(this).children("div.sfsiplus_inerCnt").find("a.sficn").css("opacity", "0.6"),
                SFSI(this).children("div.sfsiplus_inerCnt").children("a.sficn").attr("effect") && "scale" == SFSI(this).children("div.sfsiplus_inerCnt").children("a.sficn").attr("effect") && SFSI(this).children("div.sfsiplus_inerCnt").find("a.sficn").removeClass("scale"),
                SFSI(this).children("div.sfsiplus_inerCnt").children("a.sficn").attr("effect") && "combo" == SFSI(this).children("div.sfsiplus_inerCnt").children("a.sficn").attr("effect") && (SFSI(this).children("div.sfsiplus_inerCnt").find("a.sficn").css("opacity", "0.6"),
                    SFSI(this).children("div.sfsiplus_inerCnt").find("a.sficn").removeClass("scale"))
        }),
        SFSI("body").on("click", function () {
            SFSI(".sfsiplus_inerCnt").find("div.sfsi_plus_tool_tip_2").hide();
        }),
        SFSI(".adminTooltip >a").on("mouseenter", function () {
            SFSI(this).offset().top, SFSI(this).parent("div").find("div.sfsi_plus_tool_tip_2_inr").css("opacity", "1"),
                SFSI(this).parent("div").find("div.sfsi_plus_tool_tip_2_inr").show();
        }),
        SFSI(".adminTooltip").on("mouseleave", function () {
            "none" != SFSI(".sfsi_plus_gpls_tool_bdr").css("display") && 0 != SFSI(".sfsi_plus_gpls_tool_bdr").css("opacity") ? SFSI(".pop_up_box ").on("click", function () {
                SFSI(this).parent("div").find("div.sfsi_plus_tool_tip_2_inr").css("opacity", "0"), SFSI(this).parent("div").find("div.sfsi_plus_tool_tip_2_inr").hide();
            }) : (SFSI(this).parent("div").find("div.sfsi_plus_tool_tip_2_inr").css("opacity", "0"),
                SFSI(this).parent("div").find("div.sfsi_plus_tool_tip_2_inr").hide());
        }),
        SFSI(".expand-area").on("click", function () {
            object_name.Re_ad == SFSI(this).text() ? (SFSI(this).siblings("p").children("label").fadeIn("slow"),
                SFSI(this).text(object_name1.Coll_apse)) : (SFSI(this).siblings("p").children("label").fadeOut("slow"),
                SFSI(this).text(object_name.Re_ad));
        }),
        /*SFSI(".radio").live("click", function(){*/
        SFSI(document).on("click", '.radio', function () {
            var s = SFSI(this).parent().find("input:radio:first");
            "sfsi_plus_icons_float" == s.attr("name") && "yes" == s.val() && (SFSI(".float_options").slideDown("slow"),
                    SFSI('input[name="sfsi_plus_icons_stick"][value="no"]').attr("checked", !0), SFSI('input[name="sfsi_plus_icons_stick"][value="yes"]').removeAttr("checked"),
                    SFSI('input[name="sfsi_plus_icons_stick"][value="no"]').parent().find("span").attr("style", "background-position:0px -41px;"),
                    SFSI('input[name="sfsi_plus_icons_stick"][value="yes"]').parent().find("span").attr("style", "background-position:0px -0px;")),
                ("sfsi_plus_icons_stick" == s.attr("name") && "yes" == s.val() || "sfsi_plus_icons_float" == s.attr("name") && "no" == s.val()) && (SFSI(".float_options").slideUp("slow"),
                    SFSI('input[name="sfsi_plus_icons_float"][value="no"]').prop("checked", !0), SFSI('input[name="sfsi_plus_icons_float"][value="yes"]').prop("checked", !1),
                    SFSI('input[name="sfsi_plus_icons_float"][value="no"]').parent().find("span.radio").attr("style", "background-position:0px -41px;"),
                    SFSI('input[name="sfsi_plus_icons_float"][value="yes"]').parent().find("span.radio").attr("style", "background-position:0px -0px;"));
        }),
        SFSI(".sfsi_plus_wDiv").length > 0 && setTimeout(function () {
            var s = parseInt(SFSI(".sfsi_plus_wDiv").height()) + 0 + "px";
            SFSI(".sfsi_plus_holders").each(function () {
                SFSI(this).css("height", s);
            });
        }, 200),
        /*SFSI(".checkbox").live("click", function() {*/
        SFSI(document).on("click", '.checkbox', function () {
            var s = SFSI(this).parent().find("input:checkbox:first");
            ("sfsi_plus_shuffle_Firstload" == s.attr("name") && "checked" == s.attr("checked") || "sfsi_plus_shuffle_interval" == s.attr("name") && "checked" == s.attr("checked")) && (SFSI('input[name="sfsi_plus_shuffle_icons"]').parent().find("span").css("background-position", "0px -36px"),
                SFSI('input[name="sfsi_plus_shuffle_icons"]').attr("checked", "checked")), "sfsi_plus_shuffle_icons" == s.attr("name") && "checked" != s.attr("checked") && (SFSI('input[name="sfsi_plus_shuffle_Firstload"]').removeAttr("checked"),
                SFSI('input[name="sfsi_plus_shuffle_Firstload"]').parent().find("span").css("background-position", "0px 0px"),
                SFSI('input[name="sfsi_plus_shuffle_interval"]').removeAttr("checked"), SFSI('input[name="sfsi_plus_shuffle_interval"]').parent().find("span").css("background-position", "0px 0px"));
        });

    SFSI("body").on("click", "#getMeFullAccess", function () {
        var email = SFSI(this).parents("form").find("input[type='email']").val();
        var feedid = SFSI(this).parents("form").find("input[name='feedid']").val();
        var error = false;
        var regEx = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        if (email === '') {
            error = true;
        }

        if (!regEx.test(email)) {
            error = true;
        }
        console.log(error);

        if (!error) {
            SFSI(this).css("pointer-events", "none");
            if (feedid == "" || undefined == feedid) {
                var nonce = SFSI(this).attr('data-nonce-fetch-feed-id');
                e = {
                    action: "sfsi_plus_get_feed_id",
                    nonce: nonce,
                };
                SFSI.ajax({
                    url: sfsi_plus_ajax_object.ajax_url,
                    type: "post",
                    data: e,
                    dataType: "json",
                    async: !0,
                    success: function (s) {
                        console.log(s);

                        if (s.res == "wrong_nonce") {
                            alert("Error: Unauthorised Request, Try again after refreshing page.");
                        } else {
                            if ("success" == s.res) {
                                var feedid = s.feed_id;
                                if (feedid == "" || null == feedid) {
                                    alert("Error: Claiming didn't work. Please try again later.");
                                    SFSI(".sfsi_plus_getMeFullAccess_class").css("pointer-events", "initial");
                                } else {
                                    jQuery('#calimingOptimizationForm input[name="feed_id"]').val(feedid);
                                    // console.log("feedid",feedid,SFSI("#calimingOptimizationForm input[name='feed_id']"),SFSI('#calimingOptimizationForm input[name="feedid"]').val());
                                    SFSI('#calimingOptimizationForm').submit();
                                    SFSI(".sfsi_plus_getMeFullAccess_class").css("pointer-events", "initial");
                                }
                            } else {
                                if ("failed" == s.res) {
                                    alert("Error: " + s.message + ".");
                                    SFSI(".sfsi_plus_getMeFullAccess_class").css("pointer-events", "initial");

                                } else {
                                    alert("Error: Please try again.");
                                    SFSI(".sfsi_plus_getMeFullAccess_class").css("pointer-events", "initial");
                                }
                            }
                        }
                    }
                });
            } else {
                SFSI(this).parents("form").submit();
            }
        } else {
            alert("Error: Please provide your email address.");
        }
    });

    SFSI('form#calimingOptimizationForm').on('keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    /*SFSI(".checkbox").live("click", function()
	{
        var s = SFSI(this).parent().find("input:checkbox:first");
        "sfsi_plus_float_on_page" == s.attr("name") && "yes" == s.val() && ( 
        SFSI('input[name="sfsi_plus_icons_stick"][value="no"]').attr("checked", !0), SFSI('input[name="sfsi_plus_icons_stick"][value="yes"]').removeAttr("checked"), 
        SFSI('input[name="sfsi_plus_icons_stick"][value="no"]').parent().find("span").attr("style", "background-position:0px -41px;"), 
        SFSI('input[name="sfsi_plus_icons_stick"][value="yes"]').parent().find("span").attr("style", "background-position:0px -0px;"));
    });
	SFSI(".radio").live("click", function()
	{
        var s = SFSI(this).parent().find("input:radio:first");
		var a = SFSI(".cstmfltonpgstck");
		("sfsi_plus_icons_stick" == s.attr("name") && "yes" == s.val()) && (
        SFSI('input[name="sfsi_plus_float_on_page"][value="no"]').prop("checked", !0), SFSI('input[name="sfsi_plus_float_on_page"][value="yes"]').prop("checked", !1), 
        SFSI('input[name="sfsi_plus_float_on_page"][value="no"]').parent().find("span.checkbox").attr("style", "background-position:0px -41px;"), 
        SFSI('input[name="sfsi_plus_float_on_page"][value="yes"]').parent().find("span.checkbox").attr("style", "background-position:0px -0px;"),
		jQuery(a).children(".checkbox").css("background-position", "0px 0px" ), sfsiplus_toggleflotpage(a));
    });*/
    SFSI(document).on("click", ".sfsi_plus-AddThis-notice-dismiss", function () {
        SFSI.ajax({
            url: sfsi_plus_ajax_object.ajax_url,
            type: "post",
            data: {
                action: "sfsi_plus_dismiss_addThis_icon_notice"
            },
            success: function (e) {
                if (false != e) {
                    SFSI(".sfsi_plus-AddThis-notice-dismiss").parent().remove();
                }
            }
        });
    });
    if (undefined !== window.location.hash) {
        switch (window.location.hash) {
            case '#ui-id-1':
                SFSI('#ui-id-1').removeClass('ui-corner-all').addClass('accordion-header-active ui-state-active ui-corner-top');
                SFSI('#ui-id-2').css({
                    'display': 'block'
                });
                window.scroll(0, 30);
                break;
            case '#ui-id-5':
                SFSI('#ui-id-5').removeClass('ui-corner-all').addClass('accordion-header-active ui-state-active ui-corner-top');
                SFSI('#ui-id-6').css({
                    'display': 'block'
                });
                window.scroll(0, 30);
                var scrolto_elem = SFSI('.sfsiplusbeforeafterpostselector');
                if (scrolto_elem && scrolto_elem.length > 0 && scrolto_elem.offset() && scrolto_elem.offset().top) {
                    window.scrollTo(0, scrolto_elem.offset().top - 30);
                    setTimeout(function () {
                        window.scrollTo(0, scrolto_elem.offset().top - 30);
                    }, 1000);
                }
                break;
        }
    }
    sfsi_plus_checkbox_checker();
});

//for utube channel name and id
function showhideutube(ref) {
    var chnlslctn = SFSI(ref).children("input").val();
    if (chnlslctn == "name") {
        SFSI(ref).parent(".enough_waffling").next(".cstmutbtxtwpr").children(".cstmutbchnlnmewpr").slideDown();
        SFSI(ref).parent(".enough_waffling").next(".cstmutbtxtwpr").children(".cstmutbchnlidwpr").slideUp();
    } else {
        SFSI(ref).parent(".enough_waffling").next(".cstmutbtxtwpr").children(".cstmutbchnlidwpr").slideDown();
        SFSI(ref).parent(".enough_waffling").next(".cstmutbtxtwpr").children(".cstmutbchnlnmewpr").slideUp();
    }
}

var sfsiplus_initTop = new Array();

function sfsiplus_toggleflotpage(ref) {
    var pos = jQuery(ref).children(".checkbox").css("background-position");
    if (pos == "0px 0px") {
        jQuery(ref).next(".sfsiplus_right_info").children("p").children(".sfsiplus_sub-subtitle").hide();
        jQuery(ref).next(".sfsiplus_right_info").children(".sfsiplus_tab_3_icns").hide();
    } else {
        jQuery(ref).next(".sfsiplus_right_info").children("p").children(".sfsiplus_sub-subtitle").show();
        jQuery(ref).next(".sfsiplus_right_info").children(".sfsiplus_tab_3_icns").show();
    }
}

function sfsiplus_togglbtmsection(show, hide, ref) {
    jQuery(ref).parent("ul").children("li.clckbltglcls").each(function (index, element) {
        jQuery(this).children(".radio").css("background-position", "0px 0px");
        jQuery(this).children(".styled").attr("checked", "false");
    });
    jQuery(ref).children(".radio").css("background-position", "0px -41px");
    jQuery(ref).children(".styled").attr("checked", "true");

    jQuery("." + show).show();
    jQuery("." + show).children(".radiodisplaysection").show();
    jQuery("." + hide).hide();
    jQuery("." + hide).children(".radiodisplaysection").hide();
    /*jQuery(ref).parent("ul").children("li").each(function(index, element)
	{
		var pos = jQuery(this).children(".radio").css("background-position");
		if(pos == "0px 0px")
		{
			jQuery(this).children(".radiodisplaysection").hide();
		}
		else
		{
			jQuery(this).children(".radiodisplaysection").show();
		}
    });
	var pos = jQuery(ref).children(".radio").css("background-position");
	if(pos != "0px 0px")
	{
		jQuery(ref).children(".radiodisplaysection").show();
	}
	else
	{
		jQuery(ref).children(".radiodisplaysection").hide();
	}*/
}

function checkforinfoslction(ref) {
    var pos = jQuery(ref).children(".checkbox").css("background-position");
    if (pos == "0px 0px") {
        jQuery(ref).next(".sfsiplus_right_info").children("p").children("label").hide();
    } else {
        jQuery(ref).next(".sfsiplus_right_info").children("p").children("label").show();
    }
}
function checkforinfoslction2(ref) {
    var pos = jQuery(ref).children(".checkbox").css("background-position");
    if (pos == "0px 0px") {
        jQuery(ref).next(".sfsiplus_right_info").children("label").hide();
    } else {
        jQuery(ref).next(".sfsiplus_right_info").children("label").show();
    }
}
SFSI("body").on("click", ".sfsi_plus_tokenGenerateButton a", function () {
    var clienId = SFSI("input[name='sfsi_plus_instagram_clientid']").val();
    var redirectUrl = SFSI("input[name='sfsi_plus_instagram_appurl']").val();

    var scope = "basic";
    var instaUrl = "https://www.instagram.com/oauth/authorize/?client_id=<id>&redirect_uri=<url>&response_type=token&scope=" + scope;

    if (clienId !== '' && redirectUrl !== '') {
        instaUrl = instaUrl.replace('<id>', clienId);
        instaUrl = instaUrl.replace('<url>', redirectUrl);

        window.open(instaUrl, '_blank');
    } else {
        alert("Please enter client id and redirect url first");
    }

});
SFSI(document).on("click", '.radio', function () {

    var s = SFSI(this).parent().find("input:radio:first");

    switch (s.attr("name")) {

        case 'sfsi_plus_mouseOver_effect_type':

            var _val = s.val();
            var _name = s.attr("name");

            if ('same_icons' == _val) {
                SFSI('.same_icons_effects').removeClass('hide').addClass('show');
                SFSI('.other_icons_effects_options').removeClass('show').addClass('hide');
            } else if ('other_icons' == _val) {
                SFSI('.same_icons_effects').removeClass('show').addClass('hide');
                SFSI('.other_icons_effects_options').removeClass('hide').addClass('show');
            }

            break;
    }
});

function getElementPosition(element) {
    var xPosition = 0;
    var yPosition = 0;

    while (element) {
        xPosition += (element.offsetLeft - element.scrollLeft + element.clientLeft);
        yPosition += (element.offsetTop - element.scrollTop + element.clientTop);
        element = element.offsetParent;
    }

    return {
        x: xPosition,
        y: yPosition
    };
}
SFSI(document).ready(function () {
    SFSI('#sfsi_plus_jivo_offline_chat .tab-link').click(function () {
        var cur = SFSI(this);
        if (!cur.hasClass('active')) {
            var target = cur.find('a').attr('href');
            cur.parent().children().removeClass('active');
            cur.addClass('active');
            SFSI('#sfsi_plus_jivo_offline_chat .tabs').children().hide();
            SFSI(target).show();
        }
    });
    SFSI('#sfsi_plus_jivo_offline_chat #sfsi_sales form').submit(function (event) {
        event & event.preventDefault();
        var target = SFSI(this).parents('.tab-content');
        var message = SFSI(this).find('textarea[name="question"]').val();
        var email = SFSI(this).find('input[name="email"]').val();
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var nonce = SFSI(this).find('input[name="nonce"]').val();

        if ("" === email || false === re.test(String(email).toLowerCase())) {
            SFSI(this).find('input[name="email"]').css('background-color', 'red');
            SFSI(this).find('input[name="email"]').on('keyup', function () {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var email = SFSI(this).val();
                if ("" !== email && true === re.test(String(email).toLowerCase())) {
                    SFSI(this).css('background-color', '#fff');
                }
            })
            return false;

        }
        SFSI.ajax({
            url: sfsi_plus_ajax_object.ajax_url,
            type: "post",
            data: {
                action: "sfsiplusOfflineChatMessage",
                message: message,
                email: email,
                nonce: nonce
            }
        }).done(function () {
            target.find('.before_message_sent').hide();
            target.find('.after_message_sent').show();
        });
    });
});

function sfsi_close_offline_chat(e) {
    e && e.preventDefault();

    SFSI('#sfsi_plus_jivo_offline_chat').hide();
    SFSI('#sfsi_dummy_chat_icon').show();
}
if (undefined == window.sfsi_plus_float_widget) {
    function sfsi_plus_float_widget(data = null, data2 = null, data3 = null) {
        return true;
    }
}
sfsi_plus_responsive_icon_intraction_handler();

SFSI(document).on("click", '.checkbox', function () {

    var s = SFSI(this).parent().find("input:checkbox:first");

    var inputName = s.attr("name");
    var inputChecked = s.attr("checked");

    //----------------- Customization for twitter card section STARTS----------------------------//

    switch (inputName) {

        case 'sfsi_plus_twitter_aboutPage':

            var elem = SFSI('.sfsi_navigate_to_question6');
            var elemC = SFSI('#twitterSettingContainer');

            if (inputChecked) {
                elem.addClass('addCss').removeClass('removeCss');
                elemC.css('display', 'block');
            } else {
                elem.removeClass('addCss').addClass('removeCss');
                elemC.css('display', 'none');
            }

            var chkd = SFSI("input[name='sfsi_plus_twitter_twtAddCard']:checked").val();

            if (inputChecked) {
                SFSI(".contTwitterCard").show("slow");
                if (chkd == "no") {
                    SFSI(".cardDataContainer").hide();
                }
            } else {
                if (chkd == "yes") {
                    SFSI('input[value="yes"][name="sfsi_plus_twitter_twtAddCard"]').prop("checked", false);
                    SFSI('input[value="no"][name="sfsi_plus_twitter_twtAddCard"]').prop("checked", true);
                }
                SFSI(".contTwitterCard").hide("slow");
            }

            break;

        case 'sfsi_plus_Hide_popupOnScroll':
        case 'sfsi_plus_Hide_popupOn_OutsideClick':

            var elem = SFSI('input[name="' + inputName + '"]');

            if (inputChecked) {
                elem.val("yes");
            } else {
                elem.val("no");
            }

            break;

        case 'sfsi_plus_mouseOver':

            var elem = SFSI('input[name="' + inputName + '"]');

            var togglelem = SFSI('.mouse-over-effects');

            if (inputChecked) {
                togglelem.removeClass('hide').addClass('show');
            } else {
                togglelem.removeClass('show').addClass('hide');
            }

            break;


        case 'sfsi_plus_shuffle_icons':

            var elem = SFSI('input[name="' + inputName + '"]');

            var togglelem = SFSI('.shuffle_sub');

            if (inputChecked) {
                togglelem.removeClass('hide').addClass('show');
            } else {
                togglelem.removeClass('show').addClass('hide');
            }

            break;

        case 'sfsi_plus_place_rectangle_icons_item_manually':
            var elem = SFSI('input[name="' + inputName + '"]');

            var togglelem = elem.parent().next();

            if (inputChecked) {
                togglelem.removeClass('hide').addClass('show');
            } else {
                togglelem.removeClass('show').addClass('hide');
            }

            break;

        case 'sfsi_plus_icon_hover_show_pinterest':
            var elem = SFSI('input[name="' + inputName + '"]');

            var togglelem = elem.parent().next();

            if (inputChecked) {

                togglelem.removeClass('hide').addClass('show');
                SFSI('.sfsi_plus_include_exclude_wrapper .sfsi_premium_restriction_warning_pinterest').removeClass('hide');
            } else {
                togglelem.removeClass('show').addClass('hide');
                SFSI('.sfsi_plus_include_exclude_wrapper .sfsi_premium_restriction_warning_pinterest').addClass('hide');
            }

            break;

        case 'sfsi_plus_houzzShare_option':

            var elem = SFSI('input[name="' + inputName + '"]');

            var togglelem = SFSI('.houzzideabooks');

            if (inputChecked) {
                togglelem.removeClass('hide').addClass('show');
            } else {
                togglelem.removeClass('show').addClass('hide');
            }

            break;

        case 'sfsi_plus_wechatFollow_option':

            var elem = SFSI('input[name="' + inputName + '"]');

            var togglelem = SFSI('.sfsi_plus_wechat_follow_desc');

            if (inputChecked) {
                togglelem.removeClass('hide').addClass('show').show();
            } else {
                togglelem.removeClass('show').addClass('hide').hide();
            }

            break;

        case 'sfsi_plus_fbmessengerShare_option':
            var elem = jQuery('.sfsi_premium_only_fbmessangershare');
            if (inputChecked) {
                elem.show();
            } else {
                elem.hide();
            }
            break;
        case 'sfsi_plus_responsive_facebook_display':
            if (inputChecked) {
                SFSI('.sfsi_plus_responsive_icon_facebook_container').parents('a').show();
                var icon = inputName.replace('sfsi_plus_responsive_', '').replace('_display', '');
                if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() !== "Fully responsive") {
                    window.sfsi_plus_fittext_shouldDisplay = true;
                    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                        if (jQuery(a_container).css('display') !== "none") {
                            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                        }
                    })
                }
            } else {

                SFSI('.sfsi_plus_responsive_icon_facebook_container').parents('a').hide();
                if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() !== "Fully responsive") {
                    window.sfsi_plus_fittext_shouldDisplay = true;
                    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                        if (jQuery(a_container).css('display') !== "none") {
                            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                        }
                    })
                }
            }
            break;
        case 'sfsi_plus_responsive_Twitter_display':
            if (inputChecked) {
                SFSI('.sfsi_plus_responsive_icon_twitter_container').parents('a').show();
                var icon = inputName.replace('sfsi_plus_responsive_', '').replace('_display', '');
                if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() !== "Fully responsive") {
                    window.sfsi_plus_fittext_shouldDisplay = true;
                    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                        if (jQuery(a_container).css('display') !== "none") {
                            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                        }
                    })
                }
            } else {
                SFSI('.sfsi_plus_responsive_icon_twitter_container').parents('a').hide();
                if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() !== "Fully responsive") {
                    window.sfsi_plus_fittext_shouldDisplay = true;
                    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                        if (jQuery(a_container).css('display') !== "none") {
                            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                        }
                    })
                }
            }
            break;
        case 'sfsi_plus_responsive_Follow_display':
            if (inputChecked) {
                SFSI('.sfsi_plus_responsive_icon_follow_container').parents('a').show();
                var icon = inputName.replace('sfsi_plus_responsive_', '').replace('_display', '');
                if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() !== "Fully responsive") {
                    window.sfsi_plus_fittext_shouldDisplay = true;
                    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                        if (jQuery(a_container).css('display') !== "none") {
                            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                        }
                    })
                }
            } else {
                SFSI('.sfsi_plus_responsive_icon_follow_container').parents('a').hide();
                if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() !== "Fully responsive") {
                    window.sfsi_plus_fittext_shouldDisplay = true;
                    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                        if (jQuery(a_container).css('display') !== "none") {
                            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                        }
                    })
                }
            }
            break;

    }

    var checkboxElem = SFSI(this);
    sfsi_toggle_include_exclude_posttypes_taxonomies(checkboxElem, inputName, inputChecked, s);

    //----------------- Customization for Twitter add card CLOSES----------------------------// 


    ("sfsi_plus_shuffle_Firstload" == s.attr("name") && "checked" == s.attr("checked") || "sfsi_plus_shuffle_interval" == s.attr("name") && "checked" == s.attr("checked")) && (SFSI('input[name="sfsi_plus_shuffle_icons"]').parent().find("span").css("background-position", "0px -36px"),
        SFSI('input[name="sfsi_plus_shuffle_icons"]').attr("checked", "checked")), "sfsi_plus_shuffle_icons" == s.attr("name") && "checked" != s.attr("checked") && (SFSI('input[name="sfsi_plus_shuffle_Firstload"]').removeAttr("checked"),
        SFSI('input[name="sfsi_plus_shuffle_Firstload"]').parent().find("span").css("background-position", "0px 0px"),
        SFSI('input[name="sfsi_plus_shuffle_interval"]').removeAttr("checked"), SFSI('input[name="sfsi_plus_shuffle_interval"]').parent().find("span").css("background-position", "0px 0px"));
    var sfsi_plus_icon_hover_switch_exclude_custom_post_types = SFSI('input[name="sfsi_plus_icon_hover_switch_exclude_custom_post_types"]:checked').val() || 'no';
    var sfsi_plus_icon_hover_switch_exclude_taxonomies = SFSI('input[name="sfsi_plus_icon_hover_switch_exclude_taxonomies"]:checked').val() || 'no';



});


function sfsi_toggle_include_exclude_posttypes_taxonomies(checkboxElem, inputFieldName, inputChecked, inputFieldElem) {

    switch (inputFieldName) {

        case 'sfsi_plus_switch_exclude_custom_post_types':
        case 'sfsi_plus_switch_include_custom_post_types':
        case 'sfsi_plus_icon_hover_switch_exclude_custom_post_types':
        case 'sfsi_plus_icon_hover_switch_include_custom_post_types':

            var elem = inputFieldElem.parent().parent().find("#sfsi_premium_custom_social_data_post_types_ul");

            if (inputChecked) {
                elem.show();
            } else {
                elem.hide();
            }

            break;

        case 'sfsi_plus_switch_exclude_taxonomies':
        case 'sfsi_plus_switch_include_taxonomies':
        case 'sfsi_plus_icon_hover_switch_exclude_taxonomies':
        case 'sfsi_plus_icon_hover_switch_include_taxonomies':

            var elem = inputFieldElem.parent().parent().find("#sfsi_premium_taxonomies_ul");

            if (inputChecked) {
                elem.show();
            } else {
                elem.hide();
            }

            break;

        case 'sfsi_plus_include_url':
        case 'sfsi_plus_exclude_url':

            var value = checkboxElem.css("background-position");
            var keyWCnt = checkboxElem.parent().next().next();

            if (value === '0px -36px') {
                keyWCnt.show();
                keyWCnt.next().show();
            } else {
                keyWCnt.hide();
                keyWCnt.next().hide();
            }

            break;
    }
}



function open_save_image(btnUploadID, inputImageId, previewDivId) {

    var btnElem, inputImgElem, previewDivElem;

    var clickHandler = function (event) {

        var send_attachment_bkp = wp.media.editor.send.attachment;

        var frame = wp.media({
            title: 'Select or Upload Media for Social Media',
            button: {
                text: 'Use this media'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON(),

                url = attachment.url.split("/");
            fileName = url[url.length - 1];
            fileArr = fileName.split(".");
            fileType = fileArr[fileArr.length - 1];

            if (fileType != undefined && (fileType == 'gif' || fileType == 'jpeg' || fileType == 'jpg' || fileType == 'png')) {

                inputImgElem.val(attachment.url);
                previewDivElem.attr('src', attachment.url);

                btnElem.val("Change Picture");

                wp.media.editor.send.attachment = send_attachment_bkp;
            } else {
                alert("Only Images are allowed to upload");
                frame.open();
            }
        });

        // Finally, open the modal on click
        frame.open();
        return false;
    };

    if ("object" === typeof btnUploadID && null !== btnUploadID) {

        btnElem = SFSI(btnUploadID);
        inputImgElem = btnElem.parent().find('input[type="hidden"]');
        previewDivElem = btnElem.parent().find('img');

        clickHandler();
    } else {
        btnElem = SFSI('#' + btnUploadID);
        inputImgElem = SFSI('#' + inputImageId);
        previewDivElem = SFSI('#' + previewDivId);

        btnElem.on("click", clickHandler);
    }

}


function upload_image_wechat_scan(e) {
    e.preventDefault();
    var send_attachment_bkp = wp.media.editor.send.attachment;

    var frame = wp.media({
        title: 'Select or Upload image for icon',
        button: {
            text: 'Use this media'
        },
        multiple: false // Set to true to allow multiple files to be selected
    });

    frame.on('select', function () {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        var url = attachment.url.split("/");
        var fileName = url[url.length - 1];
        var fileArr = fileName.split(".");
        var fileType = fileArr[fileArr.length - 1];

        if (fileType != undefined && (fileType == 'jpeg' || fileType == 'jpg' || fileType == 'png' || fileType == 'gif')) {
            jQuery('input[name="sfsi_plus_wechat_scan_image"]').val(attachment.url);
            jQuery('.sfsi_plus_wechat_display>img').attr('src', attachment.url);
            jQuery('.sfsi_plus_wechat_display').removeClass("hide").addClass('show');
            jQuery('.sfsi_plus_wechat_instruction').removeClass("show").addClass('hide');
            wp.media.editor.send.attachment = send_attachment_bkp;
        } else {
            alert("Only Images are allowed to upload");
            frame.open();
        }
    });

    // Finally, open the modal on click
    frame.open();
}

function sfsi_plus_delete_wechat_scan_upload(event, context) {
    event.preventDefault();
    if (context === "from-server") {
        e = {
            action: "sfsi_plus_deleteWebChatFollow"
        };
        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: "post",
            data: e,
            dataType: "json",
            async: !0,
            success: function (s) {
                if (s.res == 'success') {
                    jQuery('input[name="sfsi_plus_wechat_scan_image"]').val('');
                    jQuery('.sfsi_plus_wechat_display>img').attr('src', '');
                    jQuery('.sfsi_plus_wechat_display').removeClass("show").addClass('hide');
                    jQuery('.sfsi_plus_wechat_instruction').removeClass("hide").addClass('show');
                    // sfsiplus_afterIconSuccess(s);
                } else {
                    SFSI(".upload-overlay").hide("slow");
                    SFSI(".uperror").html(s.res);
                    sfsiplus_showErrorSuc("Error", "Some Error Occured During Delete of wechat scan", 1)
                }
            }
        });
    } else {
        jQuery('input[name="sfsi_plus_wechat_scan_image"]').val('');
        jQuery('.sfsi_plus_wechat_display>img').attr('src', '');
        jQuery('.sfsi_plus_wechat_display').removeClass("show").addClass('hide');
        jQuery('.sfsi_plus_wechat_instruction').removeClass("hide").addClass('show');
    }
}

function sfsi_plus_checkbox_checker() {
    //check if it is options page
    if (window.location.pathname.endsWith('admin.php')) {
        // check if Custom checkbox is loaded.
        if (undefined !== this.sfsi_plus_styled_input) {
            jQuery(window).on('load', function () {
                if (undefined == window.sfsi_plus_checkbox_loaded) {
                    alert('There was js conflict. and we couldn\'t load our plugin successfully. please check with other plugins for the conflict.');
                }
            })
        } else {
            alert('Script for custom checkbox couldnot be loaded. you might not be able to see the checkbox. it might happen due to caching or plugin conflicts.');
        }
    }
}

function sfsi_plus_close_quickpay(e) {
    e && e.preventDefault();
    jQuery('.sfsi_plus_quickpay-overlay').hide();
}

// Worker Plugin
function sfsi_plus_worker_plugin(data) {
    var nonce = SFSI("#sfsi_plus_worker_plugin").attr("data-nonce");
    var redirectUrl = SFSI("#sfsi_plus_worker_plugin").attr("data-plugin-list-url");
    var e = {
        action: "worker_plugin",
        customs: true,
        premium_url: data.installation_premium_plugin_file,
        licence: data.license_key,
        nonce: nonce
    };
    sfsi_plus_worker_wait();

    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: e,
        success: function (msg) {
            window.msg = msg;
            var error = false;
            var message = "";
            if (msg[0] == "{") {
                message = JSON.parse(msg);
            } else {
                var json_txts = msg.match(/\{.*\}/g);
                if (json_txts.length > 0) {
                    message = JSON.parse(json_txts[0])
                } else {
                    error = true;
                }
            }
            if (false == error && message.installed == true && message.activate == null) {
                window.location.href = redirectUrl;
            } else {
                jQuery('.sfsi_plus_premium_installer-overlay').hide();
                alert('unexpected error occured It might be due to server permission issue. Please download the file and install manually.');
            }
        },
        error: function (msg) {
            jQuery('.sfsi_plus_premium_installer-overlay').hide();
            alert('unexpected error occured It might be due to server permission issue. Please install manually.');
        }
    });

}

// <------------------------* Responsive icon *----------------------->
function sfsi_plus_responsive_icon_intraction_handler() {
    window.sfsi_plus_fittext_shouldDisplay = true;
    SFSI('select[name="sfsi_plus_responsive_icons_settings_edge_type"]').on('change', function () {
        $target_div = (SFSI(this).parent());
        if (SFSI(this).val() === "Round") {
            $target_div.parent().children().css('display', 'inline-block');
            var radius = jQuery('select[name="sfsi_plus_responsive_icons_settings_edge_radius"]').val() + 'px'
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container,.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('border-radius', radius);

        } else {
            $target_div.parent().children().hide();
            $target_div.show();
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container,.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('border-radius', 'unset');

        }
    });
    SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').on('change', function () {
        $target_div = (SFSI(this).parent());
        if (SFSI(this).val() === "Fixed icon width") {
            $target_div.parent().children().css('display', 'inline-block');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').css('width', 'auto').css('display', 'flex');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a').css('flex-basis', 'unset');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').css('width', jQuery('input[name="sfsi_plus_responsive_icons_sttings_icon_width_size"]').val());

            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container_box_fully_container').removeClass('sfsi_plus_icons_container_box_fully_container').addClass('sfsi_plus_icons_container_box_fixed_container');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container_box_fixed_container').removeClass('sfsi_plus_icons_container_box_fully_container').addClass('sfsi_plus_icons_container_box_fixed_container');
            window.sfsi_plus_fittext_shouldDisplay = true;
            jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                if (jQuery(a_container).css('display') !== "none") {
                    sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                }
            })
        } else {
            $target_div.parent().children().hide();
            $target_div.show();
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').css('width', '100%').css('display', 'flex');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a').css('flex-basis', '100%');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').css('width', '100%');

            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container_box_fixed_container').removeClass('sfsi_plus_icons_container_box_fixed_container').addClass('sfsi_plus_icons_container_box_fully_container');
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container_box_fully_container').removeClass('sfsi_plus_icons_container_box_fixed_container').addClass('sfsi_plus_icons_container_box_fully_container');
            window.sfsi_plus_fittext_shouldDisplay = true;
            jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                if (jQuery(a_container).css('display') !== "none") {
                    sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                }
            })
        }
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').removeClass('sfsi_plus_fixed_count_container').removeClass('sfsi_plus_responsive_count_container').addClass('sfsi_plus_' + (jQuery(this).val() == "Fully responsive" ? 'responsive' : 'fixed') + '_count_container')
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container>a').removeClass('sfsi_plus_responsive_fluid').removeClass('sfsi_plus_responsive_fixed_width').addClass('sfsi_plus_responsive_' + (jQuery(this).val() == "Fully responsive" ? 'fluid' : 'fixed_width'))
        sfsi_plus_resize_icons_container();

    })
    jQuery(document).on('keyup', 'input[name="sfsi_plus_responsive_icons_sttings_icon_width_size"]', function () {
        if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() === "Fixed icon width") {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').css('width', jQuery(this).val() + 'px');
            window.sfsi_plus_fittext_shouldDisplay = true;
            jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
                if (jQuery(a_container).css('display') !== "none") {
                    sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
                }
            })
        }
        sfsi_plus_resize_icons_container();
    });
    jQuery(document).on('change', 'input[name="sfsi_plus_responsive_icons_sttings_icon_width_size"]', function () {
        if (SFSI('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() === "Fixed icon width") {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').css('width', jQuery(this).val() + 'px');
        }
    });
    jQuery(document).on('keyup', 'input[name="sfsi_plus_responsive_icons_settings_margin"]', function () {
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a,.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('margin-right', jQuery(this).val() + 'px');
    });
    jQuery(document).on('change', 'input[name="sfsi_plus_responsive_icons_settings_margin"]', function () {
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a,.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('margin-right', jQuery(this).val() + 'px');
        // jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').css('width',(jQuery('.sfsi_plus_responsive_icons').width()-(jQuery('.sfsi_plus_responsive_icons_count').width()+jQuery(this).val()))+'px');

    });
    jQuery(document).on('change', 'select[name="sfsi_plus_responsive_icons_settings_text_align"]', function () {
        if (jQuery(this).val() === "Centered") {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a').css('text-align', 'center');
        } else {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a').css('text-align', 'left');
        }
    });
    jQuery('.sfsi_plus_responsive_default_icon_container input.sfsi_plus_responsive_input').on('keyup', function () {
        jQuery(this).parent().find('.sfsi_plus_responsive_icon_item_container').find('span').text(jQuery(this).val());
        var iconName = jQuery(this).attr('name');
        var icon = iconName.replace('sfsi_plus_responsive_', '').replace('_input', '');
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_' + (icon.toLowerCase()) + '_container span').text(jQuery(this).val());
        window.sfsi_plus_fittext_shouldDisplay = true;
        jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
            if (jQuery(a_container).css('display') !== "none") {
                sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
            }
        })
        sfsi_plus_resize_icons_container();
    })
    jQuery('.sfsi_plus_responsive_custom_icon_container input.sfsi_plus_responsive_input').on('keyup', function () {
        jQuery(this).parent().find('.sfsi_plus_responsive_icon_item_container').find('span').text(jQuery(this).val());
        var iconName = jQuery(this).attr('name');
        var icon = iconName.replace('sfsi_plus_responsive_custom_', '').replace('_input', '');
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_' + icon + '_container span').text(jQuery(this).val())
        window.sfsi_plus_fittext_shouldDisplay = true;
        jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
            if (jQuery(a_container).css('display') !== "none") {
                sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
            }
        })
        sfsi_plus_resize_icons_container();

    })
    jQuery('.sfsi_plus_responsive_custom_url_toggler, .sfsi_plus_responsive_default_url_toggler').click(function (event) {
        event.preventDefault();
        sfsi_plus_responsive_open_url(event);
    });
    jQuery('.sfsi_plus_responsive_custom_url_toggler, .sfsi_plus_responsive_default_url_toggler').click(function (event) {
        event.preventDefault();
        sfsi_plus_responsive_open_url(event);
    })
    jQuery('.sfsi_plus_responsive_custom_url_hide, .sfsi_plus_responsive_default_url_hide').click(function (event) {
        event.preventDefault();
        jQuery(event.target).parent().parent().find('.sfsi_plus_responsive_custom_url_hide').hide();
        jQuery(event.target).parent().parent().find('.sfsi_plus_responsive_url_input').hide();
        jQuery(event.target).parent().parent().find('.sfsi_plus_responsive_default_url_hide').hide();
        jQuery(event.target).parent().parent().find('.sfsi_plus_responsive_default_url_toggler').show();
        jQuery(event.target).parent().parent().find('.sfsi_plus_responsive_custom_url_toggler').show();
    });
    jQuery('select[name="sfsi_plus_responsive_icons_settings_icon_size"]').change(function (event) {
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container,.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').removeClass('sfsi_plus_small_button').removeClass('sfsi_plus_medium_button').removeClass('sfsi_plus_large_button').addClass('sfsi_plus_' + (jQuery(this).val().toLowerCase()) + '_button');
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').removeClass('sfsi_plus_small_button_container').removeClass('sfsi_plus_medium_button_container').removeClass('sfsi_plus_large_button_container').addClass('sfsi_plus_' + (jQuery(this).val().toLowerCase()) + '_button_container')
    })
    jQuery(document).on('change', 'select[name="sfsi_plus_responsive_icons_settings_edge_radius"]', function (event) {
        var radius = jQuery(this).val() + 'px'
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container,.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('border-radius', radius);

    });
    jQuery(document).on('change', 'select[name="sfsi_plus_responsive_icons_settings_style"]', function (event) {
        if ('Flat' === jQuery(this).val()) {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').removeClass('sfsi_plus_responsive_icon_gradient');
        } else {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').addClass('sfsi_plus_responsive_icon_gradient');
        }
    });
    jQuery(document).on('mouseenter', '.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a', function () {
        jQuery(this).css('opacity', 0.8);
    })
    jQuery(document).on('mouseleave', '.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container a', function () {
        jQuery(this).css('opacity', 1);
    })
    window.sfsi_plus_fittext_shouldDisplay = true;
    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
        if (jQuery(a_container).css('display') !== "none") {
            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
        }
    })
    sfsi_plus_resize_icons_container();
    jQuery('.ui-accordion-header.ui-state-default.ui-accordion-icons').click(function (data) {
        window.sfsi_plus_fittext_shouldDisplay = true;
        jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
            if (jQuery(a_container).css('display') !== "none") {
                sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
            }
        })
        sfsi_plus_resize_icons_container();
    });
    jQuery('select[name="sfsi_plus_responsive_icons_settings_text_align"]').change(function (event) {
        var data = jQuery(event.target).val();
        if (data == "Centered") {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').removeClass('sfsi_plus_left-align_icon').addClass('sfsi_plus_centered_icon');
        } else {
            jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container').removeClass('sfsi_plus_centered_icon').addClass('sfsi_plus_left-align_icon');
        }
    });
    jQuery('a.sfsi_plus_responsive_custom_delete_btn').click(function (event) {
        event.preventDefault();
        var icon_num = jQuery(this).attr('data-id');
        //reset the current block;
        // var last_block = jQuery('.sfsi_plus_responsive_custom_icon_4_container').clone();
        var cur_block = jQuery('.sfsi_plus_responsive_custom_icon_' + icon_num + '_container');
        cur_block.find('.sfsi_plus_responsive_custom_delete_btn').hide();
        cur_block.find('input[name="sfsi_plus_responsive_custom_' + icon_num + '_added"]').val('no');
        cur_block.find('.sfsi_plus_responsive_custom_' + icon_num + '_added').attr('value', 'no');
        cur_block.find('.radio_section.tb_4_ck .checkbox').click();
        cur_block.hide();


        if (icon_num > 0) {
            var prev_block = jQuery('.sfsi_plus_responsive_custom_icon_' + (icon_num - 1) + '_container');
            prev_block.find('.sfsi_plus_responsive_custom_delete_btn').show();
        }
        // jQuery('.sfsi_plus_responsive_custom_icon_container').each(function(index,custom_icon){
        // 	var target= jQuery(custom_icon);
        // 	target.find('.sfsi_plus_responsive_custom_delete_btn');
        // 	var custom_id = target.find('.sfsi_plus_responsive_custom_delete_btn').attr('data-id');
        // 	if(custom_id>icon_num){
        // 		target.removeClass('sfsi_plus_responsive_custom_icon_'+custom_id+'_container').addClass('sfsi_plus_responsive_custom_icon_'+(custom_id-1)+'_container');
        // 		target.find('input[name="sfsi_plus_responsive_custom_'+custom_id+'_added"]').attr('name',"sfsi_plus_responsive_custom_"+(custom_id-1)+"_added");
        // 		target.find('#sfsi_plus_responsive_'+custom_id+'_display').removeClass('sfsi_plus_responsive_custom_'+custom_id+'_display').addClass('sfsi_plus_responsive_custom_'+(custom_id-1)+'_display').attr('id','sfsi_plus_responsive_'+(custom_id-1)+'_display').attr('name','sfsi_plus_responsive_custom_'+(custom_id-1)+'_display').attr('data-custom-index',(custom_id-1));
        // 		target.find('.sfsi_plus_responsive_icon_item_container').removeClass('sfsi_plus_responsive_icon_custom_'+custom_id+'_container').addClass('sfsi_plus_responsive_icon_custom_'+(custom_id-1)+'_container');
        // 		target.find('.sfsi_plus_responsive_input').attr('name','sfsi_plus_responsive_custom_'+(custom_id-1)+'_input');
        // 		target.find('.sfsi_plus_responsive_url_input').attr('name','sfsi_plus_responsive_custom_'+(custom_id-1)+'_url_input');
        // 		target.find('.sfsi_plus_bg-color-picker').attr('name','sfsi_plus_responsive_icon_'+(custom_id-1)+'_bg_color');
        // 		target.find('.sfsi_plus_logo_upload sfsi_plus_logo_custom_'+custom_id+'_upload').removeClass('sfsi_plus_logo_upload sfsi_plus_logo_custom_'+custom_id+'_upload').addClass('sfsi_plus_logo_upload sfsi_plus_logo_custom_'+(custom_id-1)+'_upload');
        // 		target.find('input[type="sfsi_plus_responsive_icons_custom_'+custom_id+'_icon"]').attr('name','input[type="sfsi_plus_responsive_icons_custom_'+(custom_id-1)+'_icon"]');				
        // 		target.find('.sfsi_plus_responsive_custom_delete_btn').attr('data-id',''+(custom_id-1));				
        // 	}
        // });
        // // sfsi_plus_backend_section_beforeafter_set_fixed_width();
        //    // jQuery(window).on('resize',sfsi_plus_backend_section_beforeafter_set_fixed_width);
        // var new_block=jQuery('.sfsi_plus_responsive_custom_icon_container').clone();
        // jQuery('.sfsi_plus_responsive_custom_icon_container').remove();
        // jQuery('.sfsi_plus_responsive_default_icon_container').parent().append(last_block).append();
        // jQuery('.sfsi_plus_responsive_default_icon_container').parent().append(new_block);
        // return false;
    })
}

function sfsi_plus_responsive_icon_counter_tgl(hide, show, ref = null) {
    if (null !== hide && '' !== hide) {
        jQuery('.' + hide).hide();
    }
    if (null !== show && '' !== show) {
        jQuery('.' + show).show();
    }
}

function sfsi_plus_responsive_toggle_count() {
    var data = jQuery('input[name="sfsi_plus_responsive_icon_show_count"]:checked').val();
    var data2 = jQuery('input[name="sfsi_plus_display_counts"]:checked').val();
    if (data2 == "yes" && 'yes' == data) {
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('display', 'inline-block');
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').removeClass('sfsi_plus_responsive_without_counter_icons').addClass('sfsi_plus_responsive_with_counter_icons');
        sfsi_plus_resize_icons_container();
    } else {
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').css('display', 'none');
        jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').removeClass('sfsi_plus_responsive_with_counter_icons').addClass('sfsi_plus_responsive_without_counter_icons');
        sfsi_plus_resize_icons_container();
    }
}

function sfsi_plus_responsive_open_url(event) {
    jQuery(event.target).parent().find('.sfsi_plus_responsive_custom_url_hide').show();
    jQuery(event.target).parent().find('.sfsi_plus_responsive_default_url_hide').show();
    jQuery(event.target).parent().find('.sfsi_plus_responsive_url_input').show();
    jQuery(event.target).hide();
}

function sfsi_plus_responsive_icon_hide_responsive_options() {
    jQuery('.sfsiplus_PostsSettings_section').show();
    jQuery('.sfsi_plus_choose_post_types_section').show();
    jQuery('.sfsi_plus_not_responsive').show();
}

function sfsi_plus_responsive_icon_show_responsive_options() {
    jQuery('.sfsiplus_PostsSettings_section').hide();
    jQuery('.sfsi_plus_choose_post_types_section').hide();
    jQuery('.sfsi_plus_not_responsive').hide();
    window.sfsi_plus_fittext_shouldDisplay = true;
    jQuery('.sfsi_plus_responsive_icon_preview a').each(function (index, a_container) {
        if (jQuery(a_container).css('display') !== "none") {
            sfsi_plus_fitText(jQuery(a_container).find('.sfsi_plus_responsive_icon_item_container'));
        }
    })
    sfsi_plus_resize_icons_container();
}

function sfsi_plus_scroll_to_div(option_id, scroll_selector) {
    jQuery('#' + option_id + '.ui-accordion-header[aria-selected="false"]').click() //opened the option
    //scroll to it.
    if (scroll_selector && scroll_selector !== '') {
        scroll_selector = scroll_selector;
    } else {
        scroll_selector = '#' + option_id + '.ui-accordion-header';
    }
    jQuery('html, body').stop().animate({
        scrollTop: jQuery(scroll_selector).offset().top
    }, 1000);
}

function sfsi_plus_fitText(container) {
    if (container.parent().parent().hasClass('sfsi_plus_icons_container_box_fixed_container')) {
        if (window.sfsi_plus_fittext_shouldDisplay === true) {
            if (jQuery('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() == "Fully responsive") {
                var all_icon_width = jQuery('.sfsi_plus_responsive_icons .sfsi_plus_icons_container').width();
                var total_active_icons = jQuery('.sfsi_plus_responsive_icons .sfsi_plus_icons_container a').filter(function (i, icon) {
                    return jQuery(icon).css('display') && (jQuery(icon).css('display').toLowerCase() !== "none");
                }).length;

                var distance_between_icon = jQuery('input[name="sfsi_plus_responsive_icons_settings_margin"]').val()
                var container_width = ((all_icon_width - distance_between_icon) / total_active_icons) - 5;
                container_width = (container_width - distance_between_icon);
            } else {
                var container_width = container.width();
            }
            // var container_img_width = container.find('img').width();
            var container_img_width = 70;
            // var span=container.find('span').clone();
            var span = container.find('span');
            // var span_original_width = container.find('span').width();
            var span_original_width = container_width - (container_img_width)
            span
                // .css('display','inline-block')
                .css('white-space', 'nowrap')
            // .css('width','auto')
            ;
            var span_flatted_width = span.width();
            if (span_flatted_width == 0) {
                span_flatted_width = span_original_width;
            }
            span
                // .css('display','inline-block')
                .css('white-space', 'unset')
            // .css('width','auto')
            ;
            var shouldDisplay = ((undefined === window.sfsi_plus_fittext_shouldDisplay) ? true : window.sfsi_plus_fittext_shouldDisplay = true);
            var fontSize = parseInt(span.css('font-size'));

            if (6 > fontSize) {
                fontSize = 20;
            }

            var computed_fontSize = (Math.floor((fontSize * span_original_width) / span_flatted_width));

            if (computed_fontSize < 8) {
                shouldDisplay = false;
                window.sfsi_plus_fittext_shouldDisplay = false;
                computed_fontSize = 20;
            }
            span.css('font-size', Math.min(computed_fontSize, 20));
            span
                // .css('display','inline-block')
                .css('white-space', 'nowrap')
            // .css('width','auto')
            ;
            if (shouldDisplay) {
                span.show();
            } else {
                span.hide();
                jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icon_item_container  span').hide();
            }
        }
    } else {
        var span = container.find('span');
        span.css('font-size', 'initial');
        span.show();
    }

}

function sfsi_plus_fixedWidth_fitText(container) {
    return;
    if (window.sfsi_plus_fittext_shouldDisplay === true) {
        if (jQuery('select[name="sfsi_plus_responsive_icons_settings_icon_width_type"]').val() == "Fixed icon width") {
            var all_icon_width = jQuery('.sfsi_plus_responsive_icons .sfsi_plus_icons_container').width();
            var total_active_icons = jQuery('.sfsi_plus_responsive_icons .sfsi_plus_icons_container a').filter(function (i, icon) {
                return jQuery(icon).css('display') && (jQuery(icon).css('display').toLowerCase() !== "none");
            }).length;
            var distance_between_icon = jQuery('input[name="sfsi_plus_responsive_icons_settings_margin"]').val()
            var container_width = ((all_icon_width - distance_between_icon) / total_active_icons) - 5;
            container_width = (container_width - distance_between_icon);
        } else {
            var container_width = container.width();
        }
        // var container_img_width = container.find('img').width();
        var container_img_width = 70;
        // var span=container.find('span').clone();
        var span = container.find('span');
        // var span_original_width = container.find('span').width();
        var span_original_width = container_width - (container_img_width)
        span
            // .css('display','inline-block')
            .css('white-space', 'nowrap')
        // .css('width','auto')
        ;
        var span_flatted_width = span.width();
        if (span_flatted_width == 0) {
            span_flatted_width = span_original_width;
        }
        span
            // .css('display','inline-block')
            .css('white-space', 'unset')
        // .css('width','auto')
        ;
        var shouldDisplay = undefined === window.sfsi_plus_fittext_shouldDisplay ? true : window.sfsi_plus_fittext_shouldDisplay = true;;
        var fontSize = parseInt(span.css('font-size'));

        if (6 > fontSize) {
            fontSize = 15;
        }

        var computed_fontSize = (Math.floor((fontSize * span_original_width) / span_flatted_width));

        if (computed_fontSize < 8) {
            shouldDisplay = false;
            window.sfsi_plus_fittext_shouldDisplay = false;
            computed_fontSize = 15;
        }
        span.css('font-size', Math.min(computed_fontSize, 15));
        span
            // .css('display','inline-block')
            .css('white-space', 'nowrap')
        // .css('width','auto')
        ;
        // var heightOfResIcons = jQuery('.sfsi_plus_responsive_icon_item_container').height();

        //   if(heightOfResIcons < 17){
        //     span.show();
        //   }else{
        //     span.hide();
        //   }

        if (shouldDisplay) {
            span.show();
        } else {
            span.hide();
        }
    }
}

function sfsi_plus_resize_icons_container() {
    return;
    // resize icon container based on the size of count
    sfsi_plus_cloned_icon_list = jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').clone();
    sfsi_plus_cloned_icon_list.removeClass('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_with_counter_icons').addClass('sfsi_plus_responsive_cloned_list');
    sfsi_plus_cloned_icon_list.css('width', '100%');
    jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').parent().append(sfsi_plus_cloned_icon_list);

    // sfsi_plus_cloned_icon_list.css({
    //       position: "absolute",
    //       left: "-10000px"
    //   }).appendTo("body");
    actual_width = sfsi_plus_cloned_icon_list.width();
    count_width = jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_responsive_icons_count').width();
    jQuery('.sfsi_plus_responsive_cloned_list').remove();
    sfsi_plus_inline_style = jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').attr('style');
    // remove_width 
    sfsi_plus_inline_style = sfsi_plus_inline_style.replace(/width:auto($|!important|)(;|$)/g, '').replace(/width:\s*(-|)\d*\s*(px|%)\s*($|!important|)(;|$)/g, '');
    if (!(jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').hasClass('sfsi_plus_responsive_without_counter_icons') && jQuery('.sfsi_plus_icons_container').hasClass('sfsi_plus_icons_container_box_fixed_container'))) {
        sfsi_plus_inline_style += "width:" + (actual_width - count_width - 1) + 'px!important;'
    } else {
        sfsi_plus_inline_style += "width:auto!important;";
    }
    jQuery('.sfsi_plus_responsive_icon_preview .sfsi_plus_icons_container').attr('style', sfsi_plus_inline_style);

}

function sellcodesSuccess(data) {
    console.log(data);

}

function sfsi_plus_worker_wait() {
    var html = '<div class="pop-overlay read-overlay sfsi_plus_premium_installer-overlay" style="background: rgba(255, 255, 255, 0.6); z-index: 9999; overflow-y: auto; display: block;">' +
        '<div style="width:100%;height:100%"> <div style="width:50px;margin:auto;margin-top:20%"> <style type="text/css"> .lds-roller{display: inline-block; position: relative; width: 64px; height: 64px;}.lds-roller div{animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite; transform-origin: 32px 32px;}.lds-roller div:after{content: " "; display: block; position: absolute; width: 6px; height: 6px; border-radius: 50%; background: #333; margin: -3px 0 0 -3px;}.lds-roller div:nth-child(1){animation-delay: -0.036s;}.lds-roller div:nth-child(1):after{top: 50px; left: 50px;}.lds-roller div:nth-child(2){animation-delay: -0.072s;}.lds-roller div:nth-child(2):after{top: 54px; left: 45px;}.lds-roller div:nth-child(3){animation-delay: -0.108s;}.lds-roller div:nth-child(3):after{top: 57px; left: 39px;}.lds-roller div:nth-child(4){animation-delay: -0.144s;}.lds-roller div:nth-child(4):after{top: 58px; left: 32px;}.lds-roller div:nth-child(5){animation-delay: -0.18s;}.lds-roller div:nth-child(5):after{top: 57px; left: 25px;}.lds-roller div:nth-child(6){animation-delay: -0.216s;}.lds-roller div:nth-child(6):after{top: 54px; left: 19px;}.lds-roller div:nth-child(7){animation-delay: -0.252s;}.lds-roller div:nth-child(7):after{top: 50px; left: 14px;}.lds-roller div:nth-child(8){animation-delay: -0.288s;}.lds-roller div:nth-child(8):after{top: 45px; left: 10px;}@keyframes lds-roller{0%{transform: rotate(0deg);}100%{transform: rotate(360deg);}}</style> <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' +
        '<div style="text-align: center;font-size:32px">Please wait while we are installing the premium plugin.</div>' +
        '</div>';
    jQuery('body').append(html);
    jQuery('.sfsi_plus_premium_installer-overlay').show();
}

function sellcodesSuccess(data) {
    if (data.installation) {
        sfsi_plus_worker_plugin(data);
    }
}

function sfsi_plus_install_newsletter() {
    var nonce = SFSI("#sfsi_plus_install_newsletter").attr("data-nonce");
    var data = {
        action: "install_newsletter",
        nonce: nonce
    };
    SFSI.ajax({
        url: sfsi_plus_ajax_object.ajax_url,
        type: "post",
        data: data,
        success: function (s) {
            if (s == "wrong_nonce") {
                sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
                global_error = 1;
            } else {
                console.log(s);
            }
        }
    });
}

function sfsi_plus_installDate_save() {
    var nonce = SFSI("#sfsi_plus_installDate").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_installDate = SFSI("input[name='sfsi_plus_installDate']").val();
    var data = {
        action: "sfsi_plus_installDate",
        sfsi_plus_installDate: sfsi_plus_installDate,
        nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}

function sfsi_plus_currentDate_save(){
    var nonce = SFSI("#sfsi_plus_currentDate").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_currentDate = SFSI("input[name='sfsi_plus_currentDate']").val();
	var data = {
        action: "sfsi_plus_currentDate",
        sfsi_plus_currentDate:sfsi_plus_currentDate,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}

function sfsi_plus_showNextBannerDate_save(){
    var nonce = SFSI("#sfsi_plus_showNextBannerDate").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_showNextBannerDate = SFSI("input[name='sfsi_plus_showNextBannerDate']").val();
	var data = {
        action: "sfsi_plus_showNextBannerDate",
        sfsi_plus_showNextBannerDate:sfsi_plus_showNextBannerDate,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}

function sfsi_plus_cycleDate_save(){
    var nonce = SFSI("#sfsi_plus_cycleDate").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_cycleDate = SFSI("input[name='sfsi_plus_cycleDate']").val();
	var data = {
        action: "sfsi_plus_cycleDate",
        sfsi_plus_cycleDate:sfsi_plus_cycleDate,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}

function sfsi_plus_loyaltyDate_save(){
    var nonce = SFSI("#sfsi_plus_loyaltyDate").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_loyaltyDate = SFSI("input[name='sfsi_plus_loyaltyDate']").val();
	var data = {
        action: "sfsi_plus_loyaltyDate",
        sfsi_plus_loyaltyDate:sfsi_plus_loyaltyDate,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_firsttime_offer_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_firsttime_offer").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_firsttime_offer = SFSI("input[name='sfsi_plus_banner_global_firsttime_offer']").val();
	var data = {
        action: "sfsi_plus_banner_global_firsttime_offer",
        sfsi_plus_banner_global_firsttime_offer:sfsi_plus_banner_global_firsttime_offer,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_pinterest_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_pinterest").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_pinterest = SFSI("input[name='sfsi_plus_banner_global_pinterest']").val();
	var data = {
        action: "sfsi_plus_banner_global_pinterest",
        sfsi_plus_banner_global_pinterest:sfsi_plus_banner_global_pinterest,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_social_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_social").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_social = SFSI("input[name='sfsi_plus_banner_global_social']").val();
	var data = {
        action: "sfsi_plus_banner_global_social",
        sfsi_plus_banner_global_social:sfsi_plus_banner_global_social,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_load_faster_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_load_faster").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_load_faster = SFSI("input[name='sfsi_plus_banner_global_load_faster']").val();
	var data = {
        action: "sfsi_plus_banner_global_load_faster",
        sfsi_plus_banner_global_load_faster:sfsi_plus_banner_global_load_faster,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_shares_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_shares").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_shares = SFSI("input[name='sfsi_plus_banner_global_shares']").val();
	var data = {
        action: "sfsi_plus_banner_global_shares",
        sfsi_plus_banner_global_shares:sfsi_plus_banner_global_shares,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_gdpr_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_gdpr").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_gdpr = SFSI("input[name='sfsi_plus_banner_global_gdpr']").val();
	var data = {
        action: "sfsi_plus_banner_global_gdpr",
        sfsi_plus_banner_global_gdpr:sfsi_plus_banner_global_gdpr,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_http_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_http").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_http = SFSI("input[name='sfsi_plus_banner_global_http']").val();
	var data = {
        action: "sfsi_plus_banner_global_http",
        sfsi_plus_banner_global_http:sfsi_plus_banner_global_http,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}


function sfsi_plus_banner_global_upgrade_save(){
    var nonce = SFSI("#sfsi_plus_banner_global_upgrade").attr("data-nonce");
    console.log(nonce);
    var sfsi_plus_banner_global_upgrade = SFSI("input[name='sfsi_plus_banner_global_upgrade']").val();
	var data = {
        action: "sfsi_plus_banner_global_upgrade",
        sfsi_plus_banner_global_upgrade:sfsi_plus_banner_global_upgrade,
		nonce: nonce
    };
    console.log(data);
	SFSI.ajax({
		url: sfsi_plus_ajax_object.ajax_url,
		type: "post",
		data: data,
		success: function (s) {
			console.log(s);
			if (s == "wrong_nonce") {
				sfsiplus_showErrorSuc("error", "Unauthorised Request, Try again after refreshing page", 6);
				global_error = 1;
			} else {
				console.log(s);
			}
		}
	});
}
