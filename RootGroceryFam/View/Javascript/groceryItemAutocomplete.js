
// AJAX call for autocomplete 
$(document).ready(function() {
	$("#item_description_box").keyup(function() {
		$.ajax({
			type: "POST",
			url: "../Controller/ShoppingListController.php",
			data: 'keyword=' + $(this).val(),
			beforeSend: function() {
				$("#item_description_box").css("background", "#CCC");
			},
			success: function(data) {
				$("#suggestion-grocery-item-list").show();
				$("#suggestion-grocery-item-list").html(data);
				$("#item_description_box").css("background", "#FFF");
			}
		});
	});
});


//To select a animal name
function selectGroceryItem(val) {
	$("#item_description_box").val(val);
	$("#suggestion-grocery-item-list").hide();
}