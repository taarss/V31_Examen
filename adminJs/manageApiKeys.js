document.querySelector(".manageApiKeyBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-8 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Api Keys</h3>
    <div class="manageApiTable d-flex flex-wrap">
        <h4 class="col-10">Key</h4>
        <h4 class="col-2">Options</h4>
    </div>
    `;
    $.ajax({
        url: 'getApiKeys.php',
        type: 'post',
        data: {
            "callFunc2": 1,
        },
        success: function(data) {
            JSON.parse(data).forEach(element => {
                let rowForm = document.createElement("form");
                let apiInput = document.createElement("input");
                apiInput.setAttribute("type", "text");
                apiInput.setAttribute("value", element["apiKey"]);
                apiInput.setAttribute("name", "name");
                apiInput.setAttribute("class", "col-10 apiKey mr-5");
                apiInput.readOnly = true; 
                rowForm.appendChild(apiInput);
                let deleteData = document.createElement("button");
                deleteData.innerHTML = "delete";
                deleteData.setAttribute("class", "col-1 border border-dark bg-danger text-white");
                deleteData.addEventListener('click', function(){
                    deleteapi(this.parentElement.querySelector(".apiId").value,
                    );
                });
                rowForm.appendChild(deleteData);
                let apiId = document.createElement("input");
                apiId.setAttribute("type", "text");
                apiId.setAttribute("name", "id");
                apiId.value = element["id"];
                apiId.style.visibility = "hidden";
                apiId.style.position = "absolute";
                apiId.setAttribute("class", "apiId");
                rowForm.appendChild(apiId);
                document.querySelector(".manageApiTable").appendChild(rowForm);
            });
        }
    });
    
    function deleteapi(id) {
        $.ajax({
            url: 'deleteApi.php',
            type: 'post',
            data: {
                "deleteApi": 1,
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

}