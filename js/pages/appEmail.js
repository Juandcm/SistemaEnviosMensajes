/*
 *  Document   : appEmail.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Email Center page
 */

var AppEmail = function() {

    return {
        init: function() {
            // Choose one of the highlight classes for the message list rows: 'active', 'success', 'warning', 'danger'
            var rowHighlightClass = 'warning';

            /* Add/Remove row highlighting on checkbox click */
            $('tbody input:checkbox').click(function() {
                var checkedStatus   = $(this).prop('checked');
                var tableRow        = $(this).closest('tr');

                if (checkedStatus) {
                    tableRow.addClass(rowHighlightClass);
                } else {
                    tableRow.removeClass(rowHighlightClass);
                }
            });

            /* Show/Hide Message view - Just for preview */
            var inboxList = $('#message-list');
            var inboxView = $('#message-view');

            inboxList.find('h4 > a').on('click', function(){
                inboxList
                    .removeClass('animation-fadeInQuick2Inv')
                    .addClass('display-none');

                inboxView
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2');
            });

            inboxView.find('#message-view-back').on('click', function(){
                inboxView
                    .removeClass('animation-fadeInQuick2')
                    .addClass('display-none');

                inboxList
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2Inv');
            });


            // /* Show/Hide Message view - Just for preview */
            // var inboxList1 = $('#message-list1');
            // var inboxView1 = $('#message-view1');

            // inboxList1.find('h4 > a').on('click', function(){
            //     inboxList1
            //         .removeClass('animation-fadeInQuick2Inv')
            //         .addClass('display-none');

            //     inboxView1
            //         .removeClass('display-none')
            //         .addClass('animation-fadeInQuick2');
            // });

            // inboxView1.find('#message-view-back1').on('click', function(){
            //     inboxView1
            //         .removeClass('animation-fadeInQuick2')
            //         .addClass('display-none');

            //     inboxList1
            //         .removeClass('display-none')
            //         .addClass('animation-fadeInQuick2Inv');
            // });


            /* Show/Hide Message view - Just for preview */
            var inboxList2 = $('#message-list2');
            var inboxView2 = $('#message-view2');

            inboxList2.find('h4 > a').on('click', function(){
                inboxList2
                    .removeClass('animation-fadeInQuick2Inv')
                    .addClass('display-none');

                inboxView2
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2');
            });

            inboxView2.find('#message-view-back2').on('click', function(){
                inboxView2
                    .removeClass('animation-fadeInQuick2')
                    .addClass('display-none');

                inboxList2
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2Inv');
            });

            /* Show/Hide Message view - Just for preview */
            var inboxList3 = $('#message-list3');
            var inboxView3 = $('#message-view3');

            inboxList3.find('h4 > a').on('click', function(){
                inboxList3
                    .removeClass('animation-fadeInQuick2Inv')
                    .addClass('display-none');

                inboxView3
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2');
            });

            inboxView3.find('#message-view-back3').on('click', function(){
                inboxView3
                    .removeClass('animation-fadeInQuick2')
                    .addClass('display-none');

                inboxList3
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2Inv');
            });
        }
    };
}();