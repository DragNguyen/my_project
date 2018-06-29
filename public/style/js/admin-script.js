function infoMessage(heading, msg) {
    $.toast({
        heading: heading,
        text: msg,
        loader: false,
        icon: 'info',
        position: 'bottom-right'
    });
}

function successMessage(heading, msg) {
    $.toast({
        heading: heading,
        text: msg,
        loader: false,
        icon: 'success',
        position: 'bottom-right'
    });
}

function errorMessage(heading, msg) {
    $.toast({
        heading: heading,
        text: msg,
        loader: false,
        icon: 'error',
        position: 'bottom-right'
    });
}

function warningMessage(heading, msg) {
    $.toast({
        heading: heading,
        text: msg,
        loader: false,
        icon: 'warning',
        position: 'bottom-right'
    });
}

function confirmDelete() {
    if ($('.ui.child.checkbox input:checked').length < 1)
        return false;

    return confirm('Bạn chắc chắn xóa các mục vừa chọn?');
}

function bindSelectAll(id) {
    let selector = $('#' + id);
    $(selector).checkbox({
        onChange() {
            let checked = $(selector).find('input').prop('checked');
            $('.ui.child.checkbox').checkbox(checked ? 'check': 'uncheck');
        }
    });
}

function bindDataTable(tableId, onlyPaging = false) {
    $('#' + tableId).DataTable({
        searching: !onlyPaging,
        ordering: !onlyPaging,
        lengthChange: !onlyPaging,
        info: false,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
            "zeroRecords": "Không có dữ liệu",
            "info": "<strong>Trang _PAGE_ / _PAGES_</strong>",
            "infoEmpty": "<strong>Không có dữ liệu</strong>",
            "infoFiltered": "(lọc từ _MAX_ dòng)",
            "search": "",
            "paginate": {
                "next":       "<strong>&raquo;</strong>",
                "previous":   "<strong>&laquo;</strong>"
            },
        }
    });
    let search = $('.dataTables_filter.ui.input');
    $(search).find('input').attr('placeholder', 'Tìm kiếm').detach().appendTo($(search));
}

function finding(url, inputId, fieldName, page = null) {
    let keyword = $("#" + inputId).val();
    let query = keyword.trim() === '' ? '' : `?${fieldName}=${keyword}`;

    query += pageQuery(query, page);

    window.location.href = url + query;
}

function pageQuery(query, page) {
    let operator = query === '' ? '?' : '&';
    return page == null ? '' : operator + page;
}

function toAscii(str) {
    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/g, 'A');
    str = str.replace(/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/g, 'E');
    str = str.replace(/(Ì|Í|Ị|Ỉ|Ĩ)/g, 'I');
    str = str.replace(/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/g, 'O');
    str = str.replace(/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/g, 'U');
    str = str.replace(/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/g, 'Y');
    str = str.replace(/(Đ)/g, 'D');

    str = str.trim();

    return str;
}

function roundCurrency(amount) {
    amount = amount.toFixed(2).replace(/\.\d+/, '');
    let million = false;
    if (amount.length > 7){
        million = true;
        amount = parseFloat(amount)/1000000;
    }

    return toCurrency(amount) + (million ? " tr": '');
}