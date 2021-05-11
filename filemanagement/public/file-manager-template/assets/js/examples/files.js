$(function () {
    if (typeof(jsonDataView) !== 'undefined') {
        var jsonData = jsonDataView;
        $('#files').jstree({
            'core': jsonData,
            "types": {
                "folder": {
                    "icon": "ti-folder text-warning",
                },
                "file": {
                    "icon": "ti-file",
                }
            },
            plugins: ["types"]
        });


        $('#files').on('click', function (e) {
            // console.log(e.target.id);
            // console.log(e.target.href);

            if (typeof e.target.href != "undefined") {
                window.location = e.target.href;
            }
        })
    }
});



$(function () {
    if (typeof(jsonDataViewParentId) !== 'undefined') {
        var jsonData = jsonDataViewParentId;
        $('#files_parent_id').jstree({
            'core': jsonData,
            "types": {
                "folder": {
                    "icon": "ti-folder text-warning",
                },
                "file": {
                    "icon": "ti-file",
                }
            },
            plugins: ["types"]
        });


        $('#files_parent_id').on('click', function (e) {
            var parent_id = e.target.id.replace('_anchor','');
            document.getElementById("parent_id").value = parent_id;
        })
    }
});


