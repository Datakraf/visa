$('.selectize').selectize({
    plugins: ['remove_button'],
    sortField: {
        field: 'text',
        direction: 'asc'
    },
    dropdownParent: 'body',
    create: false,
    placeholder: 'Please Select',


});

$('.supervisor').select2({
    placeholder: 'Please Select',
    theme: 'bootstrap4',
    ajax: {
        url: "",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id,

                    }
                })
            };
        },
        cache: true,
        allowClear: true
    }
});

$('.college_fellow').select2({
    placeholder: 'Please Select',
    theme: 'bootstrap4',
    ajax: {
        url: '/applications/college_fellow/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.email,
                        id: item.email,

                    }
                })
            };
        },
        cache: true,
        allowClear: true
    }
});

$('.students').select2({
    placeholder: 'Please Select',
    theme: 'bootstrap4',
    ajax: {
        url: "",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.MBUT_NAMA,
                        id: item.id,

                    }
                })
            };
        },
        cache: true,
        allowClear: true
    }
});

function changeplh() {
    var sel = document.getElementById("financial-aid-selector");
    var textbx = document.getElementById("financial-aid-placeholder");
    var indexe = sel.selectedIndex;

    if (indexe == 1) {
        $("#financial-aid-placeholder").attr("placeholder", "Account Number");

    }
    if (indexe == 2) {
        $("#financial-aid-placeholder").attr("placeholder", "Account Number");
    }
    if (indexe == 3) {
        $("#financial-aid-placeholder").attr("placeholder", "Account Number");
    }
    if (indexe == 4) {
        $("#financial-aid-placeholder").attr("placeholder", "Name of Sponsor");
    }
    if (indexe == 5) {
        $("#financial-aid-placeholder").attr("placeholder", "Please specify");
    }
}
