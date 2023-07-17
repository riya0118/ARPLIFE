$(function() {

	$('select[multiple].active.4col').multiselect({
	  columns: 3,
	  placeholder: 'Select colors',
	  search: true,
	  searchOptions: {
	      'default': 'Search Colors'
	  },
	  selectAll: true
	});

});