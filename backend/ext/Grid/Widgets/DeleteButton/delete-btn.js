$(function () {

    $("#" + deleteMultiBtnOptions.deleteBtnJsId).click(function () {
        if (anyControlCheckboxSelected) {
            if (confirm("Are you sure about multiple items deleting?")) {
                var grid = $('#'+deleteMultiBtnOptions.gridJsId);

                $.get(
                    deleteMultiBtnOptions.deleteUrl,
                    {
                        ids : grid.yiiGridView('getSelectedRows')
                    },
                    function () {
                        grid.yiiGridView('applyFilter');
                    }

                ).fail(function(){
                    alert("Failed deleting");
                });
            }
            return false;
        } else {
            alert("Nothing selected!");
            return false;
        }
    });
});
