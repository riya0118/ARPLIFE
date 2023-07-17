$(function() {

	$('select[multiple].active.3col').multiselect({
	  columns: 3,
	  placeholder: 'Select Sizes',
	  search: true,
	  searchOptions: {
	      'default': 'Search Sizes'
	  },
	  selectAll: true
	});

});