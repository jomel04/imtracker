$(document).ready(function () {
    //Fetching Data
    var dataTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Settings/Users/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Adding data-dismiss to button[name="usersBtnSubmit"]
    $("input[name='firstName'], input[name='lastName'], select[name='company'], select[name='department'], input[name='email'], input[name='username'], input[name='password'], input[name='confirmPassword']").change(function () {
        if ($("input[name='firstName']").val() != "" && $("input[name='lastName']").val() != "" && $("select[name='company']").val() != "" && $("select[name='department']").val() != "" && $("input[name='email']").val() != "" && $("input[name='username']").val() != "" && $("input[name='password']").val() != "" && $("input[name='confirmPassword']").val() != "") {
            $('button[name="usersBtnSubmit"]').focus().attr("data-dismiss", "modal");
        } else {
            $('button[name="usersBtnSubmit"]').removeAttr("data-dismiss");
        }
    });

    //Adding new record
    $(document).on('click', '#btnAddUsers', function () {
        $('#usersForm')[0].reset();
        $("input[name='action']").val("Insert");
        $('button[name="usersBtnSubmit"]').removeAttr('data-dismiss');
        $("button[name='usersBtnUpdate']").attr('name', 'usersBtnSubmit').text("ADD").removeAttr('data-dismiss');
        $('input[name="username"]').removeAttr('disabled');
        $('input[name="password"]').removeAttr('disabled');
        $('input[name="confirmPassword"]').removeAttr('disabled');
    });

    //Submitting form (INSERTING DATA)
    $(document).on('click', 'button[name="usersBtnSubmit"]', function () {
        //Get ID
        var id = $("input[name='getUserId']").val();
        //Data
        var firstName = $("input[name='firstName']").val();
        var lastName = $("input[name='lastName']").val();
        var company = $("select[name='company']").val();
        var department = $("select[name='department']").val();
        var email = $("input[name='email']").val();
        var role = $('select[name="role"]').val();
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        var confirmPassword = $("input[name='confirmPassword']").val();

        var action = $("input[name='action']").val();
        if (password != confirmPassword) {
            alert("Password doesn't match!");
            return false;
        }
        if (firstName != "" && lastName != "" && company != "" && department != "" && email != "" && role != "" && username != "" && password != "" && confirmPassword != "") {
            $.ajax({
                url: "../scripts/php/Settings/Users/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    firstName: firstName,
                    lastName: lastName,
                    company: company,
                    department: department,
                    email: email,
                    role: role,
                    username: username,
                    password: password,
                    confirmPassword: confirmPassword,
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Selecting Data
    $(document).on('click', 'button[name="usersBtnSelect"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "../scripts/php/Settings/Users/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#usersModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getUserId']").val(id);
                $("button[name='usersBtnSubmit']").attr('name', 'usersBtnUpdate').text("UPDATE");
                $("button[name='usersBtnUpdate']").attr('data-dismiss', 'modal');
                $('input[name="firstName"]').val(data.firstName);
                $('input[name="lastName"]').val(data.lastName);
                $('select[name="company"]').val(data.company.companyID);
                $('select[name="department"]').val(data.department.departmentID);
                $('input[name="email"]').val(data.email);
                $('select[name="role"]').val(data.role);
                $('input[name="username"]').val(data.username);
                $('input[name="password"]').attr('disabled', true);
                $('input[name="confirmPassword"]').attr('disabled', true);
                if (data.role != 'Admin') {
                    $('input[name="username"]').val(data.username).attr('disabled', true);
                    $('input[name="password"]').attr('disabled', true);
                    $('input[name="confirmPassword"]').attr('disabled', true);
                }
            }
        });
    });
    
    //Updating Data
    $(document).on('click', 'button[name="usersBtnUpdate"]', function () {
        //Get ID
        var id = $("input[name='getUserId']").val();
        //Data
        var firstName = $("input[name='firstName']").val();
        var lastName = $("input[name='lastName']").val();
        var company = $("select[name='company']").val();
        var department = $("select[name='department']").val();
        var email = $("input[name='email']").val();
        var username = $("input[name='username']").val();
        var role = $('select[name="role"]').val();
        var action = $("input[name='action']").val();
        if (firstName != "" && lastName != "" && company != "" && department != "" && email != "" && username != "" && role != "") {
            $.ajax({
                url: "../scripts/php/Settings/Users/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    firstName: firstName,
                    lastName: lastName,
                    company: company,
                    department: department,
                    email: email,
                    username: username,
                    role: role
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Deleting Data
    $(document).on('click', 'button[name="usersBtnDelete"]', function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: "../scripts/php/Settings/Users/deleteData.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });
});