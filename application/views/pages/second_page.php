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
                    width: 25,
                    hidden : true,
                    editable: true,
                    search:false,
                    viewable: false,
                    sortable:false,
                },
                {
                    label : "#UID",
                    name: 'user_id', 
                    editable: false,
                    width: 25,
                    search: false,
                    sortable:false,
                    formatter:function(cellvalue, options, rowObject){
                        return '<div class="white-space-normal viewliketaga" onclick="redirect(' + rowObject.id + ')">'+rowObject.user_id+'</div>';
                    },
                },
                {
                    label : "Пациент",
                    name: 'patient', 
                    editable: true,
                    search: true,
                    sortable:false,
                    width: 75,
                    searchoptions:{
                        dataInit : function (elem) {
                            var elem2 = $('<input type="text" role="textbox" searchopermenu="true" id="gs_patient_search" clearsearch="true" size="20" class="form-control">');
                            $(elem).hide();
                            $(elem).after(elem2);
                            $(elem2).autocomplete({
                                source: function( request, response ) {
                                    $.ajax( {
                                      url: "<?=site_url('/SecondPage/autocompleteUsers')?>",
                                      dataType: "json",
                                      data: {
                                        user_surname: request.term
                                      },
                                      success: function( data ) {
                                        response( data );
                                      }
                                    });
                                },
                                select: function( event, ui ) {
                                    $(elem).val(ui.item.id);
                                    $('#ui-id-1 .ui-menu-item div').text(ui.item.value);
                                    setTimeout(function(){$(elem2).val(ui.item.value);}, 50);
                                    var e = $.Event('keypress');
                                    e.keyCode = 13;
                                    $(elem).trigger(e);
                                },
                                minLength: 1
                            });
                        }
                    },
                },
                {
                    label : "Диагноз",
                    name: 'user_diagnose', 
                    editable: true,
                    search: false,
                    sortable:false,
                    edittype: 'text',
                    editrules: {
                        required:true,
                        edithidden:true
                    },
                    width: 150,
                    formoptions:{
                        label: 'Диагноз *',
                    },
                    editoptions: {
                        dataInit : function (elem) {
                            var elem2 = $('<input type="text" clearsearch="true" role="textbox" class="FormElement ui-widget-content ui-corner-all" placeholder="Введите диагноз">');
                            $(elem).hide();
                            $(elem).after(elem2);
                            var titletext = $('#jqGrid tr[aria-selected="true"] td[aria-describedby="jqGrid_user_diagnose"]').text().split(':');

                            $(elem).after('<div>'+titletext[1]+'</div>');

                            $(elem2).autocomplete({
                                source: function(request, response) {
                                    $.ajax( {
                                        url: "<?= site_url('/SecondPage/autocomplete') ?>",
                                        dataType: "json",
                                        data: {
                                            user_diagnose: request.term
                                        },
                                        success: function(data) {
                                            response(data);
                                        }
                                    });
                                },
                                select: function(event, ui) {
                                    $(elem).val(ui.item.id);
                                    $('#ui-id-1 .ui-widget-content div').text(ui.item.value);
                                    $('#TblGrid_jqGrid tr[rowpos="3"] td.DataTD div').text(ui.item.value);
                                    setTimeout(function(){$(elem2).val('')},50);
                                },
                                minLength: 1
                            });
                        },
                    },
                    formatter: function(cellvalue, options, rowObject){
                        return '<div class="white-space-normal viewliketaga"><span class="user_diagnose_id">#' + rowObject.user_diagnose +  ': </span>' + rowObject.code + ' ' + rowObject.description + '</div>';
                    },
                    unformat: function(cellvalue, options, cell){
                        var temp = cellvalue.split(':');
                        temp = temp[0].replace('#', '');
                        return temp;
                    },
                },
                {
                    label : "Дата открытия",
                    name: 'date_opening', 
                    editable: false,
                    search: false,
                    sortable:false,
                    width: 50,
                },
                {
                    label : "Дата закрытия",
                    name: 'date_closing', 
                    editable: true,
                    search: false,
                    editrules:{
                        required:true
                    },
                    formoptions:{
                        label: 'Дата закрытия *',
                    },
                    sortable:false,
                    width: 50,
                    editoptions: {
                        dataInit : function (elem) {

                            $.datepicker.regional['ru'] = {

                                monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
                                dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                                dateFormat: 'yy-mm-dd',
                                firstDay: 1,
                                isRTL: false,
                                showMonthAfterYear: false,
                                yearSuffix: ''

                            };

                            $.datepicker.setDefaults($.datepicker.regional['ru']);

                            $(function(){
                                $("#date_closing").datepicker();
                            });
                        }
                    }
                },
                {
                    label: "Просмотр",
                    name: "watch",
                    width: 75,
                    search: false,
                    formatter:function(cellvalue, options, rowObject){
                        return '<button id="watch" class="btn btn-primary" type="button" onclick="redirect(' + rowObject.id + ')">Просмотр</button>';
                    },
                }
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
                edit: true,
                add: false,
                del: true,
                view: false,
                refresh: false,
                search: false,
            },
            {
                editCaption: "Закрыть диагноз пациента", 
                edittext: "Закрыть диагноз пациента", 
                closeOnEscape: true, 
                closeAfterEdit: true, 
                savekey: [true, 13], 
                errorTextFormat: commonError, 
                width: "500", 
                reloadAfterSubmit: true, 
                bottominfo: "Поля отмеченные * обязательны к заполнению!", 
                top: "100", 
                left: "300", 
                right: "300",
                recreateForm:true,
                beforeShowForm: function ($form) {
                    $form.find("#patient").prop("readonly", true);
                },
                url:'<?=site_url('/SecondPage/updateUserDiagnose')?>',
                afterSubmit : function( data, postdata, oper) {
                    var response = data.responseJSON;
                    if (response.hasOwnProperty("error")) {
                        if(response.error.length) {
                            return [false,response.error ];
                        }
                    }
                    return [true,"",""];
                },
            },
            {},
            {
                deleteCaption: "Удалить диагноз пациента", 
                deletetext: "Удалить диагноз пациента", 
                closeOnEscape: true, 
                closeAfterEdit: true, 
                savekey: [true, 13], 
                errorTextFormat: commonError, 
                width: "500", 
                reloadAfterSubmit: true, 
                top: "100", 
                left: "300", 
                right: "300",
                recreateForm:true,
                url: '<?= site_url('/SecondPage/delete') ?>',
                afterSubmit : function( data, postdata, oper) {
                    var response = data.responseJSON;
                    if (response.hasOwnProperty("error")) {
                        if(response.error.length) {
                            return [false,response.error ];
                        }
                    }
                    return [true,"",""];
                }
            },
        )
    });

    function commonError(data) {
        return "Error Occured during Operation. Please try again";
    }

    function redirect(id) {
        document.location.href = 'ThirdPage?id=' + id;
    };

</script>