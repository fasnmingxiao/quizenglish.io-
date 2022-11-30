$('INPUT[type="file"]').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case "jpg":
        case "JPG":
        case "jpeg":
        case "JPEG":
        case "png":
        case "PNG":
        case "gif":
        case "GIF":
            break;
        default:
            alert("This is not an allowed file type.");
            this.value = "";
    }
});
// modal
$(".button-mdal").click(function () {
    $("#modal-container").removeAttr("class").addClass("two");
});
$("#modal-container").click(function (e) {
    $(this).addClass("out");
});
$(".modal").click(function (e) {
    e.stopPropagation();
});
