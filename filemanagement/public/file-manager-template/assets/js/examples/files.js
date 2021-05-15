$(function () {
    if (typeof (jsonDataView) !== 'undefined') {
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


    $(document).on('click', '#files-select-all', function () {
        // Check/uncheck all checkboxes in the table
        $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'));
    });

    //Hien thi 3 nut di chuyen, tai xuong, xoa o muc checkall
    $(document).on('click', '#table-files .custom-control-input', function () {
        if ($(this).prop('checked')) {
            $('#file-actions').removeClass('d-none');
            $(this).closest('td').closest('tr').addClass('tr-selected');
        } else {
            $(this).closest('td').closest('tr').removeClass('tr-selected');
            if ($('#table-files .custom-control-input:checked').length == 0) {
                $('#file-actions').addClass('d-none');
            }
        }
    });


    //Lay danh sach checked dung de delete
    $('#btn_customCheckDelete').on('click', function (event) {
        event.preventDefault();
        var searchIDs = $("#tableSearchInput input:checkbox:checked").map(function(){
            return $(this).val();
        }).toArray();

        // console.log(searchIDs);
        let urlRequest = $(this).data('url');

        Swal.fire({
            title: 'Bạn có chắc không?',
            text: "Nó sẽ xóa toàn bộ file và folder trong cùng thư mục!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, xóa nó!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: urlRequest,
                    data: {arr_id: searchIDs},

                    success: function (data) {
                        if (data.code == 200) {
                            location.reload(); //reload lai trang sau khi delete
                        }
                    },
                    error: function () {

                    }
                });
            }
        })
    })


});


//Tao cay thu muc
$(function () {
    if (typeof (jsonDataViewParentId) !== 'undefined') {
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
            var parent_id = e.target.id.replace('_anchor', '');
            document.getElementById("parent_id").value = parent_id;
        })
    }
});


