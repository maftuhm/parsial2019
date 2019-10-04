$(function () {
	$('#dataTable').DataTable({
		"scrollX"		: true,
		'paging'		: true,
		'lengthChange'	: true,
		'searching'		: true,
		'ordering'		: true,
		'info'			: true,
		'autoWidth'		: false
	})
});
$(document).ajaxStart(function () {
	Pace.restart()
})