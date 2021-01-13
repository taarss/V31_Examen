
    $('#navsearch_text').keyup(function() {
        document.querySelectorAll('.searchResultLink').forEach(e => e.remove());
            var search = $(this).val();
            load_data(search);			
        });

        function load_data(query) {
			$.ajax({
				url: "fetchNavSearchBox.php",
				method: "post",
				data: {
                    query: query,
				},
				success: function(data) {       
                    try{
                        createRow(JSON.parse(data));
                    }
                    catch(err) {
                      }
				}
			});
        }
        function createRow(data) {
            data.forEach(element => {
                let createLink = document.createElement("a");
                createLink.innerHTML = element['name'];
                createLink.setAttribute("href", "product.php?id="+element['id']);
                createLink.setAttribute("class", "searchResultLink");
                document.querySelector(".searchResultBox").appendChild(createLink);
            });
            
        }