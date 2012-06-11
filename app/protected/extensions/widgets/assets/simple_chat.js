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
            limitCount: null,
            urlAdd: null,
            urlGet: null,
            upTime: null,
            lastID: 0
        },

        _create:function() {
            this.loadData(this.options.limitCount);
            this.addEvents();
            this.refresh();
        },

        /**
        * bins action for elements
        */
        addEvents: function() {
            var self = this;
            $('.chat_left').live('click', function(){
                self.changeChatClass();
            });
            $('.hidden_chat').live('click', function(){
                self.showChat();
            });
            $('.show_chat').live('click', function(){
                self.hideChat();
            });
            $('.button_send').live('click', function(){
                self.sendMessage();
                return false;
            });
        },

        /**
        * change chat class to hide/show
        */
        changeChatClass: function() {
            $('.chat_left').toggleClass('hidden_chat');
            $('.chat_left').toggleClass('show_chat');
        },

        /**
        * show chat full view
        */
        showChat: function() {
            $('.chat_main').animate({"width": "510px"}, "slow");
        },

        /**
        * hide chat
        */
        hideChat: function() {
            $('.chat_main').animate({"width": "0px"}, "slow");
        },

        /**
        * load count message
        */
        loadData: function(count) {
            var self = this;
            var data = {count : count, last_id: self.options.lastID};
            $.ajax({
                url: self.options.urlGet,
                type: 'GET',
                data: data,
                success: function(data) {
                    self.addedData(jQuery.parseJSON(data));
                }
            });
        },

        /**
        * send message
        */
        sendMessage: function() {
            if($('.chat_message').val()){
                var data = $('.button_send').parents('form').serialize();
                var self = this;
                $.ajax({
                    url: self.options.urlAdd,
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        $('.chat_message').val('');
                    }
                });
            }
        },

        /**
        * render messages to chat
        */
        addedData: function(data) {
            for(i in data){
                message = '[' + data[i].time + '] ' + data[i].username + ': ' + data[i].message;
                $('.chat_text').append('<span class="d_block">' + message + '</span>');
                this.options.lastID = data[i].id;
            }
            this.deleteOldMessage();
            var objDiv = document.getElementById("chat_text");
            objDiv.scrollTop = objDiv.scrollHeight;
        },

        /**
        * refresh chat in upTime interval
        */
        refresh: function() {
            var self = this;
            setInterval(function() { self.loadData(self.options.limitCount)}, self.options.upTime);
        },

        /**
        * delete old messages(if them more limitCount)
        */
        deleteOldMessage: function(){
            var countMessageToDelete = $('.chat_text').find('span').length - this.options.limitCount;
            if(countMessageToDelete > 0) {
                for (var i = 0; i < countMessageToDelete; i++) {
                    $('.chat_text').find('span:first').remove();
                }
            }
        }
    });
})(jQuery);