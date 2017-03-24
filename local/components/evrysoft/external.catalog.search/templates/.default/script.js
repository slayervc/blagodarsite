function catalogSearch(){
    document.location.href = window.location.origin + '/catalog/?catalog_search=' + document.getElementById('catalogSearchRequest').value;
}

function catalogSearchRequestOnKeyPress(e){
    if(e.keyCode === 13 && document.getElementById('catalogSearchRequest').value){
        catalogSearch();
    }
}