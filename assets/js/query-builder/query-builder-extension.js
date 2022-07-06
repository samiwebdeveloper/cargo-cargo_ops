$.fn.queryBuilder.extend({
	
   /**
 * Returns rule's filter HTML
 * @param {Rule} rule
 * @param {object[]} filters
 * @returns {string}
 * @fires QueryBuilder.changer:getRuleFilterTemplate
 * @private
 */
	getRuleFilterSelect : function(rule, filters) {
		
		var nfilters;
		if (ruleRowCounter < 3)
		{
			nfilters = [filters[ruleRowCounter]];
		}
		else
		{
			nfilters = filters.slice(3,5);
			
		}
		
		ruleRowCounter++;
		
		var h = this.templates.filterSelect({
			builder: this,
			rule: rule,
			filters: nfilters,
			icons: this.icons,
			settings: this.settings,
			translate: this.translate.bind(this)
		});

		/**
		 * Modifies the raw HTML of the rule's filter dropdown
		 * @event changer:getRuleFilterSelect
		 * @memberof QueryBuilder
		 * @param {string} html
		 * @param {Rule} rule
		 * @param {QueryBuilder.Filter[]} filters
		 * @returns {string}
		 */
	return this.change('getRuleFilterSelect', h, rule, nfilters);
	}
});