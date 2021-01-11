document.querySelector(".addApiKeyBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.className = 'adp';
    adp.innerHTML = `
    <button class="adpBtn w-25 button bg-danger text-light border-0">X</button>
    <h3>Add Api Key</h3>
    <form class="postForm d-flex flex-column"  action="createApikey.php" method="post" id="addApiKey">
        <input type="submit" class="col-12" value="     Add New Api Key     ">
    </form>
    `;
    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

}
$("#addApikey").submit(function(event) {
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