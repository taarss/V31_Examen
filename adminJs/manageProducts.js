document.querySelector(".manageProductsBtn").onclick = e => {
    let catagories;
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-11 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Products</h3>
    <div class="input-group">
		<input type="text" name="search_text" id="search_text" placeholder="Search by name or product id..." class="form-control" />
        <select id="searchCategoryCombobox" class="manageProductSearch">
            <option selected="selected" value=0>All Categories</option>
        </select>
    </div>
    <div class="manageCategoriesTable d-flex flex-wrap">
        <h4 class="col-2">Name</h4>
        <h4 class="col-1">Price</h4>
        <h4 class="col-1">Put on sale</h4>
        <h4 class="col-1">Sale percentage</h4>
        <h4 class="col-1">Manufactur</h4>
        <h4 class="col-1">Category</h4>
        <h4 class="col-2">Description</h4>
        <h4 class="col-3">Image</h4>
    </div>
    `;

    $(document).ready(function() {
		load_data();

		function load_data(query, category) {
			$.ajax({
				url: "fetch.php",
				method: "post",
				data: {
                    query: query,
                    category: category
				},
				success: function(data) {    
                    test = JSON.parse(data);
                    createRow(test);
				}
			});
		}

		$('#search_text').keyup(function() {
            var search = $(this).val();
            document.querySelectorAll('.updateProductForm').forEach(e => e.remove());
			if (search != '') {
                let yourSelect = document.getElementById("searchCategoryCombobox" );
                let selectedCat = yourSelect.options[ yourSelect.selectedIndex ].value;
				load_data(search, selectedCat);
			} else {
				load_data();
			}
        });
        document.getElementById("searchCategoryCombobox").addEventListener("change", function(){
            let yourSelect = document.getElementById("searchCategoryCombobox" );
            let selectedCat = yourSelect.options[ yourSelect.selectedIndex ].value;
            document.querySelector("#search_text").innerHTML = "";
            document.querySelector("#search_text").nodeValue = "";

            document.querySelectorAll('.updateProductForm').forEach(e => e.remove());
            load_data("", selectedCat);

        });
	});






    $("#updateProductForm").submit(function(event) {
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

    function deleteProduct(id) {
        $.ajax({
            url: 'deleteProduct.php',
            type: 'post',
            data: {
                "deleteProduct": 1,
                "id": id,
            },
            success: function(data) { 
            }
        });
        
    }
    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

    let addCategoriesOnce = true;
    function getCategories(comboBox, selectedId) {
        $.ajax({
            url: 'getCategories.php',
            type: 'post',
            data: {
                "callFunc2": 1,
            },
            success: function(data) {
                
                JSON.parse(data).forEach(element => {
                    let option2 = document.createElement("option");
                    let option = document.createElement("option");
                    option.setAttribute("value", element["id"]);   
                    option2.setAttribute("value", element["id"]);    
                    option.innerHTML = element["name"];
                    option2.innerHTML = element["name"];                                    
                    if (element["id"] == selectedId) {
                        option.selected = "selected";
                    }
                    comboBox.appendChild(option);
                    if (addCategoriesOnce == true) {
                        document.querySelector(".manageProductSearch").appendChild(option2);
                    }  
                    

                });
                addCategoriesOnce = false;
            }
        });
    }
    function setClothingSex(comboBox, selectedOption) {
       let options = ['male', 'female', 'unisex'];
       options.forEach(element => {
           let option = document.createElement("option");
           option.setAttribute("value", element); 
           option.innerHTML = element;  
           if (element == selectedOption) {
                option.selected = "selected";
           }
           comboBox.appendChild(option);
       });                
    }
        function createRow(data, type) {
            data.forEach(element => {
                let rowForm = document.createElement("form");
                rowForm.setAttribute("enctype", "multipart/form-data");
                let nameInput = document.createElement("input");
                nameInput.setAttribute("type", "text");
                nameInput.setAttribute("value", element["name"]);
                nameInput.setAttribute("name", "name");
                nameInput.setAttribute("class", "col-2");
                rowForm.appendChild(nameInput);
                let priceInput = document.createElement("input");
                priceInput.setAttribute("type", "text");
                priceInput.setAttribute("value", element["price"]);
                priceInput.setAttribute("name", "price");
                priceInput.setAttribute("class", "col-1 mx-2");
                rowForm.appendChild(priceInput);
                let radio1 = document.createElement("input");
                radio1.setAttribute("type", "radio");
                radio1.setAttribute("name", "isOnSale");
                radio1.setAttribute("value", 1);
                let label1 = document.createElement("label");
                label1.innerHTML = "yes";
                label1.setAttribute("class", "mx-2");
                let radio2 = document.createElement("input");
                radio2.setAttribute("type", "radio");
                radio2.setAttribute("name", "isOnSale");
                radio2.setAttribute("value", 0);
                let label2 = document.createElement("label");
                label2.innerHTML = "no";
                label2.setAttribute("class", "mx-2");
                radio2.setAttribute("checked", "checked");
                rowForm.appendChild(radio1);
                rowForm.appendChild(label1);
                rowForm.appendChild(radio2);
                rowForm.appendChild(label2);
                let saleInput = document.createElement("input");
                saleInput.setAttribute("type", "text");
                if (element["saleValue"] == null) {
                    saleInput.setAttribute("value", "0%");
                }
                else{
                    saleInput.setAttribute("value", element["saleValue"]+"%");
                }
                saleInput.setAttribute("name", "saleValue");
                saleInput.setAttribute("class", "col-1 mx-2");
                rowForm.appendChild(saleInput);
                let manufacturInput = document.createElement("input");
                manufacturInput.setAttribute("type", "text");
                manufacturInput.setAttribute("name", "manufactur");
                manufacturInput.setAttribute("value", element["manufactur"]);
                manufacturInput.setAttribute("class", "col-1 mx-2");
                rowForm.appendChild(manufacturInput);
                let categoryInput = document.createElement("select");
                categoryInput.setAttribute("class", "col-1 mx-2 manageCategoryInput");
                categoryInput.setAttribute("name", "category");
                rowForm.appendChild(categoryInput);
                let descriptionInput = document.createElement("input");
                descriptionInput.setAttribute("type", "textarea");
                descriptionInput.setAttribute("class", "col-2");
                descriptionInput.setAttribute("name", "description");
                descriptionInput.setAttribute("value", element["description"]);
                rowForm.appendChild(descriptionInput);

           
                let imageInput = document.createElement("input");
                imageInput.setAttribute("type", "file");
                imageInput.setAttribute("class", "categoryImageUpdateInput");
                imageInput.setAttribute("name", "post_img");
                imageInput.setAttribute("class", "manageProductsImg");
                imageInput.setAttribute("style", "width: : 100px");
                rowForm.appendChild(imageInput);
                let sexInput = document.createElement("select");
                sexInput.setAttribute("class", "col-1 mx-2 manageClothingsexInput");
                sexInput.setAttribute("name", "clothingsex");
                rowForm.appendChild(sexInput);
                rowForm.setAttribute("action", "updateProducts.php")
                rowForm.setAttribute("method", "post")
                let saveChangesInput = document.createElement("input");
                saveChangesInput.setAttribute("type", "submit");
                saveChangesInput.setAttribute("class", "manageProductsSave");

                rowForm.appendChild(saveChangesInput);
                rowForm.setAttribute("class", "col-12 updateProductForm");
                rowForm.classList.add(type);
                let deleteData = document.createElement("button");
                deleteData.innerHTML = "delete";
                deleteData.setAttribute("class", " border border-dark bg-danger text-white");
                deleteData.addEventListener('click', function(){
                    deleteProduct(this.parentElement.querySelector(".categoryId").value);
                    
                });
                rowForm.appendChild(deleteData);
                let categoryId = document.createElement("input");
                categoryId.setAttribute("type", "text");
                categoryId.setAttribute("name", "id");
                categoryId.value = element["id"];
                categoryId.style.visibility = "hidden";
                categoryId.style.position = "absolute";
                categoryId.setAttribute("class", "categoryId");
                rowForm.appendChild(categoryId);
                document.querySelector(".manageCategoriesTable").appendChild(rowForm);                
                getCategories(categoryInput, element["type"]);
                setClothingSex(sexInput, element["sex"]);
            });
        }

}