(function ($) {
    $(document).ready(function () {
        console.log('dragable scripts loaded');

        // Event handling
        $("#sortable1, #sortable2").sortable({
            cursor: 'move',
            connectWith: ".connectedSortable",
            update: function () {
                let panel = $(this).attr('id');
                let order = $(this).sortable('toArray').toString();
                // Assigning datas to the object
                var data = {
                    action: 'dpi_datas',
                    panel: panel,
                    order: order,
                }
                console.log(data);
                $.ajax({
                    dataType: 'json',
                    type: 'post',
                    url: dpi_datas.ajax_url,
                    data: data,
                    beforeSend: function (response) {
                        console.log('before send');
                    },
                    complete: function (response) {
                        console.log('completed');
                    },
                    success: function (response) {
                        console.log(response);
                    },
                });
            }
        }).disableSelection();
    })
})(jQuery);