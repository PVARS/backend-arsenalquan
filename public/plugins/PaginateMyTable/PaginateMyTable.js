
(function ($) {

    $.fn.paginate = function (options) {

        //Default options
        var settings = $.extend({
            rows: 5,
            position: "bottom",
            jqueryui: false,
            showIfLess: true,
            textFristPage: '<i class="fas fa-fast-backward"></i>',
            textLastPage: '<i class="fas fa-fast-forward"></i>',
            textNextPage: '<i class="fas fa-step-forward"></i>',
            textBackPage: '<i class="fas fa-step-backward"></i>',
            numOfPages: 3
        }, options);

        var currentPage = 0;

        function renderPageging(table) {
            var rowPerPage = settings.rows;
            $('.pager').remove()
            var numRows = table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / rowPerPage);
            var pager = $('<div class="pager"></div>');

            //Check ui theming====================================================================
            var activeclass = settings.jqueryui ? "ui-state-active" : "active";
            var defaultclass = settings.jqueryui ? "ui-state-default" : "number";

            $('<span class="' + defaultclass + '">'+ settings.textFristPage +'</span>').bind('click', {
                newPage: 0
            }, function (event) {
                currentPage = 0;
                table.trigger('pageTable');
            }).appendTo(pager).addClass('clickable');

            $('<span class="' + defaultclass + '">'+ settings.textBackPage +'</span>').bind('click', {
                newPage: 0
            }, function (event) {
                currentPage == 0 ? 0 : currentPage -= 1 ;
                table.trigger('pageTable');
            }).appendTo(pager).addClass('clickable');

            for (var page = (currentPage - settings.numOfPages); page < numPages && page <= (currentPage + settings.numOfPages); page++) {
                isActiveClass = " "
                if(page >= 0){
                    if (page == currentPage ){
                        isActiveClass = " " + activeclass
                    }

                    $('<span class="' + defaultclass + isActiveClass + '"></span>').text(page + 1).bind('click', {
                        newPage: page
                    }, function (event) {
                        currentPage = event.data['newPage'];
                        table.trigger('pageTable');
                    }).appendTo(pager).addClass('clickable');
                }
            }


            $('<span class="' + defaultclass + '">'+ settings.textNextPage +'</span>').bind('click', {
                newPage: 0
            }, function (event) {
                currentPage == (numPages-1) ? currentPage : currentPage +=1 ;
                table.trigger('pageTable');
            }).appendTo(pager).addClass('clickable');

            $('<span class="' + defaultclass + '">'+ settings.textLastPage +'</span>').bind('click', {
                newPage: 0
            }, function (event) {
                currentPage = (numPages-1);
                table.trigger('pageTable');
            }).appendTo(pager).addClass('clickable');
            //Add pager===========================================================================
            if (settings.showIfLess) {

                if (settings.position == "bottom") {
                    pager.insertAfter(table);
                }
                else if (settings.position == "top") {
                    pager.insertBefore(table);
                }
            }
            else if (rowPerPage < numRows) {
                if (settings.position == "bottom") {
                    pager.insertAfter(table);
                }
                else if (settings.position == "top") {
                    pager.insertBefore(table);
                }
            }
        };

        $(this).each(function () {
            var rowPerPage = settings.rows;
            var table = $(this);

            table.bind('pageTable', function () {
                renderPageging(table)
                table.find('tbody tr').hide().slice(currentPage * rowPerPage, (currentPage + 1) * rowPerPage).show();
            });
            table.trigger('pageTable');
        });

        return this;
    }


})(jQuery);



