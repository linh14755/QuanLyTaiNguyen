
$(function () {
    $(document).on('click', '.action_add_folder', actionAddFolder);
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

