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
            console.log("dddd");
            self.loadData();
        },

        loadData: function(){
            var self = this;
            $.ajax({
                url: self.options.url,
                type: 'GET',
                success: function(data) {
                    self.addedData(jQuery.parseJSON(data));
                    console.log(data);
                }
            });
        },

        addedData: function(data){
            for(i in data){
                message = '[' + data[i].time + '] ' + data[i].username + ': ' + data[i].message;
                $('.chat_text').append('<span class="d_block">' + message + '</span>');
            }
        }
    });
})(jQuery);