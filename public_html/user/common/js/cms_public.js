﻿
function kakunin(msg, url) {
    if (confirm(msg)) {
        location.href = url;
    }
}

function alert_dlg(message, options) {
    var buttons = [
        {
          text:'はい',
          click: function(){
            $(this).dialog("close");
          }
        }
    ];

    if (typeof options !== 'undefined') {
        if (typeof options.buttons !== 'undefined') {
            buttons = options.buttons;
        }
    }
    $("#kakunin_dialog").dialog({
        autoOpen:false,
        width:300,
        modal: true,
        buttons: buttons
    });
    $("#kakunin_dialog p").html(message);
    $("#kakunin_dialog").dialog("open");
}

function ajax_get(url, method, params, success) {
    var data = null;
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function(event) {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                data = JSON.parse(xhr.responseText);
                success(data);
            } else {
                console.log(xhr.statusText);
            }
        }
    };
    xhr.onerror = function(event) {
        console.log(event.type);
    };

    if (method == 'GET') {
        xhr.send(null);
    } else {
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send( EncodeHTMLForm(params));
    }

  return data;
}
// HTMLフォームの形式にデータを変換する
function EncodeHTMLForm( data )
{
    var params = [];

    for( var name in data )
    {
        var value = data[ name ];
        var param = encodeURIComponent( name ) + '=' + encodeURIComponent( value );

        params.push( param );
    }

    return params.join( '&' ).replace( /%20/g, '+' );
}