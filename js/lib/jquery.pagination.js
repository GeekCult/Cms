// This is a very simple demo that shows how a range of elements can
// be paginated.
// The elements that will be displayed are in a hidden DIV and are
// cloned for display. The elements are static, there are no Ajax
// calls involved.

/**
 * Callback function that displays the content.
 *
 * Gets called every time the user clicks on a pagination link.
 *
 * @param {int} page_index New Page index
 * @param {jQuery} jq the container with the pagination links as a jQuery object
 */
function pageselectCallback(page_index, jq){
    var new_content = null;
    if(local_page != "ecommerce"){
        new_content = jQuery('#images_support div.imageFotos:eq('+page_index+')').clone();
    //$('#Searchresult').empty().append(new_content);
    }else{
        new_content = jQuery('#ecommerce_support div.container_produtos_ecommerce:eq('+page_index+')').clone();    
    }
    return false;
}

/**
 * Initialisation function for pagination
 */
function initPagination(){
    
    // count entries inside the hidden content
    //var num_entries = jQuery('#images_support div.imageFotos').length;
    var records = $("#helper_records").val();
    
    local_page = $("#local_page").val();

    setPosition(records);

    if(records < 2){
        $("#Pagination").animate({height: "hide"});

    }else {
        $("#Pagination").animate({height: "show"});
    }
    
    // Create content inside pagination element
    $("#Pagination").pagination(records, {
        callback: pageselectCallback,
        items_per_page:1 // Show only one item per page
    });
 }

 function setPosition(records){

     if(records == 2){

        $("#Pagination").css("width", "150px");
        $("#Pagination").css("margin-left", "-60px");
     }

     if(records == 3){
        $("#Pagination").css("width", "170px");
        $("#Pagination").css("margin-left", "-85px");
     }

     if(records == 4){
        $("#Pagination").css("width", "200px");
        $("#Pagination").css("margin-left", "-100px");
     }

     if(records == 5){
        $("#Pagination").css("width", "230px");
        $("#Pagination").css("margin-left", "-115px");
     }

     if(records == 6){
        $("#Pagination").css("width", "260px");
        $("#Pagination").css("margin-left", "-130px");
     }

     if(records == 7){
        $("#Pagination").css("width", "290px");
        $("#Pagination").css("margin-left", "-145px");
     }

     if(records == 8){
        $("#Pagination").css("width", "320px");
        $("#Pagination").css("margin-left", "-160px");
     }

     if(records == 9){
        $("#Pagination").css("width", "350px");
        $("#Pagination").css("margin-left", "-175px");
     }

     if(records >= 10){
        $("#Pagination").css("width", "380px");
        $("#Pagination").css("margin-left", "-190px");
     }
 }


/**
 * This jQuery plugin displays pagination links inside the selected elements.
 * 
 * This plugin needs at least jQuery 1.4.2
 *
 * @author Gabriel Birke (birke *at* d-scribe *dot* de)
 * @version 2.1
 * @param {int} maxentries Number of entries to paginate
 * @param {Object} opts Several options (see README for documentation)
 * @return {Object} jQuery Object
 */
 (function($){
	/**
	 * @class Class for calculating pagination values
	 */
	$.PaginationCalculator = function(maxentries, opts) {
		this.maxentries = maxentries;
		this.opts = opts;
	}
	
	$.extend($.PaginationCalculator.prototype, {
		/**
		 * Calculate the maximum number of pages
		 * @method
		 * @returns {Number}
		 */
		numPages:function() {
			return Math.ceil(this.maxentries/this.opts.items_per_page);
		},
		/**
		 * Calculate start and end point of pagination links depending on 
		 * current_page and num_display_entries.
		 * @returns {Array}
		 */
		getInterval:function(current_page)  {
			var ne_half = Math.floor(this.opts.num_display_entries/2);
			var np = this.numPages();
			var upper_limit = np - this.opts.num_display_entries;
			var start = current_page > ne_half ? Math.max( Math.min(current_page - ne_half, upper_limit), 0 ) : 0;
			var end = current_page > ne_half?Math.min(current_page+ne_half + (this.opts.num_display_entries % 2), np):Math.min(this.opts.num_display_entries, np);
			return {start:start, end:end};
		}
	});
	
	// Initialize jQuery object container for pagination renderers
	$.PaginationRenderers = {}
	
	/**
	 * @class Default renderer for rendering pagination links
	 */
	$.PaginationRenderers.defaultRenderer = function(maxentries, opts) {
		this.maxentries = maxentries;
		this.opts = opts;
		this.pc = new $.PaginationCalculator(maxentries, opts);
	}
	$.extend($.PaginationRenderers.defaultRenderer.prototype, {
		/**
		 * Helper function for generating a single link (or a span tag if it's the current page)
		 * @param {Number} page_id The page id for the new item
		 * @param {Number} current_page 
		 * @param {Object} appendopts Options for the new item: text and classes
		 * @returns {jQuery} jQuery object containing the link
		 */
		createLink:function(page_id, current_page, appendopts){
                    
			var lnk, np = this.pc.numPages();
			page_id = page_id<0?0:(page_id<np?page_id:np-1); // Normalize page id to sane value
			appendopts = $.extend({text:page_id+1, classes:""}, appendopts||{});
			if(page_id == current_page){
				lnk = $("<span class='current'>" + appendopts.text + "</span>");
			}
			else
			{
				lnk = $("<a>" + appendopts.text + "</a>")
					.attr('href', this.opts.link_to.replace(/__id__/,page_id));
			}
			if(appendopts.classes){ lnk.addClass(appendopts.classes); }
			lnk.data('page_id', page_id);
			return lnk;
		},
		// Generate a range of numeric links 
		appendRange:function(container, current_page, start, end, opts) {
			var i;
			for(i=start; i<end; i++) {
				this.createLink(i, current_page, opts).appendTo(container);
			}
		},
		getLinks:function(current_page, eventHandler) {
			var begin, end,
				interval = this.pc.getInterval(current_page),
				np = this.pc.numPages(),
				fragment = $("<div class='pagination'></div>");
			
			// Generate "Previous"-Link
			if(this.opts.prev_text && (current_page > 0 || this.opts.prev_show_always)){
				fragment.append(this.createLink(current_page-1, current_page, {text:this.opts.prev_text, classes:"prev"}));
			}
			// Generate starting points
			if (interval.start > 0 && this.opts.num_edge_entries > 0)
			{
				end = Math.min(this.opts.num_edge_entries, interval.start);
				this.appendRange(fragment, current_page, 0, end, {classes:'sp'});
				if(this.opts.num_edge_entries < interval.start && this.opts.ellipse_text)
				{
					jQuery("<span>"+this.opts.ellipse_text+"</span>").appendTo(fragment);
				}
			}
			// Generate interval links
			this.appendRange(fragment, current_page, interval.start, interval.end);
			// Generate ending points
			if (interval.end < np && this.opts.num_edge_entries > 0)
			{
				if(np-this.opts.num_edge_entries > interval.end && this.opts.ellipse_text)
				{
					jQuery("<span>"+this.opts.ellipse_text+"</span>").appendTo(fragment);
				}
				begin = Math.max(np-this.opts.num_edge_entries, interval.end);
				this.appendRange(fragment, current_page, begin, np, {classes:'ep'});
				
			}
			// Generate "Next"-Link
			if(this.opts.next_text && (current_page < np-1 || this.opts.next_show_always)){
				fragment.append(this.createLink(current_page+1, current_page, {text:this.opts.next_text, classes:"next"}));
			}
			$('a', fragment).click(eventHandler);
			return fragment;
		}
	});
	
	// Extend jQuery
	$.fn.pagination = function(maxentries, opts){
		
		// Initialize options with default values
		opts = jQuery.extend({
			items_per_page:10,
			num_display_entries:10,
			current_page:0,
			num_edge_entries:0,
			link_to:"#",
			prev_text:"Prev",
			next_text:"Next",
			ellipse_text:"...",
			prev_show_always:true,
			next_show_always:true,
			renderer:"defaultRenderer",
			callback:function(){return false;}
		},opts||{});
		
		var containers = this,
			renderer, links, current_page;
		
		/**
		 * This is the event handling function for the pagination links. 
		 * @param {int} page_id The new page number
		 */
		function paginationClickHandler(evt){
			var links, 
				new_current_page = $(evt.target).data('page_id'),
				continuePropagation = selectPage(new_current_page);
			if (!continuePropagation) {
				evt.stopPropagation();
			}
			return continuePropagation;
		}
		
		/**
		 * This is a utility function for the internal event handlers. 
		 * It sets the new current page on the pagination container objects, 
		 * generates a new HTMl fragment for the pagination links and calls
		 * the callback function.
		 */
		function selectPage(new_current_page) {
                    // update the link display of a all containers
                    containers.data('current_page', new_current_page);
                    links = renderer.getLinks(new_current_page, paginationClickHandler);
                    containers.empty();
                    links.appendTo(containers);
                    // call the callback and propagate the event if it does not return false
                    var continuePropagation = opts.callback(new_current_page, containers);
                    var idpage = $("#helper").val();
             
                    if(local_page != "ecommerce" && local_page != "users"){
                        $("#Searchresult").empty().load("/admin/"+ local_page + "/paginar/" + new_current_page + "0/" + idpage);
                    
                    }else if(local_page == "users"){
                        var tipo_user  = $('#local_page_type').val();
                        (tipo_user == 0) ?  tipo_user = 'paginar_pf' : tipo_user = 'paginar_pj';
                        window.location = '/admin/users/' + tipo_user +'/' + new_current_page;
                        
                    }else{
                        var categoria = $("#categoria_page").val();
                        var subcategoria = $("#subcategoria_page").val();
                        var subitem = $("#subitem_page").val();
                        if(categoria != "" && subcategoria == "" && subitem == "")window.location = "/loja/"+categoria+ "/" + new_current_page + "0";
                        if(categoria != "" && subcategoria != "" && subitem == "")window.location = "/loja/"+categoria +"/"+ subcategoria+ "/" + new_current_page + "0/" + idpage;;
                        if(subcategoria != "" && subcategoria != "" && subitem != "")window.location = "/loja/"+categoria+"/"+ subcategoria+"/"+ subitem+ "/" + new_current_page + "0/" + idpage;;
                    }
                    return continuePropagation;
		}
		
		// -----------------------------------
		// Initialize containers
		// -----------------------------------
		current_page = opts.current_page;
		containers.data('current_page', current_page);
		// Create a sane value for maxentries and items_per_page
		maxentries = (!maxentries || maxentries < 0)?1:maxentries;
		opts.items_per_page = (!opts.items_per_page || opts.items_per_page < 0)?1:opts.items_per_page;
		
		if(!$.PaginationRenderers[opts.renderer])
		{
			throw new ReferenceError("Pagination renderer '" + opts.renderer + "' was not found in jQuery.PaginationRenderers object.");
		}
		renderer = new $.PaginationRenderers[opts.renderer](maxentries, opts);
		
		// Attach control events to the DOM elements
		var pc = new $.PaginationCalculator(maxentries, opts);
		var np = pc.numPages();
		containers.bind('setPage', {numPages:np}, function(evt, page_id) { 
				if(page_id >= 0 && page_id < evt.data.numPages) {
					selectPage(page_id); return false;
				}
		});
		containers.bind('prevPage', function(evt){
				var current_page = $(this).data('current_page');
				if (current_page > 0) {
					selectPage(current_page - 1);
				}
				return false;
		});
		containers.bind('nextPage', {numPages:np}, function(evt){
				var current_page = $(this).data('current_page');
				if(current_page < evt.data.numPages - 1) {
					selectPage(current_page + 1);
				}
				return false;
		});
		
		// When all initialisation is done, draw the links
		links = renderer.getLinks(current_page, paginationClickHandler);
		containers.empty();
		links.appendTo(containers);
		// call callback function
		opts.callback(current_page, containers);
	} // End of $.fn.pagination block
	
})(jQuery);

initPagination();
