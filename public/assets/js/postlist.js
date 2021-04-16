$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('document').ready(function () {
    $('.btn-delete').click(function (e) {
        let del = confirm('Do you want delete item?');
        if (del) {
            let id = $(this).data('id');
            $.ajax({
                url: '/post/delete',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                }
            }).done(function(response) {
                if (response.result) {
                    alert('Deleted');
                }
            });
        }
    });
    $('.btn-edit').click(function () {
        let currentRow=$(this).closest("tr");
        let id=currentRow.find("td:eq(0)").text();
        let title=currentRow.find("td:eq(1)").text();
        let content=currentRow.find("td:eq(2)").text();
        $('#title').val(title);
        $('#content').val(content);
        console.log(id);
        $('#id').val(id);
    });
});
