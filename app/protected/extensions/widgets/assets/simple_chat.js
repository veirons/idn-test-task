/**
 * Created by JetBrains PhpStorm.
 * User: developer
 * Date: 25.05.12
 * Time: 10:11
 * To change this template use File | Settings | File Templates.
 */

(function($){
    $.widget('ui.chat', {
        options: {
            count: null
        },

        _create:function() {
            var self = this;
            self.loadData();
            self.addEvents();
        },

        addEvents: function() {
            var self = this;
            $('.chat_left').live('click', function(){
                self.changeChatView();
            });
            $('.hidden_chat').live('click', function(){
                self.showChat();
            });
            $('.show_chat').live('click', function(){
                self.hideChat();
            });
        },

        changeChatView: function() {
            $('.chat_left').toggleClass('hidden_chat');
            $('.chat_left').toggleClass('show_chat');
        },

        showChat: function() {
            $('.chat_main').animate({"width": "510px"}, "slow");
        },

        hideChat: function() {
            $('.chat_main').animate({"width": "0px"}, "slow");
        },

        loadData: function() {
            var self = this;
            var data = self.options.count;
            $.ajax({
                url: self.options.url,
                type: 'GET',
                data: data,
                success: function(data) {
                    self.addedData(jQuery.parseJSON(data));
                    console.log(data);
                }
            });
        },

        addedData: function(data) {
            for(i in data){
                message = '[' + data[i].time + '] ' + data[i].username + ': ' + data[i].message;
                $('.chat_text').append('<span class="d_block">' + message + '</span>');
            }
        }
    });
})(jQuery);