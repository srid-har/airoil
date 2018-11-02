!function($){$.fn.easyPaginate=function(options){var defaults={paginateElement:"li",hashPage:"page",elementsPerPage:10,effect:"default",slideOffset:200,firstButton:!0,firstButtonText:"<<",lastButton:!0,lastButtonText:">>",prevButton:!0,prevButtonText:"<",nextButton:!0,nextButtonText:">"};return this.each(function(instance){var plugin={};plugin.el=$(this),plugin.el.addClass("easyPaginateList"),plugin.settings={pages:0,objElements:Object,currentPage:1};var getNbOfPages=function(){return Math.ceil(plugin.settings.objElements.length/plugin.settings.elementsPerPage)},displayNav=function(){for(htmlNav='<div class="easyPaginateNav">',plugin.settings.firstButton&&(htmlNav+='<a href="#'+plugin.settings.hashPage+':1" title="First page" rel="1" class="first">'+plugin.settings.firstButtonText+"</a>"),plugin.settings.prevButton&&(htmlNav+='<a href="" title="Previous" rel="" class="prev">'+plugin.settings.prevButtonText+"</a>"),alert($(this).attr("page")),i=1;i<=plugin.settings.pages;i++)htmlNav+='<a href="#'+plugin.settings.hashPage+":"+i+'" title="Page '+i+'" rel="'+i+'" class="page">'+i+"</a>";plugin.settings.nextButton&&(htmlNav+='<a href="" title="Next" rel="" class="next">'+plugin.settings.nextButtonText+"</a>"),plugin.settings.lastButton&&(htmlNav+='<a href="#'+plugin.settings.hashPage+":"+plugin.settings.pages+'" title="Last page" rel="'+plugin.settings.pages+'" class="last">'+plugin.settings.lastButtonText+"</a>"),htmlNav+="</div>",plugin.nav=$(htmlNav),plugin.nav.css({width:plugin.el.width()}),plugin.el.after(plugin.nav);var e="#"+plugin.el.get(0).id+" + ";$(e+" .easyPaginateNav a.page,"+e+" .easyPaginateNav a.first,"+e+" .easyPaginateNav a.last").on("click",function(e){e.preventDefault(),displayPage($(this).attr("rel"))}),$(e+" .easyPaginateNav a.prev").on("click",function(e){e.preventDefault(),page=plugin.settings.currentPage>1?parseInt(plugin.settings.currentPage)-1:1,displayPage(page)}),$(e+" .easyPaginateNav a.next").on("click",function(e){e.preventDefault(),page=plugin.settings.currentPage<plugin.settings.pages?parseInt(plugin.settings.currentPage)+1:plugin.settings.pages,displayPage(page)})},displayPage=function(page,forceEffect){if(plugin.settings.currentPage!=page)switch(plugin.settings.currentPage=parseInt(page),offsetStart=(page-1)*plugin.settings.elementsPerPage,offsetEnd=page*plugin.settings.elementsPerPage,void 0!==forceEffect?eval("transition_"+forceEffect+"("+offsetStart+", "+offsetEnd+")"):eval("transition_"+plugin.settings.effect+"("+offsetStart+", "+offsetEnd+")"),plugin.nav.find(".current").removeClass("current"),plugin.nav.find("a.page:eq("+(page-1)+")").addClass("current"),plugin.settings.currentPage){case 1:$(".easyPaginateNav a",plugin).removeClass("disabled"),$(".easyPaginateNav a.first, .easyPaginateNav a.prev",plugin).addClass("disabled");break;case plugin.settings.pages:$(".easyPaginateNav a",plugin).removeClass("disabled"),$(".easyPaginateNav a.last, .easyPaginateNav a.next",plugin).addClass("disabled");break;default:$(".easyPaginateNav a",plugin).removeClass("disabled")}},transition_default=function(e,t){plugin.currentElements.hide(),plugin.currentElements=plugin.settings.objElements.slice(e,t).clone(),plugin.el.html(plugin.currentElements),plugin.currentElements.show()},transition_fade=function(e,t){plugin.currentElements.fadeOut(),plugin.currentElements=plugin.settings.objElements.slice(e,t).clone(),plugin.el.html(plugin.currentElements),plugin.currentElements.fadeIn()},transition_slide=function(e,t){plugin.currentElements.animate({"margin-left":-1*plugin.settings.slideOffset,opacity:0},function(){$(this).remove()}),plugin.currentElements=plugin.settings.objElements.slice(e,t).clone(),plugin.currentElements.css({"margin-left":plugin.settings.slideOffset,display:"block",opacity:0,"min-width":plugin.el.width()/2}),plugin.el.html(plugin.currentElements),plugin.currentElements.animate({"margin-left":0,opacity:1})},transition_climb=function(e,t){plugin.currentElements.each(function(e){var t=$(this);setTimeout(function(){t.animate({"margin-left":-1*plugin.settings.slideOffset,opacity:0},function(){$(this).remove()})},200*e)}),plugin.currentElements=plugin.settings.objElements.slice(e,t).clone(),plugin.currentElements.css({"margin-left":plugin.settings.slideOffset,display:"block",opacity:0,"min-width":plugin.el.width()/2}),plugin.el.html(plugin.currentElements),plugin.currentElements.each(function(e){var t=$(this);setTimeout(function(){t.animate({"margin-left":0,opacity:1})},200*e)})};plugin.settings=$.extend({},defaults,options),plugin.currentElements=$([]),plugin.settings.objElements=plugin.el.find(plugin.settings.paginateElement),plugin.settings.pages=getNbOfPages(),plugin.settings.pages>1&&(plugin.el.html(),displayNav(),page=1,-1!=document.location.hash.indexOf("#"+plugin.settings.hashPage+":")&&(page=parseInt(document.location.hash.replace("#"+plugin.settings.hashPage+":","")),(page.length<=0||page<1||page>plugin.settings.pages)&&(page=1)),displayPage(page,"default"))})}}(jQuery);