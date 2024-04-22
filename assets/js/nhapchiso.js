
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("autoSubmitButton").click();
    kiemTraTrangThaiButton();
});


window.onload = function () {
    var selectedMadk = localStorage.getItem('selected_id_madk');
    var selectedMadkInput = document.getElementById('selected_madk');
    selectedMadkInput.value = selectedMadk;
    kiemTraTrangThaiButton();

};

function kiemTraTrangThaiButton() {
    // Lấy giá trị từ các trường input
    var ky = document.getElementById('ky').value;
    var tungay = document.getElementById('tungay').value;
    var denngay = document.getElementById('denngay').value;
    var tusokw = document.getElementById('tusokw').value;
    var densokw = document.getElementById('densokw').value;
    var kq = document.getElementById('kq').value;
    var tongtien = document.getElementById('tongtien').value;
    var thue = document.getElementById('thue').value;
    var tongtienphaitt = document.getElementById('tongtienphaitt').value;

    if (ky !== '' && tungay !== '' && denngay !== '' && tusokw !== '' && densokw !== '' && kq !== '' && tongtien !== '' && thue !== '' && tongtienphaitt !== '') {
        // ko rỗng thì gỡ bỏ thuộc tính dis đi
        document.getElementById('addhd_button').removeAttribute('disabled');
    } else {
        // thêm thuộc tính dis cho btn
        document.getElementById('addhd_button').setAttribute('disabled', 'disabled');
    }
}
// gọi hàm ktra trạng thái btn khi có sự thay đổi giá trị btn
document.getElementById('ky').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('tungay').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('denngay').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('tusokw').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('densokw').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('kq').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('tongtien').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('thue').addEventListener('input', kiemTraTrangThaiButton);
document.getElementById('tongtienphaitt').addEventListener('input', kiemTraTrangThaiButton);

