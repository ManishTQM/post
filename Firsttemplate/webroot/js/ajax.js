function saveUserAjax() {
    $.ajax({
        method: 'POST',
        url: 'http://localhost:8765/details/saveUserAjax',
        data: $('#user_id').serialize(),
        type: "JSON",
        success: function (result) {
            var student = JSON.parse(result);
            // alert(result);
            if (student.status == 200) {
                console.log(student.status);
                console.log(student.message);
            }
        },
    });
}


function getBase64() {
    var file = document.querySelector('#user_id input[type="file"]').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        $('#image_data').val(reader.result);
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
 }