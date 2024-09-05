<script type="text/javascript">
    let table = $('#systemDatatable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "{{ route('service.service.dataProcessingService') }}",
        "dataType": "json",
        "type": "GET",
        "data": {
            "_token": "<?= csrf_token() ?>"
        }
    },
    "columns": [{
            "data": "id",
            "orderable": true
        },
        {
            "data": "title",
            "orderable": true
        },
    
        {
            "data": "details",
            "orderable": true
        },
        {
            "data": "image",
            "orderable": false
        },
        {
            "data": "order",
            "orderable": true
        },
        {
            "data": "show_in_nav",
            "orderable": false
        },
  
        {
            "data": "status",
            "orderable": false,
            "class": 'text-nowrap',
        },
        {
            "data": "action",
            "class": 'text-nowrap',
            "searchable": false,
            "orderable": false
        },
    ],

    "fnDrawCallback": function() {
        $("[name='my-checkbox']").bootstrapSwitch({
            size: "small",
            onColor: "success",
            offColor: "danger"
        });
    },

});


var buttons = new $.fn.dataTable.Buttons(table, {
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5',
        'print',
    ]
}).container().appendTo($('#buttons'));
</script>