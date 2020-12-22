$(document).ready(function() {
    $(".select2").select2();
});

//get episode for chained select
function getEpisode(counter) {
    let prabudgetId = $(".program" + counter)
        .val()
        .split("|");
    $.ajax({
        type: "GET",
        url: "/episode",
        data: { programId: prabudgetId[0] },
        dataType: "json",
        beforeSend: function(e) {
            if (e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response) {
            $(".episode" + counter).html(response.episodes);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

function fillEditUserModal(data) {
    $("#id").val(data["id"]);
    $("#nik").val(data["nik"]);
    $("#name").val(data["name"]);
    $("#email").val(data["email"]);
    $("#level").val(data["level"]);
    let url = "/user/" + data["id"];

    $("#editForm").attr("action", url);
}

function deleteUserModal(data) {
    let url = "/user/" + data["id"];
    $("#deleteForm").attr("action", url);
}

function resetUserModal(data) {
    let url = "/user/reset/" + data["id"];
    $("#resetForm").attr("action", url);
}
