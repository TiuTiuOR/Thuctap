function chosseSearch_KH() {
    var searchKH_Type = document.querySelector('input[name="searchKH"]:checked').value;
    if (searchKH_Type == "1") {
        document.getElementById('search_By_ID').style.display = 'none';
        document.getElementById('search_By_Name').style.display = 'block';
    } else if(searchKH_Type == "0"){
        document.getElementById('search_By_ID').style.display = 'block';
        document.getElementById('search_By_Name').style.display = 'none';
    }else{
        document.getElementById('search_By_ID').style.display = 'none';
        document.getElementById('search_By_Name').style.display = 'none';
    }
}
