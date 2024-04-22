 function formatInput_NhapVao(input) {
    let value = input.value.toString();
    // Loại bỏ ký tự không phải số, dấu chấm, dấu phẩy khỏi chuỗi
    value = value.replace(/[^\d]/g, '');
    
    // Chuyển đổi giá trị thành số và kiểm tra nếu nhỏ hơn 1000 hoặc là 0
    if (parseInt(value) < 1000 || parseInt(value) === 0) {
        // Giữ nguyên giá trị và áp dụng định dạng số thập phân nếu cần
        value = parseFloat(value / 1000).toFixed(3);
    } else {
        // Kiểm tra nếu có số 0 ở đầu và giá trị lớn hơn 1000, thì bỏ số 0 đầu tiên
        if (value.charAt(0) === '0') {
            value = value.slice(1); // Bỏ số 0 đầu tiên
        }
        // Thêm dấu chấm sau mỗi 3 chữ số từ cuối chuỗi
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
    input.value = value;
}

document.addEventListener('input', function(event) {
    if (event.target.id.includes('dongia')) {
        formatInput_NhapVao(event.target);
    }
});