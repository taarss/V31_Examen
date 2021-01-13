document.querySelector(".manageAdminsBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-8 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Admins</h3>
    <div class="manageCategoriesTable d-flex flex-wrap">
        <h4 class="col-3">Username</h4>
        <h4 class="col-3">Email</h4>
        <h4 class="col-3">Access Level</h4>
        <h4 class="col-1">Update</h4>
        <h4 class="col-1">Demote</h4>
    </div>
    `;
    $.ajax({
        url: 'getAdmins.php',
        type: 'post',
        data: {
            "callFunc2": 1,
        },
        success: function(data) {
            JSON.parse(data).forEach(element => {
                console.log(element["id"]);
                let rowForm = document.createElement("form");
                rowForm.setAttribute("enctype", "multipart/form-data");
                let nameInput = document.createElement("input");
                nameInput.setAttribute("type", "text");
                nameInput.setAttribute("value", element["username"]);
                nameInput.setAttribute("name", "name");
                nameInput.setAttribute("class", "col-3 adminNameUpdateInput");
                rowForm.appendChild(nameInput);
                let emailInput = document.createElement("input");
                emailInput.setAttribute("type", "text");
                emailInput.setAttribute("value", element["email"]);
                emailInput.setAttribute("name", "name");
                emailInput.setAttribute("class", "col-3 categoryEmailUpdateInput");
                rowForm.appendChild(emailInput);
                let accessLevelInput = document.createElement("select");
                accessLevelInput.setAttribute("class", "col-3 mx-2 manageAccessLevelInput");
                accessLevelInput.setAttribute("name", "accessLevel");
                rowForm.appendChild(accessLevelInput);
                rowForm.setAttribute("method", "post")
                let saveChangesInput = document.createElement("input");
                saveChangesInput.setAttribute("type", "submit");
                saveChangesInput.setAttribute("class", "col-1");
                saveChangesInput.addEventListener('click', function(){ 
                    event.preventDefault();
                    let yourSelect = this.parentNode.querySelector(".manageAccessLevelInput");
                    let selectedLevel = yourSelect.options[ yourSelect.selectedIndex ].value;
                    let accountId = this.parentNode.querySelector(".categoryId").value;   
                    updateLevel(accountId, selectedLevel);
                });
                rowForm.appendChild(saveChangesInput);
                rowForm.setAttribute("class", "col-12 updateCategoryForm");
                let deleteData = document.createElement("button");
                deleteData.innerHTML = "demote";
                deleteData.setAttribute("class", "col-1 border border-dark bg-danger text-white");
                deleteData.addEventListener('click', function(){
                    demoteAdmin(this.parentElement.querySelector(".categoryId").value);
                    console.log(this.parentElement.querySelector(".categoryId").value);
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
                setAccessLevel(accessLevelInput, element["adminLevel"]);

            });
        }
    });
    

  function updateLevel(id, level) {
    $.ajax({
        url: 'updateAdminLevel.php',
        type: 'post',
        data: {
            "user": level,
            "level": id,
        }
    });
  }

    function demoteAdmin(id) {
        $.ajax({
            url: 'demoteAdmin.php',
            type: 'post',
            data: {
                "demoteAdmin": 1,
                "id": id,
            },
            success: function(data) { 
                console.log(data);
            }
        });
        
    }


    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }
    function setAccessLevel(comboBox, selectedOption) {
        let options = [1, 2, 3];
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

}

