/*VALIDACION DE DATETIMEPICKER*/
$(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-64y',
            endDate: '-18y'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('dateRangeForm').formValidation('revalidateField', 'date');
        });

    /*$('#dateRangeForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            date: {
                validators: {
                    notEmpty: {
                        message: 'La fecha es requerida'
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                        min: '-64y',
                        max: '-18y',
                        message: 'Fecha no válida'
                    }
                }
            }
        }
    });*/
});
