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
        document.querySelector(".genderMale").addEventListener("click", function(){
            viewNewGender("male");
          });
          document.querySelector(".genderFemale").addEventListener("click", function(){
            viewNewGender("female");
          });
          document.querySelector(".genderUnisex").addEventListener("click", function(){
            viewNewGender("unisex");
          });
        function viewNewCategory(newCategory) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const gender = urlParams.get('gender')
            if (gender) {
                window.location.href = "https://christianvillads.tech/opgaver/V31_Examen/products.php?category="+newCategory+"&gender="+gender;
            }
            else{
                window.location.href = "https://christianvillads.tech/opgaver/V31_Examen/products.php?category="+newCategory;
            }
        }
        function viewNewGender(newGender) {
            window.location.href = "https://christianvillads.tech/opgaver/V31_Examen/products.php?category=0&gender="+newGender;
        }
        
        