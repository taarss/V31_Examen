document.querySelector(".manageAccessLevelBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-8 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Access</h3>
    <div class="manageCategoriesTable d-flex flex-wrap">
        <h4 class="col-3">Level</h4>
        <h4 class="col-2">Manage products</h4>
        <h4 class="col-2">Manage categories</h4>
        <h4 class="col-2">Manage api</h4>
        <h4 class="col-2">Manage access level</h4>
    </div>
    `;
    $.ajax({
        url: 'getAccessLevel.php',
        type: 'post',
        data: {
            "callFunc2": 1,
        },
        success: function(data) {
            JSON.parse(data).forEach(element => {
                let rowForm = document.createElement("form");
                rowForm.setAttribute("enctype", "multipart/form-data");
                let p = document.createElement("label");
                p.setAttribute("class", "col-3")
                p.innerHTML = "Access Level "+element['id'];
                rowForm.appendChild(p);
                let radio1 = document.createElement("input");
                radio1.setAttribute("type", "checkbox");
                radio1.setAttribute("name", "manageProductsRadio");
                radio1.setAttribute("value", 1);
                radio1.setAttribute("class", "col-2");

                if (element['manage_products'] == 1) {
                    radio1.setAttribute("checked", "checked");
                }
                let radio2 = document.createElement("input");
                radio2.setAttribute("type", "checkbox");
                radio2.setAttribute("name", "manageCategoriesRadio");
                radio2.setAttribute("value", 1);
                radio2.setAttribute("class", "col-2");

                if (element['manage_categories'] == 1) {
                    radio2.setAttribute("checked", "checked");
                }
                rowForm.appendChild(radio1);
                rowForm.appendChild(radio2);
                let radio3 = document.createElement("input");
                radio3.setAttribute("type", "checkbox");
                radio3.setAttribute("name", "manageApiRadio");
                radio3.setAttribute("value", 1);
                radio3.setAttribute("class", "col-2");
                if (element['manage_api'] == 1) {
                    radio3.setAttribute("checked", "checked");
                }
                let radio4 = document.createElement("input");
                radio4.setAttribute("type", "checkbox");
                radio4.setAttribute("name", "manageAccessLevelRadio");
                radio4.setAttribute("value", 1);
                radio4.setAttribute("class", "col-2");
                if (element['manage_accessLevel'] == 1) {
                    radio4.setAttribute("checked", "checked");
                }
                rowForm.appendChild(radio3);
                rowForm.appendChild(radio4);
                rowForm.setAttribute("action", "updateAccessLevel.php")
                rowForm.setAttribute("method", "post")
                let saveChangesInput = document.createElement("input");
                saveChangesInput.setAttribute("type", "submit");
                saveChangesInput.setAttribute("class", "col-1");
                rowForm.appendChild(saveChangesInput);
                rowForm.setAttribute("class", "col-12 updateAccessLevelForm");
                let categoryId = document.createElement("input");
                categoryId.setAttribute("type", "text");
                categoryId.setAttribute("name", "id");
                categoryId.value = element["id"];
                categoryId.style.visibility = "hidden";
                categoryId.style.position = "absolute";
                categoryId.setAttribute("class", "categoryId");
                rowForm.appendChild(categoryId);
                document.querySelector(".manageCategoriesTable").appendChild(rowForm);
            });
        }
    });
    

    $("#updateCategoryForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                
            }
        });
    });

    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

}