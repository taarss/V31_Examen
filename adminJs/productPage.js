let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString);
let selectedId = urlParams.get('category');

        
        $.ajax({
            url: 'getCategories.php',
            type: 'post',
            data: {
                "callFunc2": 1,
            },
            success: function(data) {
                JSON.parse(data).forEach(element => {
                    let option = document.createElement("option");
                    option.setAttribute("value", element["id"]);   
                    option.innerHTML = element["name"];
                    if (element["id"] == selectedId) {
                        option.selected = "selected";
                    }
                    document.querySelector(".productPageSearch").appendChild(option);                
                });
                document.querySelector(".productPageSearch").onchange = function(){
                    viewNewCategory(this.value);
                };
            }
        });

        function viewNewCategory(newCategory) {
            window.location.href = "https://christianvillads.tech/opgaver/webShop/products.php?category="+newCategory;
        }
        