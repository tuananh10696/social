
function click_mokuji(e) {
    var _this = $(e);

    var lv0 = _this.parents(".lv0");
    var lv1 = _this.parents(".lv1");
    // 目次項目
    var i = lv0.index();
    var i1 = lv1.index();
    var item = $($('.box-content')[i]);

    if (lv1.length > 0)
        item = $(item.find("h3")[i1]);

    // var headerH = $('header').height();

    if (item && item.length > 0) {
        var scroll = (item.offset().top | item.scrollHeight) - (40);
        $("html, body").animate({
            scrollTop: scroll
        }, 500);
    }
}


// 自動生成目次
$(document).ready(function () {
    var h2 = $('.box-content');
    if (h2.length > 0) {
        var temp_mokuji = `<div class="box-bg">`;
        temp_mokuji += `<p class="box-bg__catch">もくじ</p>`;
        temp_mokuji += `<div class="box-bg__text"><ul class="list-bdb">`;

        h2.each(function () {
            var txt = $(this).find('>h2')
                .contents()
                .not($('span'))
                .text()
                .trim();


            temp_mokuji += `<li class="lv0"><a style='color: #282828;text-decoration: none;' onclick="click_mokuji(this)">${htmlEncode(txt)}</a>`;

            if ($(this).find('>h3').length > 0) {
                temp_mokuji += `<ul class="list-dot02">`;
                $(this).find('>h3').each(function () {
                    var txt_h3 = $(this)
                        .contents()
                        .not($('span'))
                        .text()
                        .trim();


                    temp_mokuji += `<li class="lv1"><a style='color: #282828;text-decoration: none;' onclick="click_mokuji(this)">${htmlEncode(txt_h3)}</a></li>`;

                });

                temp_mokuji += `</ul>`;
            }
            temp_mokuji += `</li>`;

        });
        temp_mokuji += `</ul></div>`;
        temp_mokuji += `</div>`;

        $(temp_mokuji).insertAfter($('div.description-image'));
    }
});


function htmlEncode(html) {
    html = $.trim(html);
    return html.replace(/[&"'\<\>]/g, function (c) {
        switch (c) {
            case "&":
                return "&amp;";
            case "'":
                return "&#39;";
            case '"':
                return "&quot;";
            case "<":
                return "&lt;";
            default:
                return "&gt;";
        }
    });
};