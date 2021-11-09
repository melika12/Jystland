function editItem(id, name, amount, shelf, row, placement, category, description, serial) {
    // Get the modal
    var modal = document.getElementById("editModal");

    // Get the button that opens the modal
    var btn = document.getElementById("addBtn"+id);

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeEdit")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";

        document.getElementById("id").value = id;
        document.getElementById("name").value = name;
        document.getElementById("amount").value = amount;
        document.getElementById("description").value = description;
        document.getElementById("serialnumber").value = serial;
        
        var placementId = 0;
        var catId = 0;
        var places = document.getElementById("placementdrop").options;
        for (let i = 0; i < places.length; i++) {
            if(places[i].innerHTML == "S: " + shelf +" R: "+ row +" P: "+ placement) {
                placementId = places[i].value;
                places[i].selected = 'selected';
            }
        }
        
        var cats = document.getElementById("categorydrop").options;
        for (let i = 0; i < cats.length; i++) {
            if(cats[i].innerHTML == category) {
                catId = cats[i].value;
                cats[i].selected = 'selected';
            }
        }
        document.getElementById("placeId").value = placementId;
        document.getElementById("categoryId").value = catId;
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
}