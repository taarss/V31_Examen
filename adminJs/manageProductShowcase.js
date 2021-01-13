document.querySelector(".manageProductsShowcaseBtn").onclick = e => {
    console.log("fdfdf");
    let showcasedProducts;
    $.ajax({
        url: "getProductShowcase.php",
        method: "post",
        data: {
            callFunc2: 1,
        },
        success: function(data) {    
            showcasedProducts = JSON.parse(data); 
            console.log(showcasedProducts);
        }
    });
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-11 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Showcase</h3>
    <div class="input-group">
		<input type="text" name="search_text" id="search_text" placeholder="Search by name or product id..." class="form-control" />
        <select id="searchCategoryCombobox" class="manageProductSearch">
            <option selected="selected" value=0>All Categories</option>
        </select>
    </div>
    <h3>Spots remaining: <span id="remainingSlots">0</span></h3>
    <button class="col-1 updateSlideshowBtn button bg-primaray border-0 mt-2 rounded">Update</button>
    <div class="manageCategoriesTable d-flex flex-wrap">
        <h4 class="col-2">Name</h4>
        <h4 class="col-1">Price</h4>
        <h4 class="col-3 text-right">Add to slideshows</h4>
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
            document.querySelectorAll('.updateProductShowcaseForm').forEach(e => e.remove());
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
            document.querySelector("#search_text").value = "";
            document.querySelectorAll('.updateProductShowcaseForm').forEach(e => e.remove());
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

    
    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }
        function createRow(data, type) {
            let updateShowcasedProducts = [];
            data.forEach(element => {
                let rowForm = document.createElement("form");
                rowForm.setAttribute("enctype", "multipart/form-data");
                rowForm.setAttribute("class", "col-12 updateProductShowcaseForm");
                let nameInput = document.createElement("input");
                nameInput.setAttribute("type", "text");
                nameInput.setAttribute("value", element["name"]);
                nameInput.setAttribute("name", "name");
                nameInput.setAttribute("class", "col-2");
                nameInput.readOnly = true; 
                rowForm.appendChild(nameInput);
                let priceInput = document.createElement("input");
                priceInput.setAttribute("type", "text");
                priceInput.setAttribute("value", element["price"]);
                priceInput.setAttribute("name", "price");
                priceInput.setAttribute("class", "col-1 mx-2");
                priceInput.readOnly = true; 
                rowForm.appendChild(priceInput);
                let addToShowcaseBtn = document.createElement("input");
                addToShowcaseBtn.setAttribute("type", "checkbox");
                addToShowcaseBtn.setAttribute("class", "col-4");
                showcasedProducts.forEach(product => {
                    if (product['productId'] == element['id']) {
                        updateShowcasedProducts.push(element['id']);
                        addToShowcaseBtn.setAttribute('checked', 'checked');
                    }
                });
                addToShowcaseBtn.addEventListener( 'change', function() {
                    if(this.checked) {
                        updateShowcasedProducts.push(element['id']);
                        document.querySelector("#remainingSlots").innerHTML =  (12 - updateShowcasedProducts.length);
                        if (updateShowcasedProducts.length == 12) {
                            console.log("pls work");
                            document.querySelectorAll('input[type="checkbox"]:not(:checked)').forEach((element) => {
                                element.disabled = true;
                             });
                        }
                    } 
                    else {
                        var productId = updateShowcasedProducts.indexOf(element['id']);//get  "car" index
                        updateShowcasedProducts.splice(productId, 1);
                        document.querySelector("#remainingSlots").innerHTML =  (12 - updateShowcasedProducts.length);
                        console.log(updateShowcasedProducts);
                        document.querySelectorAll('input[type="checkbox"]:not(:checked)').forEach((element) => {
                            element.disabled = false;
                         });
                    }
                });
                
                rowForm.appendChild(addToShowcaseBtn);
                let categoryId = document.createElement("input");
                categoryId.setAttribute("type", "text");
                categoryId.setAttribute("name", "id");
                categoryId.value = element["id"];
                categoryId.style.visibility = "hidden";
                categoryId.style.position = "absolute";
                categoryId.setAttribute("class", "categoryId");
                rowForm.appendChild(categoryId);
                document.querySelector(".manageCategoriesTable").appendChild(rowForm);                
                
                //selectedProducts.push(element['id']);
            });
            document.querySelectorAll('input[type="checkbox"]:not(:checked)').forEach((element) => {
                element.disabled = true;
             });
            getCategories()
            console.log(updateShowcasedProducts);
            document.querySelector(".updateSlideshowBtn").addEventListener("click", function() {
                if (updateShowcasedProducts.length == 12) {
                    $.ajax({
                        url: 'updateShowcase.php',
                        type: 'post',
                        data: {
                            "callFunc2": updateShowcasedProducts,
                        }
                        
                    });
                }
            });

            
        }
        let addCategoriesOnce = true;
        function getCategories() {
            $.ajax({
                url: 'getCategories.php',
                type: 'post',
                data: {
                    "callFunc2": 1,
                },
                success: function(data) {
                    if (addCategoriesOnce == true) {
                        JSON.parse(data).forEach(element => {
                            let option2 = document.createElement("option");
                            option2.setAttribute("value", element["id"]);    
                            option2.innerHTML = element["name"];                                    
                            document.querySelector(".manageProductSearch").appendChild(option2);
                            
                        });
                    }  
                    addCategoriesOnce = false;
                }
                
            });
        }        
}