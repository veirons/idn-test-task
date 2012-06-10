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
            var self = this;//
            //var url = 'simple_chat.getMessage';
            $.ajax({
                url: self.options.url,
                type: 'GET',
                success: function(data) {
                   console.log(data);
                }
            });
        }
    });
})(jQuery);