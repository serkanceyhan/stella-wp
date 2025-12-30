/*
    Google Maps
    Version: 2.4.2
    Release date: Fri Mar 26 2021

    https://elfsight.com

    Copyright (c) 2021 Elfsight, LLC. ALL RIGHTS RESERVED
*/

!function(e,a,t){"use strict";a.add("api-key",e.noop),e(function(){const a="elfsight-admin-page-api-key-form",n=e(".elfsight-admin"),s=e("."+a),i=s.find("."+a+"-input"),o=s.find("."+a+"-button-connect"),d=t=>{e("."+a).removeClass([a+"-connect",a+"-success",a+"-fail"].join(" ")).addClass(a+"-"+t),n.toggleClass("elfsight-admin-api-key-invalid","success"!==t),u=t,"success"===t?(i.attr("readonly",!0),o.text("Clear API key").addClass("elfsight-admin-button-gray").removeClass("elfsight-admin-button-green")):(i.attr("readonly",!1),o.text("Save API key").addClass("elfsight-admin-button-green").removeClass("elfsight-admin-button-gray"))},l=a=>e.ajax({type:"POST",url:pluginParams.restApiUrl+"/update-preferences/",data:{option:{name:"api_key",value:a}},dataType:"json",beforeSend:function(e){e.setRequestHeader("X-WP-Nonce",wpApiSettings.nonce)}}),c=e=>e&&/^(.{39})$/.test(e);let r,u;t.addEventListener("message",e=>{if(!e.data)return;const a=e.data;a.action&&~a.action.search("EappsPreview.appPreferences.updated")&&(r=a.data).apiKey&&(f=r.apiKey)!==i.val()&&(i.val(f).attr("readonly",!0),o.text("Clear API key").addClass("elfsight-admin-button-gray").removeClass("elfsight-admin-button-green"),d("success"),l(f).then(function(){document.location.reload()}))});let f=i.val();c(f)?d("success"):d("connect"),o.click(()=>{if("success"===u&&i.val(""),f!==i.val()||""===i.val()){if(""===(f=i.val()))return"success"===u&&(s.addClass(a+"-reload-active"),l(f).then(function(){document.location.reload()})),void d("connect");""!==f&&c(f)?(d("success"),s.addClass(a+"-reload-active"),l(f).then(function(){document.location.reload()})):d("fail")}})})}(window.jQuery,window.elfsightAdminPagesController||{},window);