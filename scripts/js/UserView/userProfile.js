$(document).ready(function () {
    //Selecting Data
    $(document).on('click', 'a.btnProfile', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "../scripts/php/UserView/Profile/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#userProfileModal").modal("show");
                $("input[name='getUserId']").val(id);
                $("button[name='userProfileBtnUpdate']").attr('data-dismiss', 'modal');
                $('input[name="firstName"]').val(data.firstName);
                $('input[name="lastName"]').val(data.lastName);
                $('input[name="email"]').val(data.email);
                $('input[name="username"]').val(data.username);
            }
        });
    });

    //Updating Data
    $(document).on('click', 'button[name="userProfileBtnUpdate"]', function () {
        //Get ID
        var id = $("input[name='getUserId']").val();
        //Data
        var firstName = $("input[name='firstName']").val();
        var lastName = $("input[name='lastName']").val();
        var email = $("input[name='email']").val();
        var username = $("input[name='username']").val();
        if (firstName != "" && lastName != "" && email != "" && username != "") {
            $.ajax({
                url: "../scripts/php/UserView/Profile/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    firstName: firstName,
                    lastName: lastName,
                    email: email,
                    username: username
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });
});