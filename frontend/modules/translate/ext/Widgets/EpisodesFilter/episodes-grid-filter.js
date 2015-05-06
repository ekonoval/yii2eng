var EpisodeGridFilter = function (gridId) {
    var checkboxSelector = "#episodesContainer input[type=checkbox]";
    var episodeIdsInputFilter = '#episodeIdsJs';
    var o = {
        getSelection: function () {
            var checked = [];

            $.each($(checkboxSelector+":checked"), function (i, v){
                checked.push($(v).val());
            });
            return checked;
        },

        setEpisodIdsFilterValue: function (episodIds) {
            $(episodeIdsInputFilter).val(episodIds.join());
        },

        updateGrid: function () {
            var grid = $(gridId);
            grid.yiiGridView('applyFilter');
            return grid;
        }
    };

    /**
     * After grid update set filter for episodeIds as hidden again
     */
    $(document).on('pjax:success', function(){
        $(episodeIdsInputFilter).attr('type', 'hidden');
    });
    $(episodeIdsInputFilter).attr('type', 'hidden'); //on init


    $("#episodesContainer input[type=checkbox]").click(function(){

        o.setEpisodIdsFilterValue(o.getSelection());
        o.updateGrid();
        //console.log('click');
    });

    $("#episodesContainer a.selectAll").click(function(){
        //$("#episodesContainer .chb-season input[type=checkbox]").attr('checked', 'checked');
        var checkBoxesAll = $("#episodesContainer .chb-season input[type=checkbox]");
        var checkBoxesSelectedSize = checkBoxesAll.filter(':checked').size();

        console.log(checkBoxesSelectedSize , checkBoxesAll.size());

        if (checkBoxesSelectedSize > 0 && checkBoxesSelectedSize == checkBoxesAll.size()) {
            checkBoxesAll.prop('checked', false);
        } else {
            console.log('selecting all', checkBoxesAll);
            checkBoxesAll.prop('checked', true);
        }

        o.setEpisodIdsFilterValue(o.getSelection());
        o.updateGrid();

        //if (checkBoxesSelectedSize != checkBoxesAll.size()) {
        //    checkBoxesAll.attr('checked', 'checked');
        //} else {
        //    console.log('ww');
        //    checkBoxesAll.attr('checked', false);
        //}

    });

    return o;
};
