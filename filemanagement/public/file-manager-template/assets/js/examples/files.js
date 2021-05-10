$(function () {
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
});
