(function($){"use strict";var promise=false,deferred=$.Deferred();$.fn.uiInclude=function(){if(!promise){promise=deferred.promise();}compile(this);function compile(node){node.find('[ui-include], [data-ui-include]').each(function(){var that=$(this),url=that.attr('ui-include')||that.attr('data-ui-include');promise=promise.then(function(){var request=$.ajax({url:eval(url),method:"GET",dataType:"text"});var chained=request.then(function(text){var ui=that.replaceWithPush(text);ui.find('[ui-jp], [data-ui-jp]').uiJp();ui.find('[ui-include], [data-ui-include]').length&&compile(ui);});return chained;});});}deferred.resolve();return promise;}
$.fn.replaceWithPush=function(o){var $o=$(o);this.replaceWith($o);return $o;}})(jQuery);