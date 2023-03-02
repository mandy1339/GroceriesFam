function OnClickCheckBox(elem) {
    console.log(elem.name);
    var item_id = (elem.value).replace("checkbox-", "");
    var formID = "form-" + item_id;
    var form = document.getElementById(formID);
    form.submit();
}