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
        var grid = $(gridId);

        o.setEpisodIdsFilterValue(o.getSelection());
        grid.yiiGridView('applyFilter');
        //console.log('click');
    });

    return o;
};
