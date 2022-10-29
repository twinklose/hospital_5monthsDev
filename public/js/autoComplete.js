/************************************** *************************************/
/************* Auto complete on search bar inside Patients List *************/
/************************************** *************************************/

const searchInput = document.querySelector('.searchBar');

// Autocomplete on search bar inside Patients List with SQL ajax request
searchInput.addEventListener('keyup', function() {
    let inputValue = searchInput.value;
    let renderResult = document.querySelector('.containerContent');
    let tamponContainer = document.querySelector('.renderResult');

    if (inputValue.length > 0) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://hospital.localhost/patients?search=' + inputValue, true);
        xhr.onload = function() {
            if (this.status == 200) {
                tamponContainer.innerHTML = this.responseText;
                // Search inside renderResult the container with class listingRecap
                let searchResultContainer = tamponContainer.querySelectorAll('.listingRecap');
                console.log(inputValue);
                // Create a new container to display the search result
                renderResult.innerHTML = '';
                searchResultContainer.forEach(element => {
                    renderResult.appendChild(element);
                });
            }
        }
        xhr.send();
        console.log(xhr.send());
    } else {
        renderResult.style.display = 'none';
    }
});

const thoushandDivision = () => {
    let result = 0;
    for (let i = 0; i < 10000000; i++) {
        result += Math.floor(Math.random() * (6500 - 4500 + 1)) + 4000;
    }
    resultFinal = result / 10000000;
    console.log(resultFinal);
}