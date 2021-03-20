/* --- menu --- */
var MENU_POS1 = new Array();
	// item sizes for different levels of menu
	MENU_POS1['height'] = [20, 20, 20];
	MENU_POS1['width'] = [180, 180, 180];
	// menu block offset from the origin:
	//	for root level origin is upper left corner of the page
	//	for other levels origin is upper left corner of parent item
	MENU_POS1['block_top'] = [15, 20, 15];
	MENU_POS1['block_left'] = [410, 0,171];
	// offsets between items of the same level
	MENU_POS1['top'] = [0, 21, 35];
	MENU_POS1['left'] = [180, 0, 0];
	// time in milliseconds before menu is hidden after cursor has gone out
	// of any items
	MENU_POS1['hide_delay'] = [180,180, 180];
	
var MENU_STYLES1 = new Array();
	// default item state when it is visible but doesn't have mouse over
	MENU_STYLES1['onmouseout'] = [
		'color', ['#CF9F59', '#CF9F59', '#CF9F59'], 
		'background', ['#7D0020', '#7D0020', '#7D0020'],
		'fontWeight', ['bold', 'bold', 'bold'],
		'textDecoration', ['none', 'none', 'none'],
	];
	// state when item has mouse over it
	MENU_STYLES1['onmouseover'] = [
		'color', ['#CF9F59', '#CF9F59', '#CF9F59'], 
		'background', ['#6A031E', '#6A031E', '#6A031E'],
		'fontWeight', ['bold', 'bold', 'bold'],
		'textDecoration', ['none', 'none', 'none'],
	];
	// state when mouse button has been pressed on the item
	MENU_STYLES1['onmousedown'] = [
		'color', ['#CF9F59', '#CF9F59', '#CF9F59'], 
		'background', ['#6A031E', '#6A031E', '#6A031E'],
		'fontWeight', ['bold', 'bold', 'bold'],
		'textDecoration', ['none', 'none', 'none'],
	];
	
