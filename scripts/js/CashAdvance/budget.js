$(document).ready(function() {
  //Fetching Budget Data
  var dataTable = $("#budget").DataTable({
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "../scripts/php/Budget/CashAdvance/fetchData.php",
      method: "POST"
    },
    columnDefs: [
      {
        targets: [0],
        orderable: false
      }
    ],
    stateSave: true,
    pagingType: "full_numbers"
  });

  //Clicking Budget Tab
  $(".budgetTab").click(function() {
    dataTable.ajax.reload();
  });

  //Selecting Data Budget Data
  $(document).on("click", 'button[name="btnUpdateBudget"]', function() {
    var id = $(this).attr("id");
    $.ajax({
      url: "../scripts/php/Budget/CashAdvance/selectData.php",
      method: "POST",
      data: {
        id: id
      },
      dataType: "json",
      success: function(data) {
        $("#budgetModal").modal("show");
        $('button[name="btnSubmitBudget"]').attr("data-dismiss", "modal");
        $("input[name='getIdBudget']").val(id);
        $("select[name='budgeted']").val(data.budgeted);
        $("input[name='dateReceivedBudget']").val(data.dateReceivedBudget);
        $("input[name='dateApprovedBudget']").val(data.dateApprovedBudget);
        $("select[name='receivedByBudget']").val(data.receivedByBudget);
        $("select[name='statusBudget']").val(data.statusBudget);
        $("textarea[name='remarksBudget']").val(data.remarksBudget);
      },
      error: function() {
        alert("There is an error");
      }
    });
  });

  //Submitting Accounting Data
  $(document).on("click", 'button[name="btnSubmitBudget"]', function() {
    var id = $('input[name="getIdBudget"]').val();
    var budgeted = $('select[name="budgeted"]').val();
    var dateReceivedBudget = $('input[name="dateReceivedBudget"]').val();
    var dateApprovedBudget = $('input[name="dateApprovedBudget"]').val();
    var receivedByBudget = $('select[name="receivedByBudget"]').val();
    var statusBudget = $('select[name="statusBudget"]').val();
    var remarksBudget = $('textarea[name="remarksBudget"]').val();
    if (
      budgeted != "" &&
      dateReceivedBudget != "" &&
      receivedByBudget != "" &&
      statusBudget != ""
    ) {
      $.ajax({
        url: "../scripts/php/Budget/CashAdvance/updateData.php",
        method: "POST",
        data: {
          id: id,
          budgeted: budgeted,
          dateReceivedBudget: dateReceivedBudget,
          dateApprovedBudget: dateApprovedBudget,
          receivedByBudget: receivedByBudget,
          statusBudget: statusBudget,
          remarksBudget: remarksBudget
        },
        success: function(data) {
          alert(data);
          dataTable.ajax.reload();
        },
        error: function() {
          alert("There is an error!");
        }
      });
    } else {
      alert("There are still empty fields!");
    }
  });

  // For Delete
  $(document).on("click", "button[name='btnDeleteBudget']", function() {
    var id = $(this).attr("id");
    if (confirm("Are you sure you want to remove this data?")) {
      $.ajax({
        url: "../scripts/php/Budget/CashAdvance/deleteData.php",
        method: "POST",
        data: {
          id: id
        },
        success: function(data) {
          alert(data);
          dataTable.ajax.reload();
        }
      });
    } else {
      return false;
    }
  });

  //For Selecting Status
  $('select[name="statusBudget"]').change(function() {
    if (this.value != "Approved") {
      $("input[name='dateApprovedBudget']").prop("disabled", true);
    } else {
      $("input[name='dateApprovedBudget']").removeAttr("disabled");
    }
  });
  $("input[name='dateReceived']").change(function() {
    if (
      $("input[name='dateReceived']").val() != "" &&
      $("input[name='dateApproved']").val()
    ) {
      $('button[name="cashAdvancebtnSubmit"]').attr("data-dismiss", "modal");
    }
  });
  $("input[name='dateApproved']").change(function() {
    if (
      $("input[name='dateReceived']").val() != "" &&
      $("input[name='dateApproved']").val()
    ) {
      $('button[name="cashAdvancebtnSubmit"]').attr("data-dismiss", "modal");
    }
  });
});
