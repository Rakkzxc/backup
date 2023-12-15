/* auto select the first input that has autofocus attr */
$(".modal").on("shown.bs.modal", function () {
  $(this).find("[autofocus]").focus();
});
