
(function() {
  var $;

  $ = jQuery;

  $.fn.saimtech = function(options) {
    var compact;
    compact = function(array) {
      var item, _i, _len, _results;
      _results = [];
      for (_i = 0, _len = array.length; _i < _len; _i++) {
        item = array[_i];
        if (item) {
          _results.push(item);
        }
      }
      return _results;
    };
    return this.each(function() {
      var container, searchBar, settings;
      container = $(this);
      settings = $.extend({
        searchInput: null,
        searchTemplate: "<div class='row'><div class='col-md-12'><div class='form-group form-group-default'><label>Find From Table</label><input type='text' data-toggle='tooltip' data-placement='bottom' title='Find' class='form-control'></div></div></div>",
        itemSelector: "tbody tr",
        textSelector: null,
        toggle: function(item, match) {
          return item.toggle(match);
        },
        complete: function() {}
      }, options);
      if (!settings.searchInput) {
        searchBar = $(settings.searchTemplate);
        settings.searchInput = searchBar.find("input");
        container.before(searchBar);
      }
      return settings.searchInput.on("keyup.sieve change.sieve", function() {
        var items, query;
        query = compact($(this).val().toLowerCase().split(/\s+/));
        items = container.find(settings.itemSelector);
        items.each(function() {
          var cells, item, match, q, text, _i, _len;
          item = $(this);
          if (settings.textSelector) {
            cells = item.find(settings.textSelector);
            text = cells.text().toLowerCase();
          } else {
            text = item.text().toLowerCase();
          }
          match = true;
          for (_i = 0, _len = query.length; _i < _len; _i++) {
            q = query[_i];
            match && (match = text.indexOf(q) >= 0);
          }
          return settings.toggle(item, match);
        });
        return settings.complete();
      });
    });
  };

}).call(this);


