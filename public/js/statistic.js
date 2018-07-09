

    function monthChanged() {
        let select_year = document.getElementById('year');
        let select_month = document.getElementById('month');
        let select_begin = document.getElementById('begin');
        let year = parseInt(select_year.options[select_year.selectedIndex].value);
        let month = select_month.options[select_month.selectedIndex].value;
        select_begin.options.length = 0;
        if (month==='1' || month==='3' || month==='5' || month==='7' || month==='8' || month==='10' || month==='12') {
            for(let i=1; i<=31; i++) {
                select_begin.options[select_begin.options.length] = new Option(i.toString(), i.toString());
            }
        }
        else if(month==='4' || month==='6' || month==='9' || month==='11') {
            for(let i=1; i<=30; i++) {
                select_begin.options[select_begin.options.length] = new Option(i.toString(), i.toString());
            }
        }
        else if(month==='2' && ((year%4===0 && year%100!==0) || year%400===0)) {
            for(let i=1; i<=29; i++) {
                select_begin.options[select_begin.options.length] = new Option(i.toString(), i.toString());
            }
        }
        else {
            for(let i=1; i<=28; i++) {
                select_begin.options[select_begin.options.length] = new Option(i.toString(), i.toString());
            }
        }
        beginChanged();
    }

    $('#type').on('change', function () {
        let select = document.getElementById('type');
        let value = select.options[select.selectedIndex].value;
        if (value === 'year') {
            $(this).closest('form').submit();
        }
        else {
            if (value === 'date') {
                $('#begin-end-div').removeClass('hidden');
            }
            else {
                $('#begin-end-div').addClass('hidden');
            }
            $('#year-div').removeClass('hidden');
            $('#button').removeClass('hidden');
        }
    });

    function yearChanged() {
        let select = document.getElementById('month');
        select.options.length = 0;
        for(let i=1; i<=12; i++) {
            select.options[select.options.length] = new Option(i.toString(), i.toString());
        }
        monthChanged();
        beginChanged();
    }

    function beginChanged() {
        let select_end = document.getElementById('end');
        let select_begin = document.getElementById('begin');
        select_end.options.length = 0;
        let value = select_begin.options[select_begin.selectedIndex].value;
        for(let i=parseInt(value); i<=select_begin.options.length; i++) {
            select_end.options[select_end.options.length] = new Option(i.toString(), i.toString());
        }
    }