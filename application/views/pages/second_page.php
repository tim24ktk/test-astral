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
            url: '<?= site_url('SecondPage/getList') ?>',
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
                    editable: true,
                    search:false,
                    viewable: false
                },
                {
                    label : "#UID",
                    name: 'user_id', 
                    editable: true,
                    search:false,
                    formatter:function(cellvalue, options, rowObject){
                        return '<div class="white-space-normal viewliketaga" onclick="redirect()">'+rowObject.user_id+'</div>';
                    },
                },
                {
                    label : "Пациент",
                    name: 'patient', 
                    editable: true,
                    search:false,
                },
                {
                    label : "Диагноз",
                    name: 'user_diagnose', 
                    editable: true,
                    search:false,
                },
                {
                    label : "Дата открытия",
                    name: 'date_opening', 
                    editable: true,
                    search:false,
                },
                {
                    label : "Дата закрытия",
                    name: 'date_closing', 
                    editable: true,
                    search:false,
                },
            ],
            responsive: true,
            viewrecords: true,
            autowidth : true,
            height:'auto',
            rowNum: 10,
            pager: "#jqGridPager",
            caption: "Список случаев",
            jsonReader: {
                repeatitems: false,
                id: "product_name"
            }
        });

        $('#jqGrid').jqGrid('filterToolbar');
        $('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
                search: false,
                add: false,
                edit: false,
                del: true,
                view: false,
                refresh: false
            },
            {},
            {},
            {
                deleteCaption: "Delete patient diagnose", 
                deletetext: "Delete patient diagnose", 
                closeOnEscape: true, 
                closeAfterEdit: true, 
                savekey: [true, 13], 
                errorTextFormat: commonError, 
                width: "500", 
                reloadAfterSubmit: true, 
                bottominfo: "Fields marked with (*) are required", 
                top: "100", 
                left: "300", 
                right: "300",
                recreateForm:true,
                url: '<?= site_url('/SecondPage/delete') ?>',
                /*afterSubmit : function( data, postdata, oper) {
                    var response = data.responseJSON;
                    if (response.hasOwnProperty("error")) {
                        if(response.error.length) {
                            return [false,response.error ];
                        }
                    }
                    return [true,"",""];
                }*/
            },
            {},
        )
    });

    function commonError(data) {
        return "Error Occured during Operation. Please try again";
    }

    function redirect() {
        document.location.href = "<?= site_url('/ThirdPage')?>";
    };
</script>