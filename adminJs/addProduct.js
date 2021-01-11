document.querySelector(".addProductBtn").onclick = e => {
    let catagories;
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.className = 'adp';
    adp.innerHTML = `
    <button class="adpBtn w-25 button bg-danger text-light border-0">X</button>
    <h3>Create product</h3>
    <form enctype="multipart/form-data" class="postForm d-flex flex-column"  action="createProduct.php" method="post" id="createProduct">
        <input id="createProductImg" type="file" name="post_img" required><br>
        <input id="createProductName" type="text" name="post_name" placeholder="name" required>
        <input id="createProductPrice" type="text" name="post_price" placeholder="price" required>
        <input id="createProductManufactur" type="text" name="post_manufactur" placeholder="manufactur">
        <select id="createProductType" name="post_type"  required>
        </select>
        <textarea id="createProductDescription" name="post_description" required style="resize: none; placeholder="Write your description here:" required></textarea>
        <input type="submit">
    </form>
    `;
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
                document.querySelector("#createProductType").appendChild(option);
        
            });
        }
    });
    
    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

}

$("#createProduct").submit(function(event) {
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