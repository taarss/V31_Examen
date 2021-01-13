document.querySelector(".manageAccountsBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-8 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Accounts</h3>
    <div class="manageCategoriesTable d-flex flex-wrap">
        <h4 class="col-3">Name</h4>
        <h4 class="col-3">Email</h4>
        <h4 class="col-3">Admin Status</h4>
        <h4 class="col-1">Ban</h4>
        <h4 class="col-1">Update</h4>
    </div>
    `;
    $.ajax({
        url: 'getAccounts.php',
        type: 'post',
        data: {
            "callFunc2": 1,
        },
        success: function(data) {
            JSON.parse(data).forEach(element => {
                let rowForm = document.createElement("form");
                let nameInput = document.createElement("input");
                nameInput.setAttribute("type", "text");
                nameInput.setAttribute("value", element["username"]);
                nameInput.setAttribute("name", "name");
                nameInput.setAttribute("class", "col-3 accountNameUpdateInput");
                nameInput.readOnly = true; 
                let emailnput = document.createElement("input");
                emailnput.setAttribute("type", "text");
                emailnput.setAttribute("value", element["email"]);
                emailnput.setAttribute("name", "name");
                emailnput.setAttribute("class", "col-3 emailUpdateInput");
                emailnput.readOnly = true; 
                rowForm.appendChild(nameInput);

                rowForm.appendChild(emailnput);
                let addAdminBtn = document.createElement("input");
                addAdminBtn.setAttribute("type", "checkbox");
                addAdminBtn.setAttribute("class", "col-2 mr-5 adminCheckBox");
                rowForm.appendChild(addAdminBtn);
               
                rowForm.setAttribute("class", "col-12 updateAccountForm");
                let deleteData = document.createElement("button");
                console.log(element['isBanned']);
                if (element['isBanned'] == "0") {
                    deleteData.innerHTML = "ban";
                    deleteData.setAttribute("class", "ml-5 col-1 border border-dark bg-danger text-white");
                    deleteData.addEventListener('click', function(){
                        this.innerHTML = "banned";
                        this.disabled = true;
                        let accountId = this.parentNode.querySelector(".accountId").value;
                        updateBan(accountId, 1);                            
                    });
                }
                else{
                    deleteData.innerHTML = "unban";
                    deleteData.setAttribute("class", "ml-5 col-1 border border-dark bg-danger text-white");
                    deleteData.addEventListener('click', function(){ 
                        this.innerHTML = "unbanned";
                        event.preventDefault();
                        this.disabled = true;
                        let accountId = this.parentNode.querySelector(".accountId").value;
                        updateBan(accountId, 0);    
                    });
                }
                rowForm.appendChild(deleteData);
                let saveChangesInput = document.createElement("input");
                saveChangesInput.setAttribute("type", "submit");
                saveChangesInput.setAttribute("class", "col-1");
                saveChangesInput.setAttribute("value", "update");
                saveChangesInput.addEventListener('click', function(){ 
                    let status;
                    if (this.parentNode.querySelector(".adminCheckBox").checked == 1) {
                        status = 3;
                    }
                    else{
                        status = 4;
                    }
                    this.innerHTML = "updated";
                    event.preventDefault();
                    let accountId = this.parentNode.querySelector(".accountId").value;    
                    updateAdminStatus(accountId, status)
                });
                rowForm.appendChild(saveChangesInput);
                let categoryId = document.createElement("input");
                categoryId.setAttribute("type", "text");
                categoryId.setAttribute("name", "id");
                categoryId.value = element["id"];
                categoryId.style.visibility = "hidden";
                categoryId.style.position = "absolute";
                categoryId.setAttribute("class", "accountId col-1");
                rowForm.appendChild(categoryId);
                document.querySelector(".manageCategoriesTable").appendChild(rowForm);
            });
        }
    });
    
    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

    function updateAdminStatus(user, status) {
        $.ajax({
            url: "updateAdminStatus.php",
            method: "post",
            data: {
                callFunc2: 1,
                status: status,
                user: user
            },
            success: function(data) {    
                console.log(data);
            }
        });
    }



    function updateBan(user, ban) {
        $.ajax({
            url: "updateBan.php",
            method: "post",
            data: {
                callFunc2: 1,
                banUpdate: ban,
                user: user
            },
            success: function(data) {    
                console.log(data);
            }
        });    
    }

}