$(function () {
    $(document).on('click', '.action_add_folder', actionAddFolder);

    $(document).on('click', '.action_delete_file_orFolder', actionDeleteFileOrFolder);

    //Thanh tim kiem
    $(document).ready(function () {
        $('#searchInput').on('keyup', function (event) {
            event.preventDefault();
            /* Act on the event */
            var tukhoa = $(this).val().toLowerCase();
            $('#tableSearchInput tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1);
            });
        });
    });

});

function actionAddFolder(event) {
    event.preventDefault(); // ngan khong cho nut Delete di toi link, van giu nguyen trang web
    let urlRequest = $(this).data('url');
    let that = $(this);

    Swal.fire({
        title: 'Thêm Thư Mục',
        html: `<input type="text" id="folder" class="swal2-input" placeholder="Tên thư mục">`,
        confirmButtonText: 'Tạo',
        focusConfirm: false,
        preConfirm: () => {
            const folder = Swal.getPopup().querySelector('#folder').value

            if (!folder) {
                Swal.showValidationMessage(`Nhập tên thư mục`)
            }
            return {folder: folder}
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                data: result.value,

                success: function (data) {
                    if (data.code == 200) {

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: `Đã tạo folder : ${result.value.folder}`.trim(),
                            showConfirmButton: false,
                            timer: 700
                        })

                        location.reload(); //reload lai trang sau khi add
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Tên bị trùng'
                    })
                }
            });

        }
    })
}

function actionDeleteFileOrFolder(event) {
    event.preventDefault(); // ngan khong cho nut Delete di toi link, van giu nguyen trang web
    let urlRequest = $(this).data('url');
    let that = $(this);

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

                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().parent().parent().remove();
                    }
                },
                error: function () {

                }
            });
        }
    })
}

//Gioi han du lieu duoc submit
var uploadField = document.getElementById("files_upload");

if (uploadField != null) {
    uploadField.onchange = function () {

        if (this.files.length > 0) {
            var fsize = 0;
            for (var i = 0; i <= this.files.length - 1; i++) {
                fsize += this.files.item(i).size;     // THE SIZE OF THE FILE.
            }
            if (fsize > 41943040) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'File tải lên không được quá 40 MB',
                })
                this.value = "";
            }
            ;
        }

    };
}


