let currentTable = null;
let currentPageUrl = BASE_URL + "publications/departmentalOrders";

function initPubTable(startPage = 0) {
    const $table = $('#content-area').find('.pub-table');

    if (!$table.length) return;

    if ($.fn.DataTable.isDataTable($table)) {
        $table.DataTable().destroy();
    }

    currentTable = $table.DataTable({
        pageLength: 10,
        ordering: false,
        searching: true,
        lengthChange: true,
        info: true,
        displayStart: startPage * 10
    });
}



function getCurrentPage() {
    return currentTable ? currentTable.page() : 0;
}



function reloadTable() {
    let page = getCurrentPage();
    $('#content-area').load(currentPageUrl, function() {
        initPubTable(page);
    });
}

// Page load
$(document).on('click', '.load-page', function(e){
    e.preventDefault();
    currentPageUrl = $(this).data('url');
    reloadTable();
});

// Fix modal stacking
$(document).on('show.bs.modal', '.modal', function () {
    $(this).appendTo('body');
});
