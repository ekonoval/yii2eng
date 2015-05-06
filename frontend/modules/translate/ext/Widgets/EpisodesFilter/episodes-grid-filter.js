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
        },

        setHardFilterValue: function (ctrlChbIsChecked, selector) {
            //if ($(ctrlChbObj).prop('checked')) {
            if (ctrlChbIsChecked) {
                $(selector).val(1);
            } else {
                $(selector).val('');
            }
            o.updateGrid();
        }
    };

    /**
     * After grid update set filter for episodeIds as hidden again
     */
    $(document).on('pjax:success', function(){
        //$(episodeIdsInputFilter).attr('type', 'hidden');
    });
    //$(episodeIdsInputFilter).attr('type', 'hidden'); //on init


    $("#episodesContainer input[type=checkbox]").click(function(){

        o.setEpisodIdsFilterValue(o.getSelection());
        o.updateGrid();
    });

    $("#wordsControls a.selectAll").click(function(){
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
    });

    $("#hardOnlyChb").click(function(){
        o.setHardFilterValue($(this).prop('checked'), '#hardOnlyFilter');
    });

    $("#superHardChb").click(function(){

        var thisChecked = $(this).prop('checked');

        /**
         * The word could be superHard but not isHard (rare case).
         * So deselect isHard checkbox on that case
         */
        if (thisChecked && $("#hardOnlyChb").prop('checked')) {
            $("#hardOnlyChb").prop('checked', false);
            o.setHardFilterValue(false, '#hardOnlyFilter');
        }

        o.setHardFilterValue(thisChecked, '#superHardFilter');
    });

    return o;
};
