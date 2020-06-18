(function($) {
    
    var methods = {
        init: function(options) {
            var settings = $.extend({}, $.fn.accordion.defaults, options);
        
            this.find(".schedule-content")
                .attr("data-active", false)
                .slideUp();
                
            var $this = this;
                
            this.on("click", ".schedule-subject", function(e) {
              
              var current = $(e.target).parent().parent().find(".schedule-content");
              var active = $(".schedule-content[data-active=true]");
             
              
              if(current.attr("data-active") === 'false') {
                current.attr("data-active", true)
                          .slideDown({
                  complete: function() {
                    active
                    .attr("data-active", false)
                    .slideUp();
                  }
                });
              
                
                
              }
              else {
                  
                  current.attr("data-active", false)
                          .slideUp();
                          return;
                  
              }

                
              
                
              
            });
            
            return this;
        },
        expand: function() {
            this.find(".schedule-content")
                .attr("data-active", true)
                .slideDown();
                
            return this;
        },
        collapse: function() {
            this.find("[data-active]")
                    .removeAttr("data-active")
                    .slideUp();
                        
            return this;
        }
    };
    
    $.fn.accordion = function(options) {
        if (methods[options]) {
            return methods[options].call(this);
        }
        
        return methods.init.call(this, options);
    };
    
    
    $.fn.accordion.defaults = {
      distinct: false
    };
    
    
}(jQuery));