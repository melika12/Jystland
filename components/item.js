document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('myTable');
    const headers = table.querySelectorAll('th');
    const tableBody = table.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    // Track sort directions
    const directions = Array.from(headers).map(function (header) {
        return '';
    });

    // Transform the content of given cell in given column
    const transform = function (index, content) {
        // Get the data type of column
        const type = headers[index].getAttribute('data-type');
        switch (type) {
            case 'number':
                return parseFloat(content);
            case 'string':
            default:
                return content;
        }
    };

    const sortColumn = function (index) {
        // Get the current direction
        const direction = directions[index] || 'asc';

        // A factor based on the direction
        const multiplier = direction === 'asc' ? 1 : -1;

        const newRows = Array.from(rows);

        newRows.sort(function (rowA, rowB) {
            const cellA = rowA.querySelectorAll('td')[index].innerHTML;
            const cellB = rowB.querySelectorAll('td')[index].innerHTML;

            const a = transform(index, cellA);
            const b = transform(index, cellB);

            switch (true) {
                case a > b:
                    return 1 * multiplier;
                case a < b:
                    return -1 * multiplier;
                case a === b:
                    return 0;
            }
        });

        // Remove old rows
        [].forEach.call(rows, function (row) {
            tableBody.removeChild(row);
        });

        // Reverse the direction
        directions[index] = direction === 'asc' ? 'desc' : 'asc';

        // Append new row
        newRows.forEach(function (newRow) {
            tableBody.appendChild(newRow);
        });
    };

    [].forEach.call(headers, function (header, index) {
        header.addEventListener('click', function () {
            sortColumn(index);
        });
    });
});

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
            if(places[i].innerHTML == "R: " + row + " S: " + shelf + " P: " + placement) {
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

function searchTable() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("Search");
    filter = input.value.toLowerCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            if(tr[i].id != 'tableHeader') {
                tr[i].style.display = "none";
            }
        }
    }
}