<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class = "main_content dashboard_part large_header_bg d-flex justify-content-center flex-column">
    <table id="jqGrid"></table>
    <div id="jqGridPager"></div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#jqGrid").jqGrid({
            url: '<?= site_url('pages/getList') ?>',
            mtype: "GET",
            datatype: "json",
            page: 1,
            sortorder: 'asc',
            colModel: [
                {
                    label : "#ID",
                    name: 'id', 
                    key: true, 
                    width: 75,
                    hidden : true,
                    editable: false,
                    search:false,
                    viewable: false,
                    sortable:false,
                },
                {
                    label : "Фамилия",
                    name: 'surname', 
                    editable: false,
                    search:false,
                    editrules: {
                        required: true
                    },
                    sortable:false,
                },
                {
                    label : "Имя",
                    name: 'name', 
                    editable: false,
                    search:false,
                    editrules: {
                        required: true
                    },
                    sortable:false,
                },
                {
                    label : "Отчество",
                    name: 'patronymic', 
                    editable: false,
                    search:false,
                    editrules: {
                        required: true
                    },
                    sortable:false,
                },
                {
                    label : "Пол",
                    name: 'gender', 
                    editable: false,
                    search:false,
                    editrules: {
                        required: true
                    },
                    sortable:false,
                },
                {
                    label : "Дата рождения",
                    name: 'date_birth', 
                    editable: false,
                    search:false,
                    editrules: {
                        required: true
                    },
                    sortable:false,
                },
                {
                    label : "Дата смерти",
                    name: 'date_death', 
                    editable: false,
                    search: false,
                    editrules: {
                        required: false
                    },
                    sortable:false,
                },
            ],
            pager: "#jqGridPager",
            rowNum: 10,
            responsive: true,
            viewrecords: true,
            autowidth : true,
            height:'auto',
            caption: "Список пациентов",
            jsonReader: {
                repeatitems: false,
                id: "product_name"
            }
        });

        $('#jqGrid').jqGrid('filterToolbar');
        $('#jqGrid').jqGrid('navGrid',"#jqGridPager",
            {                
                search: false,
                add: false,
                edit: false,
                del: false,
                view: false,
                refresh: false
            },
        );
    });
</script>